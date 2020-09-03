<!-- 文章列表 -->
<template>
  <div>
<!--    <div class="box-card">-->
<!--      <div class="box-card-paper">-->
<!--        <img class="article-img" :src="require('@/assets/a2.jpg')"/>-->
<!--        <div class="layer"></div>-->
<!--      </div>-->
<!--    </div>-->

    <div v-for="(item,index) in paperList" :key="index">
      <el-card class="box-card">
        <div slot="header">
          <div style="text-align: center;font-weight: bold" @click="toDetail(item)">{{item.title}}</div>
        </div>
        <div class="paper-content">
          <div class="paper-desc">
            <div class="paper-info">
              <i class="fa fa-user">{{item.username}}</i>
              <i class="el-icon-time">{{item.create_time}}</i>
              <i class="el-icon-view">{{item.view}}</i>
              <el-tag>{{item.mark}}</el-tag>
            </div>
            <div class="paper-content">
              {{item.content|ellipsis}}
            </div>
          </div>
        </div>
        <div class="paper-btn"><el-button class="paper-btn-c" type="primary" @click="toDetail(item)">阅读全文</el-button></div>
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
  .paper-btn{
    display:flex;
    justify-content:center;
  }
  .paper-btn-c{
    /*width: 70px;*/
    /*height: 30px;*/
  }
  .paper-desc{
    /*margin: 0 30px;*/
    /*line-height: 30px;*/
  }
  .paper-info i{
    margin-right: 20px;
  }
  .paper-info{
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
    text-align: center;
    color: #8c939d;
  }
  .layer{
    position: absolute;
    top: 0;
    left: 0;
    background-color:#000;
    width: 100vh;
    /*height: 100%;*/
    /*width: 100%;*/
    /*height: 100px;*/
    opacity: 0.4;
    z-index: 4;
  }
  .box-card-paper{
    display:flex;
    justify-content:center;
  }
  .article-img{
    width: 80%;
    border-radius: 10px;
    /*width: 100%;*/
  }
  /* test */
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
  /* 新卡片*/
  .paper-card{
    /*border-radius: 3%;*/
  }
  .paper-img{
    width: 810px;
  }
</style>
