<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/2
 * Time: 下午7:55
 */

namespace app\api\controller\v2;


use app\api\validate\IdMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;


class Banner
{
    public function getBanner($id)
    {
        return 'aa';


    }
}