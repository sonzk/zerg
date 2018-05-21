<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午7:12
 */

namespace app\api\service;


use think\Cache;
use think\Exception;

class WxMessage
{
    private $sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=%s';

    private $color = 'black';

    public $templateId;
    public $page;
    public $formId;
    public $emphasisKeyword;
    public $data;

    public function __construct()
    {
        $access = new AccessToken();
        $token = $access->get();

        $this->sendUrl = sprintf($this->sendUrl,$token);
    }

    public function sendMessage($openid){

        $data = [
            'touser'=>$openid,
            'template_id'=>$this->templateId,
            'page'=>$this->page,
            'form_id'=>$this->formId,
            'emphasis_keyword'=>$this->emphasisKeyword,
            'data'=>$this->data,
            //'color'=>$this->template_id,
        ];

        $result = curl_post($this->sendUrl,$data);
        $result = json_decode($result,true);
        if ($result['errcode'] == 0){
            return true;
        }else{
            throw new Exception('模板信息发送失败'.$result['errmsg']);
        }
    }
}