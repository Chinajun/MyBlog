<template>
  <div class="loginBox">
    <el-card class="box-card-login">
      <div slot="header">
        <h3>404 Not Found</h3>
      </div>
      <div class="text item">
        <div class="nf-title">抱歉，您要访问的页面丢失了</div>
        <div class="nf-title">请检查您输入的网址是否正确，请点击以下按钮返回首页</div>
        <el-button type="primary" @click="toHome" class="nf-btn">返回</el-button>
      </div>
    </el-card>
  </div>
</template>
<script>
  export default {
    methods:{
      toHome(){
        this.$router.push('home');
      }
    }
  }
</script>
<style>
  .loginBox{
    padding-top: 200px;
  }
  .text {
    font-size: 14px;
  }

  .item {
    margin: 20px;
    /*margin-bottom: 18px;*/
  }

  .box-card-login {
    width: 480px;
    margin: 0 auto;
  }
  .nf-btn{
    margin: 20px;
    float: right;
  }
  .nf-title{
    margin-bottom: 20px;
  }
</style>
