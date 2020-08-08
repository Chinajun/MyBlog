import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import login  from './components/login.vue';
import register  from './components/register.vue';
import page1 from './components/page1.vue';
import admin from './components/admin.vue';
import change from './components/change.vue';
import product from './components/product.vue';
import vuex from "./components/vuex";


//定义routes路由的集合，数组类型
const routes=[
    //单个路由均为对象类型，path代表的是路径，component代表组件
    {path:'/login',component:login},
    {path:"/register",component:register},
    //可以配置重定向
    // {path:'',redirect:"login"},
    //或者重新写个路径为空的路由
    // {path:"",component:login},
    {path:'/page1',component:page1,name:'page1'},
    {path:'/admin',component:admin},
    {path:'/change',component:change},
    {path:'/product',component:product},
    {path:"",component:login},
    {path:"/vuex",component:vuex},
];

//实例化VueRouter并将routes添加进去
const router=new VueRouter({
//ES6简写，等于routes：routes
    routes
});

//抛出这个这个实例对象方便外部读取以及访问
export default router
