<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午1:38
 */

namespace app\api\service;
use app\api\model\ThirdApp as ThirdAppModel;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;

class AppToken extends Token
{
    public function get($ac , $se){

        $app =ThirdAppModel::check($ac,$se);
        if (!$app){
            throw new TokenException([
                'msg'=>'授权失败',
                'errorCode'=>10004
            ]);
        }
        $data = [
            'uid'=>$app->id,
            'scope'=>$app->scope
        ];
        $token = $this->saveToCache($data);
        return $token;
    }

    protected function saveToCache($data){
        $token = self::generateToken();
        $value = json_encode($data);
        $expire_in = config('setting.token_expire_in');
        $request = cache($token,$value,$expire_in);
        if (!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errCode'=>10005
            ]);
        }
        return $token;
    }
}