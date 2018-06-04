<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午6:43
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\api\validate\CategoryAdd;
use app\api\validate\CategoryUpdate;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\CategoryException;
use app\lib\exception\ParameterException;
use app\lib\SuccessMessage;
use app\api\model\Product as ProductModel;
use think\Db;
use app\api\model\Image as ImageModel;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::where('delete_time','neq',1)->order('list_order desc')->with('img')->select();
        if($categories->isEmpty()){
            throw new CategoryException();
        };
        return $categories;
    }

    public function getCategoryById($id){
        (new IdMustBePositiveInt())->goCheck();
        $category = CategoryModel::where('delete_time','neq',1)
            ->with('img')
            ->find($id);
        if(!$category){
            throw new CategoryException();
        };
        return $category;
    }


    public function updateCategory(){
        $data = input('post.');
        $validate = new CategoryUpdate();
        if (!$validate->check($data)){
            throw new ParameterException([
                'msg' => $validate->getError()
            ]);
        }

        $res = CategoryModel::update($data);
        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('修改失败');
        }
    }

    public function delCategory($id){
        (new IdMustBePositiveInt())->goCheck();

        $products = ProductModel::getProductByCategoryId($id);

        if (!$products->isEmpty()){
            return [
                'code' => 0,
                'msg' => '该分类下还有商品，不能删除',
            ];
        }else{
            $res = CategoryModel::where('id','=',$id)->update(['delete_time'=>1]);
            if ($res){
                return new SuccessMessage();
            }else{
                return [
                    'code' => 0,
                    'msg' => '删除失败',
                ];
            }
        }
    }


    public function updateImage(){
        $img = new Image();
        $categoryId = input('post.id');
        $res = $img->uploadMainImg();
        if ($res['code'] == 1){
            try {
                Db::startTrans();
                $image = ImageModel::create(['url' => $res['main_img_url']]);
                $imgId = $image->id;
                CategoryModel::where('id', '=', $categoryId)->update(['topic_img_id' => $imgId]);
                Db::commit();

                return new SuccessMessage();
            }catch (\Exception $e){
                Db::rollback();
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function categoryAdd(){
        $data = input('post.');
        $validate = new CategoryAdd();
        if (!$validate->check($data)){
            throw new ParameterException([
                'msg' => $validate->goCheck()
            ]);
        }

        try{
            Db::startTrans();
            $img = ImageModel::create(['url'=>$data['topic_img_url']]);
            $imgId = $img->id;
            CategoryModel::create(['name'=>$data['name'],'topic_img_id'=>$imgId]);
            Db::commit();

            return new SuccessMessage();
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

}












