<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/2
 * Time: 下午7:55
 */

namespace app\api\controller\v1;


use app\api\validate\BannerItemUpdate;
use app\api\validate\IdMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\api\model\BannerItem as BannerItemModel;
use app\lib\exception\BannerMissException;
use app\lib\exception\ParameterException;
use app\lib\SuccessMessage;
use app\api\model\Image as ImageModel;
use think\Db;

class Banner
{
    public function getBanner($id)
    {
        (new IdMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new BannerMissException();
        }
        return $banner;
    }

    public function getBannerItem($id){
        (new IdMustBePositiveInt())->goCheck();
        $bannerItem = BannerItemModel::getBannerItemById($id);
        if (!$bannerItem) {
            throw new BannerMissException();
        }
        return $bannerItem;
    }



    public function updateBannerItem(){
        $data = input('post.');
        $validate = new BannerItemUpdate();
        if (!$validate->check($data)){
            throw new ParameterException();
        }

        $res = BannerItemModel::update($data);
        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('修改失败');
        }
    }

    public function updateImage(){
        $img = new Image();
        $bannerId = input('post.id');
        $res = $img->uploadMainImg();
        if ($res['code'] == 1){
            try {
                Db::startTrans();
                $image = ImageModel::create(['url' => $res['main_img_url']]);
                $imgId = $image->id;
                BannerItemModel::where('id', '=', $bannerId)->update(['img_id' => $imgId]);
                Db::commit();

                return new SuccessMessage();
            }catch (\Exception $e){
                Db::rollback();
                throw new \Exception($e->getMessage());
            }
        }
    }

}










