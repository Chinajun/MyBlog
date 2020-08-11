<!-- 发表文章界面 -->
<template>
  <div v-show="loginStatus">
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :sm="24" :md="16">
          <cyj-add></cyj-add>
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
  import add from "../components/add";
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-add':add
    },
    data(){
      return {
        loginStatus:false
      }
    },
    mounted:function(){
      this.isLogin();
    },
    methods:{
      // 判断登陆情况
      isLogin(){
        if(this.$cookies.get("username")){
          this.loginStatus = true;
        }
      },
    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
  }
</style>
