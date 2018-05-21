<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 上午8:38
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'=>'require|isNotEmpty',
        'mobile'=>'require',
        'province'=>'require|isNotEmpty',
        'city'=>'require|isNotEmpty',
        'county'=>'require|isNotEmpty',
        'detail'=>'require|isNotEmpty',
    ];

}