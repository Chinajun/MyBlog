<?php
namespace app\blog\controller;
use think\Controller;

class Comment extends Controller
{
    /**
     * 获取评论
     * 留言板aid=0,父评论pid=0
     */
    public function getComment(){
        $data = request()->param();
        $comment = new \app\blog\model\Comment();
        $user = new \app\blog\model\User();
        $count = $comment->where('aid',$data['aid'])->where('pid',0)->count();
        // 获取本页父留言
        $result_fa = $comment->where('aid',$data['aid'])->where('pid',0)
            ->limit(($data['page']-1)*10,10)->order("create_time desc")->select();
        $pid[] = "";
        $uid[] = "";
        // 格式化时间戳，存入pid和uid
        foreach($result_fa as $key=>$val){
            $uid[$key] = $val['uid'];
            $pid[$key] = $val['Id'];
            $result_fa[$key]['create_time'] = date('Y-m-d H:i:s',$val['create_time']);
        }
        // 根据pid获取子评论
        $result_son = $comment->where('aid',$data['aid'])->where('pid','in',$pid)
            ->order("create_time desc")->select();
        // 子评论的用户信息和时间戳格式化
        foreach($result_son as $key=>$val){
            array_push($uid,$val['uid']);
            $result_son[$key]['create_time'] = date('Y-m-d H:i:s',$val['create_time']);
        }
        // 获取用户信息(uid=0的是游客，给游客一个默认头像tx4)
        $userInfo = $user->getUserInfo($uid,$user);
        foreach ($result_fa as $key=>$val){
            if($val['uid']==0){
                $result_fa[$key]['username'] = "游客";
                $result_fa[$key]['img'] = "tx4.jpg";
            }else{
                foreach ($userInfo as $k=>$v){
                    if($val['uid']==$v['Id']){
                        $result_fa[$key]['username'] = $v['username'];
                        $result_fa[$key]['img'] = $v['img'];
                    }
                }
            }
        }
        foreach ($result_son as $key=>$val){
            if($val['uid']==0){
                $result_son[$key]['username'] = "游客";
                $result_son[$key]['img'] = "tx4.jpg";
            }else{
                foreach ($userInfo as $k=>$v){
                    if($val['uid']==$v['Id']){
                        $result_son[$key]['username'] = $v['username'];
                        $result_son[$key]['img'] = $v['img'];
                    }
                }
            }
        }
        return [
            'code'=>200,
            'data'=>[
                'count'=>$count,
                'result_fa'=>$result_fa,
                'result_son'=>$result_son
            ]
        ];
    }

    /**
     * 新增留言控制器
     */
    public function addComment(){
        $data = request()->param();
        $comment = new \app\blog\model\Comment();
        $result = $comment->addComment($data,$comment);
        if($result==1){
            return[
                "code"=>0,
                "msg"=>"添加成功"
            ];
        }else{
            return[
                "code"=>400,
                "msg"=>"添加失败,请先登录"
            ];
        }
    }

    /**
     * 获取消息提醒
     * TODO 留言板消息提醒
     */
    public function getCommentRes(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        $comment = new \app\blog\model\Comment();
        $userArticle = $article->where('username',$data['username'])->select();
        $userArticleId[] = "";
        foreach ($userArticle as $key=>$val){
            $userArticleId[$key] = $val['Id'];
        }
        $map1['uid'] = ['neq',$data['Id']];
//        $map['aid'] = ['=',0];
//        $map['pid'] = ['=',$data['Id']];
//        $map['uid'] = ['neq',$data['Id']];
        $count = $comment->where('isView',0)->where('aid','in',$userArticleId)
            ->where($map1)->count();
        $result = $comment->where('isView',0)->where('aid','in',$userArticleId)
            ->where($map1)->select();
//        $count = $comment->where('isView',0)->where('aid','in',$userArticleId)
//            ->whereOr(function ($query) use ($map) {
//            $query->where($map);
//        })->count();
//        $result = $comment->where('isView',0)->where('aid','in',$userArticleId)
//            ->whereOr(function ($query) use ($map) {
//                $query->where($map);
//        })->select();
        return[
            "code"=>0,
            "data"=>[
                'count'=>$count,
                'result'=>$result
            ]
        ];
    }

    /**
     * 消息提醒已读
     */
    public function readComment(){
        $data = request()->param();
        $comment = new \app\blog\model\Comment();
        $comment->where('Id',$data['Id'])->update(['isView'=>1]);
    }
}