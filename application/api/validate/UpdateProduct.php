<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 上午1:00
 */

namespace app\api\validate;


class UpdateProduct extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'isNotEmpty',
        'price' => 'isFloatAndInt|isNotEmpty',
        'stock' => 'number',
        'category_id' => 'number|isNotEmpty'
    ];
}