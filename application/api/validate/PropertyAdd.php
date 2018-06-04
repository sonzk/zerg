<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 上午12:14
 */

namespace app\api\validate;


class PropertyAdd extends BaseValidate
{
    protected $rule = [
        'product_id' => 'require|number',
        'name' => 'require|isNotEmpty|chsDash',
        'detail' => 'require|isNotEmpty|chsDash'
    ];

    protected $message = [
        'product_id' => '商品参数错误',
        'name.require' => '属性名不能为空',
        'name.isNotEmpty' => '属性名不能为空',
        'name.chsDash' => '属性名含有非法字符',
        'detail.require' => '属性值不能为空',
        'detail.isNotEmpty' => '属性值不能为空',
        'detail.chsDash' => '属性值含有非法字符'
    ];
}