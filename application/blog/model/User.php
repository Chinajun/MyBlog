<?php
namespace app\blog\model;
use think\Model;
/**
 * 用户Model
 */
class User extends Model
{
    /**
     * 用户注册
     */
    public function register($data,$user){
        try {
            $user->data([
                'username' => $data['username'],
                'password' => $data['password'],
                'phone' => $data['phone'],
                'create_time' => $data['create_time']
            ]);
            return $user->save();
        }catch (\Exception $e){
            return[
                "code"=>400,
                "msg"=>"注册失败"
            ];
        }
    }

    /**
     * 验证是否重复（用户名、手机号）
     */
    public function userSelect($data,$user){
        return $user->where($data['type'],$data['value'])->find();
    }

    /**
     * 用户登录（查找用户信息）
     */
    public function login($data,$user){
        $res = $user->where('phone',$data['phone'])->find();
        if($res){
            if($res['password']==$data['password']){
                session('user_info',$res);
                return $res['username'];//登陆成功
            }else{
                return 401;//密码错误
            }
        }else{
            return 402;//没有注册
        }
    }
}