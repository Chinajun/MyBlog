<!-- 发表文章界面 -->
<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :xs="16" :sm="16" :md="16">
          <cyj-add></cyj-add>
        </el-col>
        <el-col :xs="8" :sm="8" :md="8">
          <cyj-right></cyj-right>
        </el-col>
      </el-row>
    </div>
    <cyj-footer></cyj-footer>
  </div>
</template>
<script>
  const header = ()=>import("../components/header");
  const right = ()=>import("../components/right");
  const footer = ()=>import("../components/footer");
  const add = ()=>import("../components/add");
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-add':add
    },
    data(){
      return {
      }
    },
    mounted:function(){
      this.getUserInfo();
    },
    methods:{
      // 在本页退出登陆后，自动跳转到首页
      getUserInfo(){
        if(!localStorage.getItem('userInfo')){
          this.$router.push('home');
        }
      }
    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
    min-height: 1000px;
  }
</style>
