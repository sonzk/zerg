<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/7
 * Time: 下午3:57
 */

namespace app\api\controller\v1;


use app\api\validate\IdCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IdMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{

    /**
     * $ids 一组ID号 1，2，3
     * url theme?ids=1,2,3....
     * return 一组theme 模型
     */
    public function getSimpleList($ids=''){
        (new IdCollection())->goCheck();

        $theme = ThemeModel::getTheme($ids);

        if ($theme->isEmpty()){
            throw new ThemeException();
        }
        return $theme;
    }

    /**
     *  $id theme的id  通过id查询theme下的product
     * url 路由 /theme/:id
     * return product数据
     */
    public function getComplexOne($id){
        (new IdMustBePositiveInt())->goCheck();

        $themeProducts = ThemeModel::getThemeWithProducts($id);

        if (!$themeProducts){
            throw new ThemeException();
        }
        return $themeProducts;
    }
}
















