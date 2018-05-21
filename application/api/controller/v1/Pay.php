<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/11
 * Time: 下午7:15
 */

namespace app\api\controller\v1;


use app\api\validate\IdMustBePositiveInt;
use app\api\service\WxNotify;
use app\api\service\Pay as  PayService;

class Pay extends BaseController
{

    protected $beforeActionList =[
        'checkExclusiveScope'=>['only'=>'getPreOrder']
    ];

    public function getPreOrder($id = ''){
        (new IdMustBePositiveInt())->goCheck();

        $pay = new PayService($id);

         return $pay->pay();
    }

    //支付回调
    public function receiveNotify(){
        //检测库存量，是否超卖
        //更新订单状态
        //减库存
        $notify = new WxNotify();
        $notify->Handle();
    }
}