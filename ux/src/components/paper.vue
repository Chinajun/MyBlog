<!-- 文章列表 -->
<template>
  <div>
    <div v-for="(item,index) in paperList" :key="index">
      <el-card class="box-card">
        <div slot="header">
          <span>{{item.name}}</span>
          <el-button style="float: right; padding: 3px 0" type="text" @click="toDetail">查看详情</el-button>
        </div>
        <div v-for="o in 4" :key="o" class="text item">
          {{'列表内容 ' + o }}
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
  export default {
    data (){
      return{
        paperList:[
          {
            name:'文章1'
          },
          {
            name:'文章2'
          },
          {
            name:'文章3'
          },
        ]
      }
    },
    methods:{
      toDetail(){
        this.$router.push("articleDetail")
      }
    }
  }
</script>
<style>
  .box-card{
    margin: 50px 100px;
  }
  .box-card:hover{
    box-shadow: 0px 1rem 2rem 0px rgba(48, 55, 66, 0.15);
    transform: translate(0,-5px);
    transition-delay: 0s !important;
  }
</style>
