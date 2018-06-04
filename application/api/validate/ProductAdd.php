<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/2
 * Time: 下午8:16
 */

namespace app\api\validate;


class ProductAdd extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'price' => 'require|isNotEmpty|isFloatAndInt',
        'stock' => 'require|isNotEmpty|number',
        'category_id' => 'require|number',
        'main_img_url' => 'require'
    ];

    protected $message = [
        'name' => '商品名不能为空',
        'price.require' => '商品价格不能为空',
        'price.isNotEmpty' => '商品价格不能为空',
        'price.isFloatAndInt' => '商品价格输入错误',
        'category.number' => '分类选择错误',
        'category.require' => '所属分类不能为空',
        'main_img_url' => '商品主图不能为空'
    ];

}