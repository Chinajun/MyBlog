<?php
namespace app\blog\model;
use com\verify\HonrayVerify;
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
                'password' => substr(md5($data['password']),8,16),
                'phone' => $data['phone'],
                'create_time' => $data['create_time'],
                'img' => $data['img']
            ]);
            return $user->save();
        }catch (\Exception $e){
            $this->error = '出现错误';
            return false;
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
    public function login($data,$user,$authKey='',$paramArr = [])
    {
        $userInfo = $user->where('phone', $data['phone'])->find();
        if (!$userInfo) {
            $this->error = '帐号不存在';
            return false;
        }
        if (substr(md5($data['password']), 8, 16) !== $userInfo['password']) {
            $this->error = '密码错误';
            return false;
        }

        //登录有效时间
        $cacheConfig = config('cache');
        $loginExpire = $cacheConfig['expire'] ?: 86400 * 3;

        session_start();
        $info['userInfo'] = $userInfo;
        $info['sessionId'] = session_id();
        $authKey = substr(md5($userInfo['password'] . $info['sessionId']), 8, 16);
        $info['authKey'] = $authKey;

        $platform = $paramArr['platform'] ? '_' . $paramArr['platform'] : ''; //请求平台(mobile,ding)
        //删除旧缓存
        if (cache('Auth_' . $userInfo['authkey'] . $platform)) {
            cache('Auth_' . $userInfo['authkey'] . $platform, NULL);
        }
        cache('Auth_' . $authKey . $platform, $info, $loginExpire);
        unset($userInfo['authkey']);

        // 返回信息
        $result['authKey'] = $authKey;
        $result['sessionId'] = $info['sessionId'];
        $result['userInfo'] = $userInfo;
        $result['loginExpire'] = $loginExpire;

        //保存authKey信息
        $userData = [];
        $userData['authkey'] = $authKey;
        $userData['authkey_time'] = time() + $loginExpire;
        return $result;
    }

    /**
     * 根据Id获取用户信息
     */
    public function getUserInfo($data,$user){
        return $user->where('Id','in',$data)->select();
    }

    /**
     * 更新用户信息
     */
    public function updateUser($data,$user){
        try {
            if($data['oldPass']){
                // 修改密码
                $map = [];
                $userInfo = $user->where('Id',$data['Id'])->find();
                if (substr(md5($data['oldPass']), 8, 16) !== $userInfo['password']) {
                    $this->error = '初始密码错误';
                    return false;
                }else{
                    $map['password'] = substr(md5($data['newPass']),8,16);
                }
            }else{
                // 修改头像
                $map = $data;
                unset($map['Id']);
            }
            return $user->where('Id',$data['Id'])->update($map);
        }catch (\Exception $e){
            $this->error = '出现错误';
            return false;
        }
    }
}