<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/6
 * Time: 下午10:19
 */

namespace app\api\model;



class Image extends BaseModel
{
    //隐藏字段
    protected $hidden = ['id','from','delete_time','update_time'];

    //读取器设置url字段前缀
    public function getUrlAttr($value,$data){
        return $this->prefixUrl($value,$data);
    }

}