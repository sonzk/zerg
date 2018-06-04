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
use app\api\validate\ThemeProductAdd;
use app\api\validate\ThemeUpdate;
use app\lib\exception\ParameterException;
use app\lib\exception\ThemeException;
use app\lib\SuccessMessage;
use think\Db;
use app\api\model\Image as ImageModel;
use app\api\model\ThemeProduct as ThemeProductModel;
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

    public function updateTheme(){
        $data = input('post.');
        $validate = new ThemeUpdate();
        if (!$validate->check($data)){
            throw new ParameterException([
                'msg' => $validate->getError()
            ]);
        }

        $res = ThemeModel::update($data);
        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('修改失败');
        }
    }


    public function updateImage(){
        $data = input('post.');
        $img = new Image();

        $res = $img->uploadMainImg();

        if ($res['code'] == 1){
            try {
                Db::startTrans();
                $image = ImageModel::create(['url' => $res['main_img_url']]);
                $imgId = $image->id;
                if ($data['type'] == 'topic_img'){
                    ThemeModel::where('id', '=', $data['id'])->update(['topic_img_id' => $imgId]);
                }else if ($data['type'] == 'head_img'){
                    ThemeModel::where('id', '=', $data['id'])->update(['head_img_id' => $imgId]);
                }
                Db::commit();

                return new SuccessMessage();
            }catch (\Exception $e){
                Db::rollback();
                throw new \Exception($e->getMessage());
            }
        }
    }


    public function addProductToTheme(){
        $data = input('post.');
        $validate = new ThemeProductAdd();
        if (!$validate->check($data)){
            throw new ParameterException([
                'msg' => $validate->getError(),
            ]);
        }
        $result = ThemeProductModel::where($data)->find();

        if ($result){
            return [
                'code' => 0,
                'msg' => '商品已存在该主题中',
            ];
        }else{
            $res = ThemeProductModel::create($data);
            if ($res){
                return new SuccessMessage();
            }else{
                return [
                    'code' => 0,
                    'msg' => '添加失败',
                ];
            }
        }
    }

    public function moveProduct(){
        $data = input('post.');
        $validate = new ThemeProductAdd();
        if (!$validate->check($data)){
            throw new ParameterException([
                'msg' => $validate->getError(),
            ]);
        }
        $res = ThemeProductModel::where($data)->delete();
        if ($res){
            return new SuccessMessage();
        }else{
            throw new \Exception('删除失败');
        }
    }


}
















