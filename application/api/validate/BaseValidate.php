<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/3
 * Time: 下午2:45
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{

    public function goCheck(){

        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);

        if (!$result){
//
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);
            throw $e;
        }else{
            return true;
        }
    }

    protected function isPositiveInteger($value,$rule='',$data='',$field=''){

        if(is_numeric($value) && is_int($value+0 ) && ($value + 0) >0){
            return true;

        }else{
            return false;
        }
    }

    protected function isMobile($value,$rule=''){

        $rule = '/^1(3|4|5|6|7|8|9)\d{9}$/';

        $result = preg_match($rule,$value);
        if ($result){
            return true;
        }else{
            return false;
        }

    }

    protected function isNotEmpty($value){
        if (empty($value)){
            return false;
        }else{
            return true;
        }
    }

    //根据规则获取数据，只获取规则里有的数据
    public function getDataByRule($array){
        if (array_key_exists('user_id',$array) || array_key_exists('uid',$array)){
            throw new ParameterException([
                'msg'=>'参数包含非法参数'
            ]);
        }

        $newArr = [];
        foreach ($this->rule as $key => $value) {

            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }



}














