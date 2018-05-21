<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/5/9
 * Time: 上午8:34
 */

namespace app\api\controller\v1;


use app\api\model\User as UserModel;
use app\api\model\User;
use app\api\validate\AddressNew;
use app\lib\exception\UserException;
use app\lib\SuccessMessage;
use app\api\service\Token as TokenService;
use app\api\model\UserAddress as UserAddressModel;

class Address extends BaseController
{

    protected $beforeActionList =[
        'checkPrimaryScope'=>['only'=>'createOrUpdateAddress,getUserAddress']
    ];


    public function getUserAddress(){
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }

        $userAddress = UserAddressModel::where('user_id','=',$uid)->find();

        if (!$userAddress){
            throw new UserException([
                'msg'=>'用户地址不存在',
                'errorCode'=>60001
            ]);
        }

        return $userAddress;
    }



    public function createOrUpdateAddress(){
        $validate = new AddressNew();
        $validate->goCheck();

        //获取token得到uid
        //根据uid，判断用户是否存在，不存在抛异常
        //获取用户从客户端提交的信息
        //判断之前是否存在地址，执行新增或者更新
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }
        $data = $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;

        if (!$userAddress){
            $user->address()->save($data);
        }else{
            $user->address->save($data);
        }

        return json(new SuccessMessage(),201);

    }
}











