<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/11
 * Time: 下午3:25
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $hidden = ['delete_time','update_time'];

    public static function getSummaryByUser($uid,$page=1,$size=15){
       $paginate = self::where('user_id','=',$uid)
            ->order('create_time desc')
            ->paginate($size,true,['page'=>$page]);
        return $paginate;
    }


    public static function getSummaryByPage($page=1,$size=15){
        $paginate = self::order('create_time desc')
            ->paginate($size,true,['page'=>$page]);
        return $paginate;
    }


    protected function getSnapItemsAttr($value){
        if (empty($value)){
            return null;
        }
        return json_decode($value);
    }


    protected function getSnapAddressAttr($value){
        if (empty($value)){
            return null;
        }
        return json_decode($value);
    }

    public static function getListByStatus($status,$page=1,$size=15){
        $paginate = self::where('status','=',$status)->order('create_time desc')
            ->paginate($size,true,['page'=>$page]);
        return $paginate;
    }

}