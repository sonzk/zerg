<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 下午1:35
 */

namespace app\api\validate;


class CategoryUpdate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'isNotEmpty|chsDash',
        'list_order' => 'number'
    ];

}