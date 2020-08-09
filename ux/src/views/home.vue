<!-- 首页 -->
<template>
  <div>
    <cyj-header></cyj-header>
<!--    <img class="headImg" :src="require('@/assets/qingnv.jpg')"/>-->
    <div class="bodyBox">
      <el-row>
        <el-col :sm="24" :md="16">
          <cyj-paper></cyj-paper>
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
  import paper from "../components/paper";
  import right from "../components/right";
  import footer from "../components/footer";
  export default {
    components:{
      'cyj-header':header,
      'cyj-paper':paper,
      'cyj-right':right,
      'cyj-footer':footer
    }
  }
</script>
<style>
  .headImg{
    width: 100%;
    position: relative;
    top: 0;
    opacity: 1;
    background-size: cover;
    /*z-index: 5;*/
  }
  .bodyBox{
    padding-top: 100px;
  }
  .test{
    background-color: #8cc5ff;
  }
</style>
