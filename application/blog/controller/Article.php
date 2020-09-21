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
     * 分页:起始位置(page-1)*10   请求数量 10
     */
    public function getArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        if(sizeof($data)>1){
            // 文章列表页 前端传递的数据:mark,page
            // 文章列表搜索页 前端传递的数据:mark,page,search
            $map = [];
            $map['title'] = ['like','%'.$data['search'].'%'];
            $map['username'] = ['like','%'.$data['search'].'%'];
            $count = $article->where('mark',$data['mark'])->where(function ($query) use ($map) {
                $query->whereOr($map);
            })->count();
            $result = $article->where('mark',$data['mark'])->where(function ($query) use ($map) {
                $query->whereOr($map);
            })->limit(($data['page']-1)*10,10)->order("create_time desc")->select();
        }else{
            // 首页 前端传递的数据:page
            $count = $article->count();
            $result = $article->limit(($data['page']-1)*10,10)
                ->order("create_time desc")->select();
            for ($i=0;$i<sizeof($result);$i++){
                $result[$i]['create_time'] = date('Y-m-d H:i:s',$result[$i]['create_time']);
            }
        }
        return [
            'code'=>200,
            'data'=>[
                'count'=>$count,
                'result'=>$result
            ]
        ];
    }

    /**
     * 根据Id获取文章详情
     */
    public function getDetailArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        $result = $article->where('Id',$data['Id'])->find();
        $result['view'] = $result['view']+1;
        $article->where('Id',$result['Id'])->update(['view'=>$result['view']]);
        $result['create_time'] = date('Y-m-d H:i:s',$result['create_time']);
        return $result;
    }

    /**
     * 文章中上传图片
     */
    public function uploadImg(){
        $file = request()->file("file");
        if($file){
            $info = $file->validate(['ext' => 'jpg,jpeg'])->rule('md5')->move(ROOT_PATH . 'public/static');
            if($info){
                $fileSaveName = $info->getSaveName();
                $fileSaveName = 'http://localhost/public/static/'.str_replace("\\",'/',$fileSaveName);
                return [
                    'code' => 0,
                    'msg' => '图片上传成功',
                    'data' => $fileSaveName
                ];
            }
        }else{
            return[
                "code"=>400,
                "msg" => "图片上传失败"
            ];
        }
    }
}