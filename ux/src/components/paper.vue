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
    <div class="loadMore" v-if="page<page_count"><el-button @click='loadMore'>点击加载更多</el-button></div>
    <div class="loadMore" v-else ><el-button>没有更多了</el-button></div>
  </div>
</template>
<script>
  import axios from "axios";

  export default {
    data (){
      return{
        paperList:[],
        page:1,
        page_count:''
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
        axios.post("/api/blog/getArticle",{
          page:this.page
        }).then((response) => {
          // this.paperList = [];
          this.page_count = response.data.data.count/10;
          for(let i=0;i<response.data.data.result.length;i++){
            this.paperList.push(response.data.data.result[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 点击加载更多
      loadMore(){
        this.page+=1;
        this.getAllArticle();
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
  .loadMore{
    margin: 50px 100px;
    text-align: center;
  }
</style>
