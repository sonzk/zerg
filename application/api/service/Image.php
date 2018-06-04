<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/1
 * Time: 下午9:08
 */

namespace app\api\service;
use app\api\model\Image as ImageModel;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;
use app\api\model\ProductImage as ProductImageModel;
use think\Db;

class Image
{
    public static function uploadImageInProduct($file){
        $name = $file->getInfo()['name'];
        $pId = pathinfo($name,PATHINFO_FILENAME);
        $product = ProductModel::get($pId);

        if (!$product){
            throw new ProductException();
        }

        $res = $file->move('images');
        if ($res){
            try{
                Db::startTrans();
                $url = '/'.$res->getSaveName();
                $img = ImageModel::create(['url'=>$url]);
                $imgId = $img->id;
                ProductImageModel::create(['img_id'=>$imgId,'product_id'=>$pId]);
                Db::commit();

                return true;
            }catch (\Exception $e){
                Db::rollback();
                throw new \Exception($e->getMessage());
            }

        }else{
            return false;
        }

    }


    public static function delProductImage($productImageId){
        try{
            Db::startTrans();
            $productImage = ProductImageModel::get($productImageId);
            if (!$productImage){
                throw new ProductException([
                    'msg'=>'对应的商品图片不存在',
                ]);
            }

            $img_id = $productImage->img_id;
            ImageModel::where('id','=',$img_id)->update(['delete_time'=>1]);
            ProductImageModel::where('id','=',$productImageId)->update(['delete_time'=>1]);
            Db::commit();
            return true;
        }catch (\Exception $e){
            Db::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public static function updateProductImgOrder($id,$order){
        $productImage = ProductImageModel::get($id);
        if (!$productImage){
            throw new ProductException([
                'msg'=>'对应的商品图片不存在',
            ]);
        }

        if ($productImage->order == $order){
            throw new \Exception('没有改变');
        }
        $productImage->order = $order;
        $res = $productImage->save();

        if ($res){
            return true;
        }else{
            return false;
        }
    }

    public static function updateProductMainImg($id,$file){
        $product = ProductModel::get($id);
        if (!$product){
            throw new ProductException();
        }

        $res = $file->move('images');

        if ($res){
            try{
                Db::startTrans();
                $url = '/'.$res->getSaveName();
                $img = ImageModel::create(['url'=>$url]);
                $imgId = $img->id;

                $product->main_img_url = $url;
                $product->img_id = $imgId;
                $product->save();
                Db::commit();

                return true;
            }catch (\Exception $e){
                Db::rollback();
                throw new \Exception($e->getMessage());
            }
        }else{
            return false;
        }
    }



}








