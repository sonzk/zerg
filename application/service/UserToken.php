<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午2:20
 */

namespace app\service;


use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class UserToken extends Token
{

    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    protected $code;

    public function __construct($code){
        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppId,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);

        if (empty($wxResult)){
            throw new Exception('获取session_key异常');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if ($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }


    protected function grantToken($wxResult){
        //拿到openid
        //查看数据库有没有相同的openid
        //如果存在不处理,不存在就新增一条记录
        //生成令牌，准备缓存，写入缓存，
        //令牌返回客户端
        //key: 令牌
        //value : wxResult uid scope
        $openId = $wxResult['openid'];

        $user = UserModel::getUserByOpenid($openId);
        if ($user){
            $uid = $user->id;
        }else{

            $uid = $this->newUser($openId);
        }

        $cacheValue = $this->prepareCacheValue($wxResult,$uid);
        $token = $this->saveToCache($cacheValue);
        return $token;

    }


    //token作为key，设置缓存key，结合value值存进缓存，返回token
    protected function saveToCache($cacheValue){

        //生成随机token
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');

        $request = cache($key,$value,$expire_in);
        if (!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errCode'=>10005
            ]);
        }
        return $key;

    }

    //设置缓存vaule值
    protected function prepareCacheValue($wxResult,$uid){
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = ScopeEnum::USER;

        return $cacheValue;
    }

    //新增user
    protected function newUser($openId){
        $user = UserModel::create(['openid'=>$openId]);
        return $user->id;
    }

    //微信返回异常
    protected function processLoginError($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);

    }


}