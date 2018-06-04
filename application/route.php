<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------




use think\Route;


Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');
Route::get('api/:version/banner_item/:id','api/:version.Banner/getBannerItem');
Route::post('api/:version/banner/item_update','api/:version.Banner/updateBannerItem');
Route::post('api/:version/banner/update_img','api/:version.Banner/updateImage');

Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');
Route::post('api/:version/theme/img_update','api/:version.Theme/updateImage');
Route::post('api/:version/theme/update','api/:version.Theme/updateTheme');
Route::post('api/:version/theme/add_product','api/:version.Theme/addProductToTheme');
Route::post('api/:version/theme/move_product','api/:version.Theme/moveProduct');


//Route::get('api/:version/product/recent','api/:version.Product/getRecent');
//Route::get('api/:version/product/by_category','api/:version.Product/getAllByCategoryId');
//Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//Route::get('api/:version/product/recent','api/:version.Product/getRecent');

Route::group('api/:version/product',function (){
    Route::get('/by_category','api/:version.Product/getAllByCategoryId');
    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
    Route::get('/recent','api/:version.Product/getRecent');
    Route::get('/paginate','api/:version.Product/getAllByPage');
    Route::delete('/delete/:id','api/:version.Product/delete');
    Route::post('/add','api/:version.Product/addProduct');
    Route::post('/update','api/:version.Product/updateProduct');
    Route::get('/all_name_id','api/:version.Product/getAllNameAndId');
});


Route::get('api/:version/category/all','api/:version.Category/getAllCategories');
Route::get('api/:version/category/:id','api/:version.Category/getCategoryById');
Route::post('api/:version/category/update','api/:version.Category/updateCategory');
Route::delete('api/:version/category/del/:id','api/:version.Category/delCategory');
Route::post('api/:version/category/img_update','api/:version.Category/updateImage');
Route::post('api/:version/category/add','api/:version.Category/categoryAdd');


Route::post('api/:version/token/user','api/:version.Token/getToken');
Route::post('api/:version/token/verify','api/:version.Token/verifyToken');
Route::post('api/:version/token/app','api/:version.Token/getAppToken');


Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address','api/:version.Address/getUserAddress');



Route::post('api/:version/order','api/:version.Order/placeOrder');
Route::get('api/:version/order/by_user','api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/:id','api/:version.Order/getDetail',[],['id'=>'\d+']);
Route::get('api/:version/order/paginate','api/:version.Order/getSummary');
Route::post('api/:version/order/delivery','api/:version.Order/delivery');
Route::get('api/:version/order/by_status','api/:version.Order/getOrderListByStatus');



Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');



Route::post('api/:version/image/product_images','api/:version.Image/productImages');
Route::delete('api/:version/image/product_images_del/:id','api/:version.Image/productImageDel');
Route::get('api/:version/image/product_images_order','api/:version.Image/productImageListOrder');
Route::post('api/:version/image/product_main_img','api/:version.Image/updateProductMainImg');
Route::post('api/:version/image/upload','api/:version.Image/uploadMainImg');


Route::delete('api/:version/product_property/property_del/:id','api/:version.ProductProperty/deleteProperty');
Route::post('api/:version/product_property/add','api/:version.ProductProperty/addProperty');