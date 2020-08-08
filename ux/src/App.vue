<template>
<div id="app" style="display: flex;justify-content:center" >
<!--  <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal">-->
<!--    <el-menu-item index="1" v-show="!(path ==='/login'||'/'||'register')"><router-link to="/login" style="display:block;height:inherit">登录</router-link></el-menu-item>-->
<!--    <el-menu-item index="2" v-show="!(path ==='/login'||'/'||'register')"><router-link to="/register" style="display:block;height:inherit">注册</router-link></el-menu-item>-->
    <router-view/>
<!--  </el-menu>-->
</div>
</template>

<script>
  import product from "./components/product";
  import admin from "./components/admin";
  import change from "./components/change";
  import login from "./components/login";
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
/*#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}*/
a{
  text-decoration:none;
}
</style>
