<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午2:37
 */
return [
    'app_id' =>'wxac05962af947fe69',
    'app_secret' => '4c690d575ffa9f75ca00c1a7852bfa30',
    'login_url' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
    'access_url'=>'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s'
];