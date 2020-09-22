import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import home from "./views/home";
import message from "./views/message";
import about from "./views/about";
import login from "./views/login"
import note from "./views/note";
import daily from "./views/daily";
import articleDetail from "./views/articleDetail";
import register from "./views/register";
import addArticle from "./views/addArticle";
import NotFound from "./views/NotFound";
import center from "./views/center";
import myArticle from "./views/myArticle";

const routes=[
    {path:"",component:home},
    {path:"/home",component:home,name:home,meta:{title: '主页'}},//主页
    {path:"/note",component:note,name:note,meta:{title: '笔记'}},//文章-笔记
    {path:"/daily",component:daily,name:daily,meta:{title: '日常'}},//文章-日常
    {path:"/addArticle",component:addArticle,name:addArticle,
      meta: {
        title: '新增文章',
        type: 'login'
      }},//发表文章
    {path:"/message",component:message,name:message,meta:{title: '留言板'}},//留言板
    {path:"/about",component:about,name:about,meta:{title: '关于我'}},//关于我
    {path:"/login",component:login,name:login,meta:{title: '登录'}},//登录
    {path:"/register",component:register,name:register,meta:{title: '注册'}},//注册
    {path:"/center",component:center,name:center,
      meta:{
      title: '个人中心',
        type: 'login'
    }},//个人中心
    {path:"/myArticle",component:myArticle,name:myArticle,
    meta:{
      title: '我的文章',
      type: 'login'
    }},//我的文章
    {path:"/articleDetail",component:articleDetail,name:articleDetail,meta:{title: '文章详情'}},// 文章详情页
    {path:'*',component:NotFound,name:NotFound,meta:{title: '404'}},//全不匹配的情况下，返回404，路由按顺序从上到下，依次匹配。最后一个*能匹配全部，
];

//实例化VueRouter并将routes添加进去
const router=new VueRouter({
//ES6简写，等于routes：routes
    routes
});

//抛出这个这个实例对象方便外部读取以及访问
export default router
