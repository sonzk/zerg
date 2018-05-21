<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/21
 * Time: 下午1:36
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}