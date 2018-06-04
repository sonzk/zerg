<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/3
 * Time: 下午3:54
 */

namespace app\api\validate;


class CategoryAdd extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty|chsDash',
        'topic_img_url' => 'require',
    ];

}