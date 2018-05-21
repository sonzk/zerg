<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/3
 * Time: 下午6:37
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;

}