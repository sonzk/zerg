<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午5:03
 */

namespace app\api\service;


use app\api\model\User as UserModel;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;

class DeliveryMessage extends WxMessage
{
    //消息模板id
    const DELIVERY_TPL_ID = 'yVZ0bFPIc3kY5nL-KwPaypTvJTopK_A_Y2XgaL811CA';

    public function sendDeliveryMessage($order,$jumpPage =''){
        if (!$order){
            throw new OrderException();
        }
        $this->templateId = self::DELIVERY_TPL_ID;
        $this->page = $jumpPage;
        $this->formId = $order->prepay_id;
        $this->emphasisKeyword = 'keyword4.DATA';
        $this->prepareData($order);

        return parent::sendMessage($this->gerUserOpenId($order->user_id));
    }

    private function prepareData($order){
        $data = [
            'keyword1'=>[
                'value'=>$order->express_name,
            ],
            'keyword2'=>[
                'value'=>$order->express_no,
            ],
            'keyword3'=>[
                'value'=>$order->snap_name,
            ],
            'keyword4'=>[
                'value'=>$order->order_no,
            ],
        ];

        return $this->data = $data;
    }

    private function gerUserOpenId($userId){
        $user = UserModel::get($userId);
        if (!$user){
            throw new UserException();
        }

        return $user->openid;
    }
}








