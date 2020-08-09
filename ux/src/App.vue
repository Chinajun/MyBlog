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
  import register from "./components/register";
export default {
  name: 'App',
  comments:{
    // product,admin,change,login,page1,register
  },
  data:function () {
    return{
      activeIndex: '1',
      path:''
    }
  },
  mounted() {
    this.path = this.$route.path;
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
}
body{
  background:url("assets/peach.jpg") repeat fixed;
  background-size: 30%;
  /*opacity: 0.8;*/
}
</style>
