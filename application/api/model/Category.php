<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午6:44
 */

namespace app\api\model;


class Category extends BaseModel
{

    //隐藏字段
    protected $hidden = ['update_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }

}