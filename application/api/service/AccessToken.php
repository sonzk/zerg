<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午6:57
 */

namespace app\api\service;



use think\Cache;
use think\Exception;

class AccessToken
{
    private $accessTokenUrl;
    const ACCESS_TOKEN_KEY = 'access';
    const TOKEN_EXPIRES_IN = 7000;


    public function __construct(){
        $accessUrl = config('wx.access_url');
        $this->accessTokenUrl = sprintf($accessUrl,config('wx.app_id'),config('wx.app_secret'));
    }

    public function get(){
        $token =$this->getTokenFromCache();
        if (!$token){
            return $token = $this->getTokenFromService();
        }else{
            return $token;
        }
    }


    private function getTokenFromCache(){
        $token = \cache(self::ACCESS_TOKEN_KEY);
        if (!$token){
            return null;
        }
        return $token;
    }


    private function getTokenFromService(){

        $token = curl_get($this->accessTokenUrl);
        $token = json_decode($token,true);

        if (!$token){
            throw new Exception('服务器获取access_token失败');
        }
        if (!empty($token['errcode'])){
            throw new Exception($token['errmsg']);
        }
        $this->saveToCache($token['access_token']);
        return $token['access_token'];
    }

    private function saveToCache($token){
        \cache(self::ACCESS_TOKEN_KEY,$token,self::TOKEN_EXPIRES_IN);
    }
}














