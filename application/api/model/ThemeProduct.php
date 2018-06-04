<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/6/2
 * Time: 下午8:48
 */

namespace app\api\model;


use think\Model;

class ThemeProduct extends Model
{
    public static function addProductToTheme($pId, $themes){
        try{
            foreach ($themes as $theme){
                self::create(['theme_id'=>$theme,'product_id'=>$pId]);
            }
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}