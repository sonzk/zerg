<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午6:02
 */

namespace app\api\controller\v1;


use app\api\model\ThemeProduct;
use app\api\validate\Count;
use app\api\model\Product as ProduceModel;
use app\api\model\ThemeProduct as ThemeProductModel;
use app\api\validate\IdMustBePositiveInt;
use app\api\validate\PageParameter;
use app\api\validate\ProductAdd;
use app\api\validate\UpdateProduct;
use app\lib\exception\ParameterException;
use app\lib\exception\ProductException;
use app\lib\SuccessMessage;
use think\Db;

class Product extends BaseController
{

    protected $beforeActionList =[
        'checkSuperScope'=>['only'=>'delete'],
    ];

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

    public function getAllByPage($page=1,$size=15){
        $validate = new PageParameter();
        $validate->goCheck();

        $products = ProduceModel::getProductByPage($page,$size);

        return $products;
    }

    public function delete($id){
        $validate = new IdMustBePositiveInt();
        $validate->goCheck();
        try{
            Db::startTrans();
            ProduceModel::deleteById($id);
            ThemeProduct::where('product_id','=',$id)->delete();
            Db::commit();
            return new SuccessMessage();
        }catch (\Exception $e){
            Db::rollback();
            throw new ProductException([
                'msg'=>'删除商品失败',
                'errorCode' => '20001'
            ]);
        }
    }


    public function addProduct(){
        $data = input('post.');
        if (isset($data['theme'])){
            $themes = $data['theme'];
            unset($data['theme']);
            foreach ($themes as $v){
                if (!is_numeric($v)){
                    throw new ParameterException([
                        'msg'=>'所选主图错误',
                    ]);
                }
            }
        }
        $validate = new ProductAdd();
        if (!$validate->check($data)){
            throw new ParameterException([
               'msg'=>$validate->getError(),
            ]);
        };

        try{
            Db::startTrans();
            $pId = ProduceModel::productAdd($data);
            if (isset($themes)){
                ThemeProductModel::addProductToTheme($pId,$themes);
            }
            Db::commit();

            return new SuccessMessage();
        }catch (\Exception $e){
            Db::rollback();
            echo $e->getMessage();
        }

    }

    public function updateProduct(){
        (new UpdateProduct())->goCheck();
        $data = input('post.');
        $res = ProduceModel::update($data);

        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('修改失败');
        }
    }

    public function getAllNameAndId(){
        $res = ProduceModel::getProductAll();
        $res->hidden(['create_time','delete_time','img_id','main_img_url','price','stock','summary']);
        if ($res->isEmpty()){
            throw new ProductException();
        }else{
            return $res;
        }

    }

}

















