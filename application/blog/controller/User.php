<?php
namespace app\blog\controller;
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
        $data = request()->param();
        $user = new \app\blog\model\User();
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

    /**
     * 验证器
     */
    public function validateUser(){
        $data = request()->param();
        $user = new \app\blog\model\User();
        $result = $user->userSelect($data,$user);
        if($result){
            return[
                "code"=>0,
                "msg"=>$data['type']."已被注册"
            ];
        }else{
            return[
                "code"=>400,
                "msg"=>$data['type']."未被注册"
            ];
        }
    }

    /**
     * 用户登录
     */
    public function login(){
        $data = request()->param();
        $user = new \app\blog\model\User();
        $result = $user->login($data,$user);
        if($result==401){
            return[
                "code"=>401,
                "msg"=>"密码错误"
            ];

        }else if($result==402){
            return[
                "code"=>402,
                "msg"=>"该手机号没有注册"
            ];
        }else{
            return[
                "code" => 0,
                "msg"=>"嗨，".$result,
                "username"=>$result
            ];
        }
    }
}