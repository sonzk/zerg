<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午6:02
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProduceModel;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\ProductException;

class Product
{

    /**
     *  $count  最新商品数量
     * url api/:version/product/recent?count=14 .... 最多15
     */
    public function getRecent($count = 15){

        (new Count())->goCheck();

        $products =  ProduceModel::getMostRecent($count);

        if ($products->isEmpty()){
            throw new ProductException();
        }

        $products->hidden(['summary']);
        return $products;
    }


    /**
     *  $id  category_id
     * url api/:version/product/by_category?id=1 ....
     */
    public function getAllByCategoryId($id){

        (new IdMustBePositiveInt())->goCheck();

        $products = ProduceModel::getProductByCategoryId($id);
        if ($products->isEmpty()){
            throw new ProductException();
        }
        $products->hidden(['summary']);
        return $products;
    }


    /**
     *  $id  商品product_id
     * url api/:version/product/1 ....
     */
    public function getOne($id){
        (new IdMustBePositiveInt())->goCheck();

        $product = ProduceModel::getProductDetail($id);

        return $product;
    }

}

















