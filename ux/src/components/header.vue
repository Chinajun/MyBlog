<!-- 导航栏 -->
<template>
  <div class="headerBox">
    <el-row>
      <el-col :span="24">
<!--      <el-col :span="24" style="background: #000000">   style="background: #ffa7cd" -->
        <div class="menuBox">
          <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" router>
            <el-menu-item index="home">首页</el-menu-item>
            <el-submenu index="paper">
              <template slot="title">文章</template>
              <el-menu-item index="note">笔记</el-menu-item>
              <el-menu-item index="daily">日常</el-menu-item>
            </el-submenu>
            <el-menu-item index="message">留言板</el-menu-item>
            <el-menu-item index="about">关于我</el-menu-item>
            <div class="userBox">
              <!-- 未登录 -->
              <div v-show="!loginStatus">
                <a @click="toLogin()">登录</a>  |  <a @click="toRegister">注册</a>
              </div>
              <!-- 已登录 -->
              <div v-show="loginStatus">
                <a>个人中心</a>  |  <a>退出登录</a>
              </div>
            </div>
          </el-menu>
        </div>
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      activeIndex:'',
      loginStatus:false
    }
  },
  methods:{
    handleSelect(key, keyPath){
      // console.log(key, keyPath);
    },
    toLogin(){
      this.$router.push('login');
    },
    toRegister(){
      this.$router.push('register');
    }
  }
}
</script>
<style>
  .headerBox{
    width: 100%;
    z-index: 100;
    position: fixed;
    height: 60px;
    /*opacity: 0.8;*/
  }
  .menuBox .el-menu-demo{
    padding-left: 15%;
  }
  .userBox{
    height: 100%;
    line-height: 60px;
    position: absolute;
    right: 15%;
    top: 0;
    color: #909399;
    font-size: 14px;
  }
  a:hover{
    color: #000000;
  }
</style>
