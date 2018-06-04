<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/4
 * Time: 上午11:34
 */

namespace app\api\validate;


class Delivery extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'express_name' => 'require|chsDash',
        'express_no' => 'require|chsDash'
    ];

}