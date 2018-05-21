<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午4:09
 */

namespace app\api\validate;


class IdCollection extends BaseValidate
{

    protected $rule = [
        'ids'=>'require|checkIds'
    ];

    protected $message = [
        'ids.require' => 'ids参数不能为空',
        'ids.checkIds' => 'ids应为以逗号分隔的正整数'
    ];


    protected function checkIds($value){
        $ids = explode(',',$value);
        if(empty($ids)){
            return false;
        }
        foreach ($ids as $id){
            if (!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }


}