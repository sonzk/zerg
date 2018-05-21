<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/6
 * Time: 下午6:32
 */

namespace app\api\model;



class BannerItem extends BaseModel
{
    //隐藏字段
    protected $hidden = ['delete_time','update_time'];

    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}