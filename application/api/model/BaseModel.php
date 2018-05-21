<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //公共url前缀
    public function prefixUrl($value,$data){
        $image_url = $value;

        if ($data['from'] == 1 ){
            $image_url =  config('setting.images_prefix').$value;
        }
        return $image_url;
    }
}
