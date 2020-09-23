<?php
namespace app\blog\controller;
use think\Controller;

class Collect extends Controller{
    /**
     * 获取收藏数据(文章详情页，我的收藏页)
     */
    public function getCollect(){
        $data = request()->param();
        $collect = new \app\blog\model\Collect();
        $result['collectCount'] = $collect->where('aid',$data['aid'])->count();
        $isCollect = $collect->where('uid',$data['uid'])->where('aid',$data['aid'])->select();
        if($isCollect){
            $result['isCollect'] = true;
        }else{
            $result['isCollect'] = false;
        }
        return[
            'code' => 0,
            'data' => $result,
            'msg' => '获取收藏数据成功'
        ];
    }

    /**
     * 新增/取消收藏
     */
    public function handleCollect(){
        $data = request()->param();
        $collect = new \app\blog\model\Collect();
        $isCollect = $collect->where('uid',$data['uid'])->where('aid',$data['aid'])->select();
        if($isCollect){ // 已收藏->取消收藏
            $result = $collect->where('uid',$data['uid'])->where('aid',$data['aid'])->delete();
            if($result){
                return[
                    'code' => 0,
                    'msg' => '取消收藏成功'
                ];
            }else{
                return[
                    'code' => 400,
                    'msg' => '取消收藏失败'
                ];
            }
        }else{ // 未收藏->新增收藏
            $result = $collect->save(['uid'=>$data['uid'],'aid'=>$data['aid']]);
            if($result){
                return[
                    'code' => 0,
                    'msg' => '收藏成功'
                ];
            }else{
                return[
                    'code' => 400,
                    'msg' => '收藏失败'
                ];
            }
        }
    }
}