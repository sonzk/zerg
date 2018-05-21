<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/3
 * Time: 下午6:37
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在';
    public $errorCode = 80000;

}