<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 下午8:00
 */

namespace app\api\validate;


class ThemeProductAdd extends BaseValidate
{

    protected $rule = [
        'theme_id' => 'require|number',
        'product_id' => 'require|number',
    ];
}