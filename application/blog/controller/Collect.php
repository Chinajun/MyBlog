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
        if(sizeof($data)<3){
            // 文章详情页 aid uid
            $result['collectCount'] = $collect->where('aid',$data['aid'])->count();
            $isCollect = $collect->where('uid',$data['uid'])->where('aid',$data['aid'])->select();
            if($isCollect){
                $result['isCollect'] = true;
            }else{
                $result['isCollect'] = false;
            }
        }else{
            // 我的收藏页 uid page search
            $article = new \app\blog\model\Article();
            $aidCount = $collect->where('uid',$data['uid'])->select();
            foreach ($aidCount as $key=>$val){
                $aid[$key] = $val['aid'];
            }
            $keyWord['Id'] = ['in',$aid];
            $map = [];
            $map['title'] = ['like','%'.$data['search'].'%'];
            $map['username'] = ['like','%'.$data['search'].'%'];
            $result = $article->getArticleList($keyWord,$map,$data,$article);
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