<?php
namespace app\blog\controller;
use think\Controller;
use think\Db;

class Article extends Controller
{
    /**
     * 新增、编辑文章控制器
     */
    public function addArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        $result = $article->addArticle($data,$article);
        if($result==1){
            return[
                "code"=>0,
                "msg"=>"操作成功"
            ];
        }else{
            return[
                "code"=>400,
                "msg"=>"操作失败"
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
            // 我的文章页 前端传递的数据:username,page
            // 我的文章搜索页 前端传递的数据:username,page,search
            $map = [];
            $map['title'] = ['like','%'.$data['search'].'%'];
            if($data['username']==null){
                // 文章列表页
                $keyWord['mark'] = $data['mark'];
                $map['username'] = ['like','%'.$data['search'].'%'];
            }else{
                // 我的文章
                $keyWord['username'] = $data['username'];
            }
            $res = $article->getArticleList($keyWord,$map,$data,$article);
            $count = $res['count'];
            $result = $res['result'];
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
//            $info = $file->validate(['ext' => 'jpg,jpeg'])->rule('md5')->move(ROOT_PATH . 'public/static');
            $info = $file->validate(['ext' => 'jpg,jpeg'])->rule('md5')->move(ROOT_PATH . 'ux/static');
            if($info){
                $fileSaveName = $info->getSaveName();
//                $fileSaveName = 'http://localhost/public/static/'.str_replace("\\",'/',$fileSaveName);
                $fileSaveName = 'http://47.98.213.131/static/'.str_replace("\\",'/',$fileSaveName);
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

    /**
     * 删除文章(删除文章的收藏记录和评论)
     */
    public function delArticle(){
        $data = request()->param();
        $article = new \app\blog\model\Article();
        $collect = new \app\blog\model\Collect();
        $comment = new \app\blog\model\Comment();
        $result1 = $article->where('Id',$data['Id'])->delete();
        $result2 = $collect->where('aid',$data['Id'])->delete();
        $result3 = $comment->where('aid',$data['Id'])->delete();
        if($result1&&$result2&&$result3){
            return [
                'code' => 0,
                'msg' => '删除成功'
            ];
        }else{
            return [
                'code' => 400,
                'msg' => '删除失败'
            ];
        }
    }
}