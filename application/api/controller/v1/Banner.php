<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/2
 * Time: 下午7:55
 */

namespace app\api\controller\v1;


use app\api\validate\IdMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;


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

}