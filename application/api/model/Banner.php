<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/3
 * Time: 下午4:55
 */

namespace app\api\model;



class Banner extends BaseModel
{
    //隐藏字段
    protected $hidden = ['delete_time','update_time'];

    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

    //根据id查询banner，多表查询
    public static function getBannerById($id){
        return self::with([
            'items'=>function($query){
                $query->order('list_order desc')->with(['img']);
            }
        ])->find($id);
    }
}