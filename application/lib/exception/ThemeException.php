<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午4:31
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定的主题不存在，请检查参数';
    public $errorCode = 30000;
}