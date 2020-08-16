<?php
namespace app\blog\model;
use think\Model;

class Comment extends Model
{
    /**
     * 新增评论
     */
    public function addComment($data,$comment){
        try {
            $comment->data([
                'content' => $data['content'],
                'uid' =>$data['uid'],
                'create_time' => $data['create_time'],
                'aid' => $data['aid'],
                'pid' => $data['pid']
            ]);
            return $comment->save();
        }catch (\Exception $e){
            return[
                "code"=>400,
                "msg"=>"添加失败"
            ];
        }
    }
}