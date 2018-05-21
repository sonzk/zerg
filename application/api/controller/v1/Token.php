<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午2:18
 */

namespace app\api\controller\v1;


use app\api\validate\AppTokenGet;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;
use app\api\service\UserToken;
use app\api\service\Token as TokenService;
use app\api\service\AppToken as AppTokenService;

class Token
{
    //客户端获取令牌
    public function getToken($code = ''){

        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token'=>$token,
        ];
    }

    //第三方获取令牌
    public function getAppToken($ac='' , $se =''){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: token,Origin,X-Requested-With,Content-type,Accept');
        header('Access-Control-Allow-methods: POST,GET');
        (new AppTokenGet())->goCheck();
        $app =  new AppTokenService();
        $token = $app->get($ac , $se);
        return [
            'token'=>$token,
        ];
    }

    public function verifyToken($token=''){

        if (!$token){
            throw new ParameterException(['msg'=>'token不允许为空']);
        }

        $valid = TokenService::verifyToken($token);

        return [
            'isValid' => $valid
        ];
    }
}