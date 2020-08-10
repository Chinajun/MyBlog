<?php
namespace app\blog\model;
use think\Model;
/**
 * 用户Model
 */
class UserModel extends Model
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
}