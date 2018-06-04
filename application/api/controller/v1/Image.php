<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/1
 * Time: 上午12:50
 */

namespace app\api\controller\v1;


use app\api\validate\IdMustBePositiveInt;
use app\api\validate\ImageListOrder;
use app\lib\SuccessMessage;
use think\Exception;
use app\api\service\Image as ImageService;

class Image extends BaseController
{

    //产品详情图，上传图片名为商品id
    public function productImages(){
        $file = request()->file('file');
        $res = ImageService::uploadImageInProduct($file);

        if ($res){
            return new SuccessMessage();

        }else{
            throw new Exception('上传失败');
        }
   }

   //id为productImage表的id
   public function productImageDel($id){
       (new IdMustBePositiveInt())->goCheck();


       $res = ImageService::delProductImage($id);
       if ($res){
           return new SuccessMessage();
       }else{
           throw new Exception('删除失败');
       }
   }

   public function productImageListOrder($id,$order){
       (new ImageListOrder())->goCheck();

       $res = ImageService::updateProductImgOrder($id,$order);

       if ($res){
           return new SuccessMessage();
       }else{
           throw new Exception('更新失败');
       }
   }

   //更新商品主图
   public function updateProductMainImg($id){
       (new IdMustBePositiveInt())->goCheck();
       $file = request()->file('file');
       $res = ImageService::updateProductMainImg($id,$file);

       if ($res){
           return new SuccessMessage();
       }else{
           throw new \Exception('上传失败');
       }
   }


   //添加主图通用
   public function uploadMainImg(){
        $file = request()->file('file');
        $res = $file->move('images');
        $url = '/'.$res->getSaveName();
        if ($res){
            return [
                'code' => 1,
                'main_img_url' => $url
            ];
        }else{
            throw new \Exception('上传失败');
        }
   }


}















