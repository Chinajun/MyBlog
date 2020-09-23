<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox">
      <el-row>
        <el-col :sm="16" :md="16">
          <cyj-myself></cyj-myself>
        </el-col>
        <el-col :sm="8" :md="8" >
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
  import myself from "../components/myself"
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-myself':myself
    },
    data(){
      return {

      }
    },
    methods:{

    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
  }
</style>
