<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 下午5:31
 */

namespace app\api\controller\v1;


use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{
    public function checkPrimaryScope(){
        TokenService::getPrimaryScope();
    }

    public function checkExclusiveScope(){
        TokenService::getExclusiveScope();
    }
}