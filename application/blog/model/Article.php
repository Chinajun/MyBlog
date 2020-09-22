<?php
namespace app\blog\model;
use think\Model;

class Article extends Model
{
    /**
     * 新增文章
     */
    public function addArticle($data,$article){
        try {
            $article->data([
                'title' => $data['title'],
                'content' => $data['content'],
                'mark' => $data['mark'],
                'username' =>$data['username'],
                'create_time' => $data['create_time']
            ]);
            if(isset($data['Id'])){
                return $article->where('Id',$data['Id'])->update($data);
            }else{
                return $article->save();
            }
        }catch (\Exception $e){
            return[
                "code"=>400,
                "msg"=>"添加失败"
            ];
        }
    }
}