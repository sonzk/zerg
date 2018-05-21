<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/11
 * Time: 下午7:20
 */

namespace app\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use app\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use think\Loader;
use think\Log;

// extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');
class Pay
{

    protected $orderId;
    protected $orderNo;

    public function __construct($orderId){
        if (!$orderId){
            throw new Exception('订单号不允许为空');
        }
        $this->orderId = $orderId;
    }

    //主方法，对接控制器
    public function pay(){
        //检测orderId是否存在
        //检测用户与orderID是否匹配
        //检测检测订单是否已支付
        //支付之前检测库存
        $this->checkOrderValid();

        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderId);
        if (!$status['pass']){
            return $status;
        }

        //生成预订单，返回小程序
        return $this->makeWxPreOrder($status['orderPrice']);

    }


    //设置订单参数，返回小程序所需要的参数
    protected function makeWxPreOrder($orderPrice){

        $openid = Token::getCurrentTokenVar('openid');

        if (!$openid){
            throw new TokenException();
        }
        //微信统一下单参数设置
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTotal_fee($orderPrice*100);
        $wxOrderData->SetBody('零食商贩');
        $wxOrderData->SetNotify_url(config('secure.pay_notify_url'));
        $wxOrderData->SetTrade_type('JSAPI');

        return $this->getPaySignature($wxOrderData);
    }

    //参数传入统一下单接口
    protected function getPaySignature($wxOrderDate){
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderDate);
        if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['rasult'] != 'SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
            return $wxOrder;
        }

        //处理prepay_id
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    //设置小程序需要返回的参数和签名
    protected function sign($wxOrder){
        $jsApiPayDate = new \WxPayJsApiPay();
        $jsApiPayDate->SetAppid(config('wx.app_id'));
        $jsApiPayDate->SetTimeStamp((string)time());
        $rand = md5(time().mt_rand(0,1000));
        $jsApiPayDate->SetNonceStr($rand);
        $jsApiPayDate->SetPackage('prepay_id='.$wxOrder['prepay_id']);
        $jsApiPayDate->SetSignType('md5');
        $sign = $jsApiPayDate->MakeSign();

        $rawValue = $jsApiPayDate->GetValues();
        $rawValue['paySign']=$sign;

        return $rawValue;

    }


    //prepay_id入库
    protected function recordPreOrder($wxOrder){
        OrderModel::where('id','=',$this->orderId)->update(['prepay_id'=>$wxOrder['prepay_id']]);
    }

    //检测orderId是否存在
    //检测用户与orderID是否匹配
    //检测检测订单是否已支付
    protected function checkOrderValid(){
        $order = OrderModel::where('id','=',$this->orderId)->find();
        if (!$order){
            throw new OrderException();
        }

        $uid = $order->user_id;
        if (!Token::isValidOperate($uid)){
            throw new TokenException([
                'msg'=>'订单与用户不匹配',
                'errorCode'=>10003,
            ]);
        };


        if ($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'code'=>400,
                'msg'=>'订单已支付',
                'errorCode'=>'80003'
            ]);
        }
        $this->orderNo = $order->order_no;
        return true;

    }
}