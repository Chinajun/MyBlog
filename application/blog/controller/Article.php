<?php
namespace app\blog\controller;
use think\Controller;
use think\Db;

class Article extends Controller
{
    /**
     * 新增文章控制器
     */
    public function addArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        $result = $article->addArticle($data,$article);
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

    /**
     * 获取文章列表控制器 (首页获取全部 文章列表按标签分类获取)
     * TODO 分页
     */
    public function getArticle(){
        $data = request()->param();
        if($data){
            $article = new \app\blog\model\Article();
            return $article->where('mark',$data['mark'])->select();
        }else{
            return Db::query('select * from article');
        }
    }

    /**
     * 根据Id获取文章详情
     */
    public function getDetailArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        return $article->where('Id',$data['Id'])->find();
    }
}