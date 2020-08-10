<template>
  <div>
    <el-card class="box-card" v-if="isNote">
      <div slot="header" class="msg-title">笔记</div>
      <img :src="require('@/assets/note.jpg')" class="article-img-note">
      <div class="about-desc">
        <p>
          记录一些学习笔记~
        </p>
      </div>
    </el-card>
    <el-card class="box-card" v-else>
      <div slot="header" class="msg-title">日常</div>
      <img :src="require('@/assets/daily.jpg')" class="article-img-daily">
      <div class="about-desc">
        <p>
          日常分享
        </p>
      </div>
    </el-card>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">文章列表</span>
        <el-button style="float: right; padding: 3px 0" type="text"  @click="addArticle">发表文章</el-button>
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
      </div>
    </el-card>
  </div>
</template>
<script>
  export default {
    data(){
      return{
        articleList:[
          {title:"测试",username:"菅野千寻"},
          {title:"测试测试",username:"早川杏仁子"}
        ]
      }
    },
    props:{
      isNote:""
    },
    methods:{
      articleDetail(row,event,column){
        console.log(row,event,column);
        this.$router.push("articleDetail");
      },
      addArticle(){
        this.$router.push('addArticle');
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
  .article-img-note{
    width: 40%;
    margin-left: 30%;
    margin-bottom: 20px;
  }
  .article-img-daily{
    width: 50%;
    margin-left: 25%;
    margin-bottom: 20px;
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
