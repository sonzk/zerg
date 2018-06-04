<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 下午4:19
 */

namespace app\api\validate;


class ThemeUpdate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'isNotEmpty|chsDash',
        'description' => 'isNotEmpty|chsDash'
    ];

}