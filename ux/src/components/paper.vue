<!-- 文章列表 -->
<template>
  <div>
    <div v-for="(item,index) in paperList" :key="index">
      <el-card class="box-card">
        <div slot="header">
          <span>{{item.title}}</span>
          <el-button style="float: right; padding: 3px 0" type="text" @click="toDetail(item)">查看详情</el-button>
        </div>
        <div class="paper-content">
          {{item.content|ellipsis}}
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
  import axios from "axios";

  export default {
    data (){
      return{
        paperList:[]
      }
    },
    mounted() {
      this.getAllArticle();
    },
    filters: {
      // 过滤器 限制文章内容显示字符
      ellipsis (value) {
        if (!value) return '';
        if (value.length > 150) {
          return value.slice(0,150) + '...'
        }
        return value
      }
    },
    methods:{
      toDetail(item){
        this.$router.push({path:"articleDetail",query:{Id:item.Id}})
      },
      getAllArticle(){
        axios.post("/api/blog/getArticle").then((response) => {
          this.paperList = [];
          for(let i=0;i<response.data.length;i++){
            this.paperList.push(response.data[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      }
    }
  }
</script>
<style>
  .paper-content{
    margin: 10px;
    line-height: 30px;
  }
  .box-card{
    margin: 50px 100px;
  }
  .box-card:hover{
    box-shadow: 0px 1rem 2rem 0px rgba(48, 55, 66, 0.15);
    transform: translate(0,-5px);
    transition-delay: 0s !important;
  }
</style>
