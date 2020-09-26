<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :xs="16" :sm="16" :md="16">
          <cyj-article :isNote=false></cyj-article>
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
  import header from '../components/header.vue';
  import article from "../components/article";
  import right from "../components/right";
  import footer from "../components/footer";
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-article':article
    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
    min-height: 1000px;
  }
</style>
