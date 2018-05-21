<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/10
 * Time: 下午2:17
 */

namespace app\api\service;


use app\api\model\OrderProduct as OrderProductModel;
use app\api\model\Product as ProductModel;
use app\api\model\UserAddress as UserAddressModel;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use app\api\model\Order as OrderModel;
use think\Db;



class Order
{
    //订单商品
    protected $oProducts;

    //数据库的真实商品
    protected $products;

    //用户ID
    protected $uid;

    public function place($uid,$oProducts){
        $this->oProducts = $oProducts;
        $this->uid = $uid;
        $this->products = $this->getProductsByOrder($oProducts);

        //获取验证订单商库存，pass为false则不通过，直接返回
        $status = $this->getOrderStatus();
        if (!$status['pass']){
            $status['order'] = -1;
            return $status;
        }

        //状态通过就生成订单快照，
        $orderSnap = $this->orderSnap($status);
        //订单写入数据库
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;

    }


    //创建订单
    protected function createOrder($orderSnap){

        //开启事务,两个表的写入
        Db::startTrans();
        try {
            $orderNo = self::makeOrderOn();

            $order = new OrderModel();
            $order->order_no = $orderNo;
            $order->user_id = $this->uid;
            $order->total_price = $orderSnap['orderPrice'];
            $order->total_count = $orderSnap['totalCount'];
            $order->snap_name = $orderSnap['snapName'];
            $order->snap_img = $orderSnap['snapImg'];
            $order->snap_address = $orderSnap['snapAddress'];
            $order->snap_items = json_encode($orderSnap['pStatus']);
            $order->save();

            $orderId = $order->id;
            $create_time = $order->create_time;

            foreach ($this->oProducts as &$p) {
                $p['order_id'] = $orderId;
            }

            $orderProduct = new OrderProductModel();
            $orderProduct->saveAll($this->oProducts);
            Db::commit();

            return [
                'orderNo' => $orderNo,
                'order_id' => $orderId,
                'create_time' => $create_time
            ];
        }catch (\Exception $e){
            Db::rollback();
            throw $e;
        }

    }


    //随机订单号
    public static function makeOrderOn(){
        $yCode = ['A','B','C','D','E','F','G','H','I','J'];
        $orderSn = $yCode[intval(date('Y'))-2018].
            strtoupper(dechex(date('m'))).date('d').
            substr(time(),-5).substr(microtime(),2,5).
            sprintf('%02d',mt_rand(0,99));
        return $orderSn;
    }


    //生成订单快照
    protected function orderSnap($status){
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => '',
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];

        if (count($this->oProducts) > 1){
            $snap['snapName'] .= '等';
        }
        return $snap;
    }


    //获取用户地址
    protected function getUserAddress(){
        $address = UserAddressModel::where('user_id','=',$this->uid)->find();
        if (!$address){
            throw new UserException([
                'msg'=>'用户收货地址不存在，下单失败',
                'errorCode'=>'60001'
            ]);
        }
        return $address->toArray();
    }

    //检测库存，外调方法
    public function checkOrderStock($orderId){
        $oProducts =  OrderProductModel::where('order_id','=',$orderId)->select()->toArray();
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $status = $this->getOrderStatus();
        return $status;
    }

    //根据订单中的商品获取每个商品的状态
    protected function getOrderStatus(){
        $status = [
            'pass'=>true,
            'orderPrice'=>0,
            'totalCount'=>0,
            'pStatusArray'=>[]
        ];

        foreach ($this->oProducts as $oProduct){
            $pStatus = $this->getProductStatus($oProduct['product_id'],$oProduct['count'],$this->products);
            if (!$pStatus['haveStock']){
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'],$pStatus);
        }

        return $status;
    }



    //根据订单中的单个商品ID获取该商品状态，返回数组，
    protected function getProductStatus($oPID, $oCount, $products){
        $pIndex = -1;
        $pStatus = [
            'id'=>null,
            'name'=>'',
            'haveStock'=>false,
            'count'=>0,
            'totalPrice'=>0,
            'price'=>0,
            'main_img_url'=>''
        ];

        for($i=0; $i<count($products);$i++){
            if ($oPID == $products[$i]['id'] ){
                $pIndex = $i;
            }
        }

        if ($pIndex == -1 ){
            throw new OrderException(['msg'=>'id为'.$oPID.'商品不存在，订单创建失败']);

        }else{
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['main_img_url'] = $product['main_img_url'];
            $pStatus['price']=$product['price'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = number_format($oCount * $product['price'],2);
            if ($product['stock'] - $oCount >= 0){
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }


    //根据订单的商品获取到数据指定商品的信息
    protected function getProductsByOrder($oProducts){
        $oPIDs = [];
        foreach ($oProducts as $product){
            array_push($oPIDs,$product['product_id']);
        }

        $products = ProductModel::all($oPIDs)->visible(['id','price','stock','name','main_img_url'])->toArray();

        return $products;
    }

    public function delivery($orderId,$jumpPage=''){
        $order = OrderModel::get($orderId);

        if (!$order){
            throw new OrderException();
        }

        if ($order->status != OrderStatusEnum::PAID){
            throw new OrderException([
                'msg'=>'订货还没付款，不能发货',
                'code'=>403,
                'errorCode'=>80001
            ]);
        }

        //就算模板没发成功也应该修改状态为已发货
        $order->status = OrderStatusEnum::DELIVERED;
        $order->save();

        $message = new DeliveryMessage();
        return $message->sendDeliveryMessage($order,$jumpPage);

    }
}












