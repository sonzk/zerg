<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午1:41
 */

namespace app\api\model;


use app\lib\exception\UserException;

class ThirdApp extends BaseModel
{
    public static function check($ac , $se){
        $app =  self::where('app_id','=',$ac)
            ->where('app_secret','=',$se)
            ->find();
        return $app;
    }
}