<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午3:16
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;


class Token
{
    public static function generateToken(){

        //随机数，时间戳，盐组成随机令牌
        $randChar = getRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME'];

        $salt = config('secure.token_salt');

        return md5($randChar.$timestamp.$salt);
    }

    public static function getCurrentTokenVar($key){
        $token = Request::instance()->header('token');

        $vars = Cache::get($token);
        if (!$vars){
            throw new TokenException();
        }else{

            if (!is_array($vars)){
                $vars = json_decode($vars,true);
            }
           if (array_key_exists($key,$vars)){
                return $vars[$key];
           }else{
                throw new Exception('尝试Token变量不存在');
           }
        }
    }

    //获取uid
    public static function getCurrentUid(){
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    //获取权限
    public static function getCurrentUserScope(){
        $scope = self::getCurrentTokenVar('scope');
        return $scope;
    }


    //获取普通权限，用户和管理员都可以操作的
    public static function getPrimaryScope(){
        $scope = self::getCurrentUserScope();
        if ($scope){

            if ($scope >= ScopeEnum::USER){
                return true;
            }else{
                throw new ForbiddenException();
            }

        }else{
            throw new TokenException();
        }
    }

    //获取user独有的权限
    public static function getExclusiveScope(){
        $scope = static::getCurrentUserScope();
        if ($scope){

            if ($scope == ScopeEnum::USER){
                return true;
            }else{
                throw new ForbiddenException();
            }

        }else{
            throw new TokenException();
        }
    }

    //检测订单用户和当前用户是否一致
    public static function isValidOperate($checkUid){

        if (!$checkUid){
            throw new Exception('检测Uid必须传入一个被检测的Uid');
        }
        $currentOperateUid = self::getCurrentUid();
        if ($checkUid == $currentOperateUid){
            return true;
        }
        return false;
    }


    public static function verifyToken($token){

        $exist = Cache::get($token);
        if ($exist){
            return true;
        }
        return false;
    }


}











