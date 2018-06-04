<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午10:41
 */

namespace app\api\behavior;


class CORS
{

    public function appInit(&$params){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: token,Origin,X-Requested-With,Content-type,Accept');
        header('Access-Control-Allow-methods: POST,GET,PUT,DELETE');

        if (request()->isOptions()){
            exit();
        }
    }
}