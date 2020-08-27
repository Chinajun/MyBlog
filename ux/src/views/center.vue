<!-- 个人中心界面 -->
<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :sm="24" :md="16">
          <cyj-center></cyj-center>
        </el-col>
        <el-col :sm="24" :md="8" >
          <cyj-right></cyj-right>
        </el-col>
      </el-row>
    </div>
    <cyj-footer></cyj-footer>
  </div>
</template>
<script>
  import header from '../components/header.vue';
  import right from "../components/right";
  import footer from "../components/footer";
  import center from "../components/personalCenter";
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-center':center
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
  }
</style>
