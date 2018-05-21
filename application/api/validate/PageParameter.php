<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/14
 * Time: 下午2:28
 */

namespace app\api\validate;


class PageParameter extends BaseValidate
{
    protected $rule = [
        'page'=>'isPositiveInteger',
        'size'=>'isPositiveInteger'
    ];

    protected $message =[
        'page'=>'page必须为正整数',
        'size'=>'page必须为正整数'
    ];

}