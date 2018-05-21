<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午3:58
 */

namespace app\api\model;


class Product extends BaseModel
{
    //隐藏字段
    protected $hidden = ['delete_time','update_time','category_id','from','create_time','pivot'];

    public function getMainImgUrlAttr($value ,$data){

        return $this->prefixUrl($value,$data);
    }

    //关联图片表
    public function imgs(){
        return $this->hasMany('ProductImage','product_id','id');
    }

    //关联详细信息表
    public function detail(){
        return $this->hasMany('ProductProperty','product_id','id');
    }

    //获取最新
    public static function getMostRecent($count){
        return self::limit($count)->order('create_time desc')->select();
    }

    //根据分类获取
    public static function getProductByCategoryId($id){
        return self::where('category_id','=',$id)->select();
    }

    //获取单个商品详情
    public static function getProductDetail($id){
        return self::with([
            'imgs'=>function($query){
                $query->with(['imageUrl'])->order('order','asc');
            }
        ])
            ->with(['detail'])
            ->find($id);
    }
}

