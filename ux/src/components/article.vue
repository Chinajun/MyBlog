<!-- 文章列表页 -->
<template>
  <div>
    <el-card class="box-card" v-if="isNote">
      <div slot="header" class="msg-title">笔记</div>
      <div class="article-img-note">
        <img v-lazy="noteImg">
      </div>
      <div class="about-desc">
        <p>
          记录一些学习笔记~
        </p>
      </div>
    </el-card>
    <el-card class="box-card" v-else>
      <div slot="header" class="msg-title">日常</div>
      <div class="article-img-note">
        <img v-lazy="dailyImg">
      </div>
      <div class="about-desc">
        <p>
          日常分享
        </p>
      </div>
    </el-card>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">文章列表</span>
        <el-input placeholder="搜索文章标题或作者" v-model="selectArticle" style="width: 50%;left: 10%">
          <el-button slot="append" icon="el-icon-search" @click="getArticle"/>
        </el-input>
<!--        <el-button style="float: right; padding: 3px 0" type="text"  @click="addArticle">发表文章</el-button>-->
        <el-button style="float: right; padding: 10px 0" type="text"  @click="addArticle">发表文章</el-button>
      </div>
      <div>
        <el-table :data="articleList" style="width: 100%" :show-header="false" @row-click="articleDetail">
          <el-table-column prop="id" width="50">
            <template slot-scope="scope">
              {{scope.$index+1}}
            </template>
          </el-table-column>
          <el-table-column prop="title"></el-table-column>
          <el-table-column prop="username"></el-table-column>
        </el-table>
        <el-pagination
          style="float: right"
          :page-size="10"
          layout="prev, pager, next"
          @current-change="handleCurrentChange"
          :total="this.page_count">
        </el-pagination>
      </div>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    data(){
      return{
        noteImg:require('@/assets/note.jpg'),
        dailyImg:require('@/assets/daily.jpg'),
        articleMark:"",
        articleList:[],
        page:1,
        page_count:0,
        selectArticle:"", // 关键词搜索文章
      }
    },
    props:{
      isNote:"",
    },
    mounted:function(){
      this.judgeMark();
      this.getArticle();
    },
    methods:{
      // 判断本页标签
      judgeMark(){
        if(this.isNote===true){
          this.articleMark = "笔记"
        }else{
          this.articleMark = "日常"
        }
      },
      // 获取文章简略信息
      getArticle(){
        var param = new FormData();
        param.append("mark",this.articleMark);
        param.append("page",this.page);
        param.append("search",this.selectArticle);
        axios.post("/public/index.php/blog/getArticle",param).then((response) => {
          this.articleList = [];
          this.page_count = response.data.data.count;
          for(let i=0;i<response.data.data.result.length;i++){
            this.articleList.push(response.data.data.result[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 跳转文章详情界面
      articleDetail(row,event,column){
        // console.log(row,event,column);
        this.$router.push({path:"articleDetail",query:{Id:row.Id}})
      },
      // 跳转新增文章界面
      addArticle(){
        this.$router.push('addArticle');
      },
      // 页码改变
      handleCurrentChange(val){
        this.page = val;
        this.getArticle();
      },
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
  .article-img-note{
    display:flex;
    justify-content:center;
    margin-bottom: 20px;
  }
  .article-img-note img{
    width: 40%;
    height: auto;
  }
  .msg-title{
    font-weight: bold;
  }
  .about-desc p{
    text-align: center;
    font-size: 14px;
    line-height: 30px;
  }
</style>
