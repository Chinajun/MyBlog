<template>
  <div id="app">
    <router-view/>
<!--  <el-image :src="require('@/assets/peach.jpg')"></el-image>-->
  </div>
</template>

<script>
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
  @import "assets/font/font.css";
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
  overflow-x: hidden;
  /*opacity: 0.8;*/
  /*min-height: 2000px;*/
  min-width: 1200px;/*防止手机端布局错乱*/
}
</style>
