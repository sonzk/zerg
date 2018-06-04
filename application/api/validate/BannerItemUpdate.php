<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 下午12:03
 */

namespace app\api\validate;


class BannerItemUpdate extends BaseValidate
{

    protected $rule = [
        'id' => 'require|number',
        'type' => 'number|isNotEmpty',
        'key_word' => 'number|isNotEmpty',

    ];

}