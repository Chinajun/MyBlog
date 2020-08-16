<!-- 导航栏 -->
<template>
  <div class="headerBox">
    <el-row>
      <el-col :span="24">
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
                <a>个人中心</a>  |  <a @click="logout">退出登录</a>
              </div>
            </div>
          </el-menu>
        </div>
      </el-col>
    </el-row>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      activeIndex:'',
      loginStatus:false
    }
  },
  mounted:function(){
    this.isLogin();
  },
  methods:{
    // 判断登陆情况
    isLogin(){
      if(localStorage.getItem('userInfo')) {
        this.loginStatus = true;
      } else {
        this.loginStatus = false;
      }
    },
    handleSelect(key, keyPath){
      // console.log(key, keyPath);
    },
    toLogin(){
      this.$router.push('login');
    },
    toRegister(){
      this.$router.push('register');
    },
    logout(){
      this.$confirm('是否确认退出?', '退出提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        axios.post("/api/blog/logout").then((response) => {
          if (response.data.code === 0) {
            localStorage.removeItem('userInfo');
            this.$cookies.remove('username');
            this.loginStatus = false;
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
          }
        }).catch(function (error) {
          console.log(error);
        });
      }).catch((error) => {
        console.log(error);
      });
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
