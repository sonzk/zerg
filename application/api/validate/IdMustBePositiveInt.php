<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/2
 * Time: 下午9:13
 */

namespace app\api\validate;



class IdMustBePositiveInt extends BaseValidate
{

    protected $rule = [
        'id'=>'require|isPositiveInteger',
    ];

    protected $message = [
        'id.require' => 'id不能为空',
        'id.isPositiveInteger' => 'id必须是正整数'
    ];


}