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
                'create_time' => $data['create_time']
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
    public function login($data,$user,$authKey='',$paramArr = []){
        $userInfo = $user->where('phone',$data['phone'])->find();
        if (!$userInfo) {
            $this->error = '帐号不存在';
            return false;
        }
        if (substr(md5($data['password']),8,16) !== $userInfo['password']) {
            $this->error = '密码错误';
            return false;
        }

        //登录有效时间
        $cacheConfig = config('cache');
        $loginExpire = $cacheConfig['expire'] ? : 86400*3;

        session_start();
        $info['userInfo'] = $userInfo;
        $info['sessionId'] = session_id();
        $authKey = substr(md5($userInfo['password'].$info['sessionId']),8,16);
        $info['authKey'] = $authKey;

        $platform = $paramArr['platform'] ? '_'.$paramArr['platform'] : ''; //请求平台(mobile,ding)
        //删除旧缓存
        if (cache('Auth_'.$userInfo['authkey'].$platform)) {
            cache('Auth_'.$userInfo['authkey'].$platform, NULL);
        }
        cache('Auth_'.$authKey.$platform, $info, $loginExpire);
        unset($userInfo['authkey']);

        // 返回信息
        $result['authKey']		= $authKey;
        $result['sessionId']		= $info['sessionId'];
        $result['userInfo']		= $userInfo;
        $result['loginExpire']	= $loginExpire;

        //保存authKey信息
        $userData = [];
        $userData['authkey'] = $authKey;
        $userData['authkey_time'] = time()+$loginExpire;
        return $result;
//        if($res){
//            if($res['password']==$data['password']){
//                session('user_info',$res);
//                return $res['username'];//登陆成功
//            }else{
//                return 401;//密码错误
//            }
//        }else{
//            return 402;//没有注册
//        }
    }

//    public function login($username, $password, $authKey = '', $paramArr = [])
//    {
//        $map['username'] = $username;
//        $map['type'] = 1;
//        $userInfo = $this->where($map)->find();
//
//        if (!$userInfo) {
//            $this->error = '帐号不存在';
//            return false;
//        }
//        $userInfo['thumb_img'] = $userInfo['thumb_img'] ? getFullPath($userInfo['thumb_img']) : '';
//        if (user_md5($password, $userInfo['salt'], $userInfo['username']) !== $userInfo['password'] && !$paramArr['dingCode']) {
//            $this->error = '密码错误';
//            return false;
//        }
//
//        //登录有效时间
//        $cacheConfig = config('cache');
//        $loginExpire = $cacheConfig['expire'] ? : 86400*3;
//
//        // 保存缓存
//        session_start();
//        $info['userInfo'] = $userInfo;
//        $info['sessionId'] = session_id();
//        $authKey = user_md5($userInfo['username'].$userInfo['password'].$info['sessionId'], $userInfo['salt']);
//        // $info['_AUTH_LIST_'] = $dataList['rulesList'];
//        $info['authKey'] = $authKey;
//
//        $platform = $paramArr['platform'] ? '_'.$paramArr['platform'] : ''; //请求平台(mobile,ding)
//        //删除旧缓存
//        if (cache('Auth_'.$userInfo['authkey'].$platform)) {
//            cache('Auth_'.$userInfo['authkey'].$platform, NULL);
//        }
//        cache('Auth_'.$authKey.$platform, $info, $loginExpire);
//        unset($userInfo['authkey']);
//
//        // 返回信息
//        $data['authKey']		= $authKey;
//        $data['sessionId']		= $info['sessionId'];
//        $data['userInfo']		= $userInfo;
//        $data['loginExpire']	= $loginExpire;
//
//        //保存authKey信息
//        $userData = [];
//        $userData['authkey'] = $authKey;
//        $userData['authkey_time'] = time()+$loginExpire;
//        //把状态未激活至为启用
//        return $data;
//    }
}