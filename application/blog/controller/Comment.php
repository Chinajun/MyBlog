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
        $count = $comment->where('aid',$data['aid'])->where('pid',0)->count();
        $result_fa = $comment->where('aid',$data['aid'])->where('pid',0)
            ->limit(($data['page']-1)*10,10)->order("create_time desc")->select();
        $pid[] = "";
        for ($i=0;$i<sizeof($result_fa);$i++){
            $pid[$i] = $result_fa[$i]['Id'];
        }
        $result_son = $comment->where('aid',$data['aid'])->where('pid','in',$pid)
            ->order("create_time desc")->select();
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
                "msg"=>"添加失败"
            ];
        }
    }
}