<template>
  <div id="app">
    <router-view/>
<!--  <el-image :src="require('@/assets/peach.jpg')"></el-image>-->
  </div>
</template>

<script>
  import product from "./components/product";
  import admin from "./components/admin";
  import change from "./components/change";
  import login from "./views/login";
  import page1 from "./components/page1";
  import register from "./views/register";
export default {
  name: 'App',
  comments:{
    // product,admin,change,login,page1,register
  },
  data:function () {
    return{
      activeIndex: '1',
      path:'',
      bgImg:'',
    }
  },
  mounted() {
    this.path = this.$route.path;
    // 随机更换背景图片
    var index =parseInt(Math.random()*9);
    this.bgImg = "/static/bg"+index+".jpg";
    document.body.style.backgroundImage = "url("+this.bgImg+")";
  },
  watch:{
    $route(to,from){
      this.path = to.path
    }
  }
}
</script>

<style>
*{
  margin: 0;
  padding: 0;
}
a{
  text-decoration:none;
  color: #303133;
}
body{
  /*background-image: url("assets/bg0.jpg");*/
  background-image: url("/static/bg1.jpg");
  background-attachment:fixed;
  background-repeat:repeat;
  background-size: 30%;
  /*opacity: 0.8;*/
  min-width: 1200px;/*防止手机端布局错乱*/
}
</style>
