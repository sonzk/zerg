<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/1
 * Time: 下午10:37
 */

namespace app\api\validate;


class ImageListOrder extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number|isNotEmpty',
        'order' => 'require|number',
    ];
}