<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/2
 * Time: 下午11:41
 */

namespace app\api\controller\v1;


use app\api\validate\IdMustBePositiveInt;
use app\api\model\ProductProperty as ProductPropertyModel;
use app\api\validate\PropertyAdd;
use app\lib\exception\ParameterException;
use app\lib\SuccessMessage;

class ProductProperty
{

    //删除一条商品属性
    public function deleteProperty($id){
        (new IdMustBePositiveInt())->goCheck();

        $res = ProductPropertyModel::where('id','=',$id)->delete();

        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('删除失败');
        }
    }

    public function addProperty(){
       $data = input('post.');
       $validate = new PropertyAdd();
       if (!$validate->check($data)){
           throw new ParameterException([
               'msg' => $validate->goCheck()
           ]);
       }
       try{
           $res = ProductPropertyModel::create($data);
       }catch (\Exception $e){
           throw new \Exception('增加失败');
       }
       if ($res){
           return new SuccessMessage();
       }else{
           throw new \Exception('增加失败');
       }
    }
}















