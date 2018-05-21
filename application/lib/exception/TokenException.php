<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午3:42
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token无效或者过期';
    public $errorCode = 10001;
}