<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/13
 * Time: 上午12:33
 */

namespace app\service;
use app\lib\enum\OrderStatusEnum;

use app\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\model\Product as ProductModel;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;
Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');


class WxNotify extends \WxPayNotify
{

    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS'){

            $orderNo =  $data['out_trade_no'];
            Db::startTrans();
            try {

                $order = OrderModel::where('order_no', '=', $orderNo)->find();
                if ($order->status == 1) {
                    $orderService = new OrderService();
                    $stockStatus = $orderService->checkOrderStock($order->id);
                    if ($stockStatus['pass']) {
                        $this->updateOrderStatus($order->id,true);  //更新订单状态
                        $this->reduceStock($stockStatus);                   //减库存
                    } else {
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                Db::commit();
                return true;
            }catch (Exception $e){
                Db::rollback();
                Log::error($e);
                return false;
            }
        }else{
            return true;   //失败也返回true ，不让微信继续发送结果
        }
    }

    private function updateOrderStatus($orderId,$success){
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_NOT_OF;
        OrderModel::where('id','=',$orderId)->update(['status'=>$status]);
    }

    private function reduceStock($status){
        foreach ($status['pStatusArray'] as $p) {
            ProductModel::where('id', '=', $p['id'])->setDec('stock',$p['count']);
        }
    }
}