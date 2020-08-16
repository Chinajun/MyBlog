<?php
namespace app\blog\controller;
use think\Controller;
use think\Request;
use think\Session;

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
        $result = $user->login($data,$user,$authKey,$paramArr);
        Session::set('user_id', $data['userInfo']['id']);
        if (!$result) {
            return [
                "code" => 400,
                "msg" => $user->getError()
            ];
        }
        return [
            "code" => 0,
            "msg"=>"嗨，".$result['userInfo']['username'],
            "data" => $result
        ];
    }

    /**
     * 退出登录
     * @return mixed
     */
    public function logout()
    {
        $data = request()->param();
        $platform = $data['platform'] ? '_'.$data['platform'] : ''; //请求平台(mobile,ding)
        $cache = cache('Auth_'.$authKey.$platform,null);
        session('user_id','null');
        return [
            'code' => 0,
            'msg' => '退出成功'
        ];
    }
}