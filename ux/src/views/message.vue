<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :xs="16" :sm="16" :md="16">
          <cyj-msgbd :isMsgbd=true></cyj-msgbd>
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
  const msgbd = ()=>import("../components/msgbd");
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-msgbd':msgbd
    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
    min-height: 1000px;
  }
</style>
