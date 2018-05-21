<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午3:57
 */

namespace app\api\model;


class Theme extends BaseModel
{

    //隐藏字段
    protected $hidden = ['delete_time','update_time','head_img_id','topic_img_id'];

    //关联图片url
    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }

    //关联商品
    public function products(){
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    //获取theme
    public static function getTheme($ids){
        $ids = explode(',',$ids);

        return self::with('topicImg,headImg')->select($ids);
    }

    //获取某一个theme下的product
    public static function getThemeWithProducts($id){
        return self::with('products,topicImg,headImg')->find($id);
    }
}




















