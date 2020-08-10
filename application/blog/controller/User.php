<?php
namespace app\blog\controller;
use app\blog\model\UserModel;
use think\Controller;
/**
 * 用户Controller
 */
class User extends Controller
{
    /**
     * 用户注册
     */
    public function register(){
        $data = request()->only(['username','password','phone','create_time']);
        $user = new UserModel();
        $result = $user->register($data,$user);
        if($result==1){
            return[
                "code"=>0,
                "msg"=>"注册成功，用户".$data['username']
            ];
        }else{
            return[
                "code"=>400,
                "msg"=>"注册失败，用户名已被占用"
            ];
        }
    }
}