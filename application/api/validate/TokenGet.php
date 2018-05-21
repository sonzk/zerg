<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/8
 * Time: 下午2:23
 */

namespace app\api\validate;



class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code.isNotEmpty' => 'code为空'
    ];
}