<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 上午9:12
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 400;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}