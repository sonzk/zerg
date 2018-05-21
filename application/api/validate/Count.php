<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午6:04
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count'=>'isPositiveInteger|between:1,15'
    ];

    protected $message = [
        'count.isPositiveInteger' => 'count必须为正整数',
        'count.between' => 'count应在1到15之间'
    ];
}