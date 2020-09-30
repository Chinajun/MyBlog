<?php
namespace app\blog\controller;
use think\Controller;
use think\helper\Str;
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

    /**
     * 获取全部用户（不超过7个）
     */
    public function getUsers(){
        $user = new \app\blog\model\User();
        return $user->limit(0,7)->select();
    }

    /**
     * 获取用户信息
     */
    public function getInfo(){
        $data = request()->param();
        $user = new \app\blog\model\User();
        $result = $user->getUserInfo($data,$user);
        return [
            'code' => 0,
            'data' => $result
        ];
    }

    /**
     * 修改用户信息
     * 1. 头像
     *  1.1 随机头像
     *  1.2 上传图片（更改头像后原文件删除）
     * 2. 密码
     */
    public function updateUser(){
        $data = request()->param();
        $file = request()->file("file");
        if($file){
//            $info = $file->validate(['ext' => 'jpg,jpeg'])->rule('md5')->move(ROOT_PATH . 'ux/src/assets/upload');
            $info = $file->validate(['ext' => 'jpg,jpeg'])->rule('md5')->move(ROOT_PATH . 'ux/static/album');
            if($info){
                $fileSaveName = $info->getSaveName();
                $fileSaveName = str_replace("\\",'/',$fileSaveName);
//                $data['img'] = 'upload/'.$fileSaveName;
                $data['img'] = 'album/'.$fileSaveName;
            }
        }
        $user = new \app\blog\model\User();
        if($data['oldPass']){
            $result = $user->updatePassword($data,$user);
        }else{
            $result = $user->updateImg($data,$user);
        }
        if($result==1){
            return [
                'code' => 0,
                'msg' => '修改信息成功'
            ];
        }else{
            return[
                "code"=>400,
                "msg" => $user->getError()
            ];
        }
    }
}