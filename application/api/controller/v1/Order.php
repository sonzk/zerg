<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 下午5:20
 */

namespace app\api\controller\v1;



use app\api\validate\IdMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PageParameter;
use app\lib\enum\ScopeEnum;
use app\lib\exception\OrderException;
use app\api\service\Order as OrderService;
use app\api\service\Token as TokenService;
use app\api\model\Order as OrderModel;
use app\lib\SuccessMessage;

class Order extends BaseController
{

    protected $beforeActionList =[
        'checkExclusiveScope'=>['only'=>'placeOrder'],
        'checkPrimaryScope'=>['only'=>'getDetail,getSummaryByUser']
    ];


    public function placeOrder(){
        $validate = new OrderPlace();
        $validate->goCheck();

        $oProducts = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid,$oProducts);
        return $status;
    }

    public function getSummaryByUser($page=1,$size=15){
        $validate = new PageParameter();
        $validate->goCheck();

        $uid = TokenService::getCurrentUid();
        $paginateOrder = OrderModel::getSummaryByUser($uid,$page,$size);
        if ($paginateOrder->isEmpty()){
            return [
                'data'=>[],
                'current_page'=>$paginateOrder->currentPage(),
            ];
        }
        $data = $paginateOrder->hidden(['snap_items','snap_address','prepay_id'])->toArray();
        return [
            'data'=>$data,
            'current_page'=>$paginateOrder->currentPage()
        ];
    }

    public function getDetail($id){
        $validate = new IdMustBePositiveInt();
        $validate->goCheck();

        $orderDetail = OrderModel::get($id);
        $uid = TokenService::getCurrentUid();
        $scope = TokenService::getCurrentUserScope();
        if ($scope != ScopeEnum::SUPER){
            if ($orderDetail->user_id != $uid){
                throw new OrderException(['msg'=>'非本人订单']);
            }
        }

        if (!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }

    public function getSummary($page=1,$size=15){
        $validate = new PageParameter();
        $validate->goCheck();

        $paginateOrder = OrderModel::getSummaryByPage($page,$size);
        if ($paginateOrder->isEmpty()){
            return [
                'data'=>[],
                'current_page'=>$paginateOrder->currentPage(),
            ];
        }
        $data = $paginateOrder->hidden(['snap_items','snap_address'])->toArray();
        return [
            'data'=>$data,
            'current_page'=>$paginateOrder->currentPage()
        ];
    }

    public function delivery($id){
        (new IdMustBePositiveInt())->goCheck();

        $order = new OrderService();
        $success = $order->delivery($id);
        if ($success){
            return new SuccessMessage();
        }
    }
}







