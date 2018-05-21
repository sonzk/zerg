<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 下午5:38
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{

    //products 是多个数组组成，多个商品的购买数量 $products = [ ['product_id'=>1,'count'=>3],[...] ]
    protected $rule = [
        'products'=>'require|checkProducts'
    ];

    protected $singleRule = [
        'product_id'=>'require|isPositiveInteger',
        'count'=>'require|isPositiveInteger'
    ];


    public function checkProducts($values){
        if (!is_array($values)){
            throw new ParameterException(['msg'=>'商品参数不正确']);
        }

        if (empty($values)){
            throw new ParameterException(['msg'=>'商品不能为空']);
        }

        foreach ($values as $value){
            $this->checkProduct($value);
        }
        return true;
    }

    public function checkProduct($value){
        $validate = new BaseValidate($this->singleRule);

        $result = $validate->check($value);

        if (!$result){
            throw new ParameterException(['msg'=>'商品参数不正确']);
        }

    }

}