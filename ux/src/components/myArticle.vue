<!--我的文章页组件-->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <el-button type="text" class="msg-title" id="myArticle" @click="toMyArticle">我的文章</el-button>
        <el-button type="text" class="msg-title notActive" id="myCollect" @click="toMyCollect">我的收藏</el-button>
        <el-input :placeholder="isArticle?'搜索文章标题':'搜索文章标题或作者'" v-model="selectArticle" style="width: 50%;left: 10%">
          <el-button slot="append" icon="el-icon-search" @click="handleSearch"/>
        </el-input>
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
          <el-table-column fixed="right" width="100">
            <template slot-scope="scope">
              <el-button @click.native.stop="editArticle(scope.row)" type="text" size="small" v-show="isArticle">编辑</el-button>
              <el-button @click.native.stop="delArticle(scope.row)" type="text" size="small">删除</el-button>
            </template>
          </el-table-column>
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
        articleList:[],
        page:1,
        page_count:0,
        selectArticle:"", // 关键词搜索文章
        isArticle:true,
      }
    },
    mounted:function(){
      this.getArticle();
    },
    methods:{
      // 我的文章
      toMyArticle(){
        this.isArticle = true;
        document.getElementById('myArticle').style.color = '#409EFF';
        document.getElementById('myCollect').style.color = 'black';
        this.page = 1;
        this.selectArticle = "";
        this.getArticle();
      },
      // 我的收藏
      toMyCollect(){
        this.isArticle = false;
        document.getElementById('myCollect').style.color = '#409EFF';
        document.getElementById('myArticle').style.color = 'black';
        this.page = 1;
        this.selectArticle = "";
        this.getMyCollect();
      },
      // 搜索
      handleSearch(){
        if(this.isArticle===true){
          this.getArticle();
        }else{
          this.getMyCollect();
        }
      },
      // 获取文章简略信息
      getArticle(){
        var param = new FormData();
        param.append("username",JSON.parse(localStorage.getItem('userInfo')).username);
        param.append("page",this.page);
        param.append("search",this.selectArticle);
        axios.post("/index.php/blog/getArticle",param).then((response) => {
          this.articleList = [];
          this.page_count = response.data.data.count;
          for(let i=0;i<response.data.data.result.length;i++){
            this.articleList.push(response.data.data.result[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 获取我收藏的文章
      getMyCollect(){
        axios.post("/index.php/blog/getCollect", {
          uid:JSON.parse(localStorage.getItem('userInfo')).Id,
          page:this.page,
          search:this.selectArticle
        }).then((response) => {
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
      // 页码改变
      handleCurrentChange(val){
        this.page = val;
        this.getArticle();
      },
      // 编辑文章(判断权限)
      editArticle(row){
        this.$router.push({path:"addArticle",query:{Id:row.Id}});
      },
      // 删除文章
      delArticle(row){
        if(this.isArticle===true){
          this.$confirm('确认删除此文章?', '删除提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            axios.post("/index.php/blog/delArticle",{
              Id:row.Id
            }).then((response) => {
              if (response.data.code === 0) {
                this.$message({
                  message: response.data.msg,
                  type: 'success'
                });
                this.$router.go(0);
              }else{
                this.$message({
                  message: response.data.msg,
                  type: 'error'
                });
              }
            }).catch(function (error) {
              console.log(error);
            });
          }).catch((error) => {
            console.log(error);
          });
        }else{
          this.$confirm('确认取消收藏此文章?', '取消收藏提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            axios.post("/index.php/blog/handleCollect",{
              aid:row.Id,
              uid:JSON.parse(localStorage.getItem('userInfo')).Id
            }).then((response) => {
              if (response.data.code === 0) {
                this.$message({
                  message: response.data.msg,
                  type: 'success'
                });
                this.$router.go(0);
              }else{
                this.$message({
                  message: response.data.msg,
                  type: 'error'
                });
              }
            }).catch(function (error) {
              console.log(error);
            });
          }).catch((error) => {
            console.log(error);
          });
        }
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
  .msg-title{
    font-weight: bold;
  }
  .notActive{
    color: black;
  }
</style>
