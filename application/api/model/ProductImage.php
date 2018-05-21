<?php

namespace app\api\model;


class ProductImage extends BaseModel
{
    //
    protected $hidden = ['id','delete_time','product_id','img_id'];

    public function imageUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}
