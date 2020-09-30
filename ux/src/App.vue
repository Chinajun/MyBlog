<template>
  <div id="app">
    <router-view/>
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
    // 判断设备
    if (this.isMobile()) {
      // 手机端背景图片横向不平铺，设定min-height
      document.body.style.backgroundSize = '100%';
    }
    // 随机更换背景图片
    var index =parseInt(Math.random()*9);
    this.bgImg = "/static/bg"+index+"_tiny.jpg";
    document.body.style.backgroundImage = "url("+this.bgImg+")";
  },
  watch:{
    $route(to,from){
      this.path = to.path
    }
  },
  methods:{
    // 识别手机端还是pc端
    isMobile() {
      let flag = navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i)
      return flag;
    },
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
  /*background-image: url("/static/bg1.jpg");*/
  background-attachment:fixed;
  background-repeat:repeat;
  background-size: 30%;
  overflow-x: hidden;
  /*opacity: 0.8;*/
  /*min-height: 2000px;*/
  min-width: 1200px;/*防止手机端布局错乱*/
}
</style>
