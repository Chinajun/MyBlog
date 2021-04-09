<!-- 发表文章组件 -->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">写文章</span>
        <el-button style="float: right; padding: 3px 0" type="text"  @click="toLast">返回</el-button>
      </div>
      <div class="msg-container addpic">
        <el-form :model="articleForm" :rules="articleRules" ref="articleForm">
          <div class="add-btn">
            <span>请选择文章标签：</span>
            <el-radio v-model="articleForm.mark" label="笔记" border>笔记</el-radio>
            <el-radio v-model="articleForm.mark" label="日常" border>日常</el-radio>
          </div>
          <el-form-item prop="title"><el-input v-model="articleForm.title" type="text" :rows="2" placeholder="标题"></el-input></el-form-item>
          <el-form-item prop="content">
<!--            <el-input v-model="articleForm.content" type="textarea" :rows="10" placeholder="内容"></el-input>-->
<!--          </el-form-item>-->
            <mavon-editor
              v-model="articleForm.content"
              ref="md"
              @imgAdd="$imgAdd"
              @change="change"
              style="min-height: 600px"
            />
          </el-form-item>
          <el-form-item><el-button type="primary" class="msg-btn" @click="onSubmit">发布</el-button></el-form-item>
        </el-form>
      </div>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";

  export default {
    data(){
      return{
        articleForm:{
          title:"",
          content:"",
          mark:"日常",
          create_time:"",
          aid:0,
        },
        html:"",
        articleRules:{
          title: [{ required: true, message: '请输入标题', trigger: 'blur' }],
          content: [{ required: true, message: '请输入内容', trigger: 'blur' }]
        }
      }
    },
    mounted() {
      if(this.$route.query.Id){
        this.aid = this.$route.query.Id;
        this.getDetailArticle();
      }
    },
    methods:{
      toLast(){
        this.$router.go(-1)
      },
      // 根据Id获取文章信息
      getDetailArticle() {
        axios.post("/public/index.php/blog/getDetailArticle",{
          Id:this.aid
        }).then((response) => {
          this.articleForm.title = response.data.title;
          this.articleForm.content = response.data.content;
          this.articleForm.mark = response.data.mark;
          this.articleForm.username = response.data.username;
          if(JSON.parse(localStorage.getItem('userInfo')).username!==this.articleForm.username){
            this.$message({
              message: '您没有编辑权限！',
              type: 'error'
            });
            this.$router.push('myArticle');
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      change(value, render){
        // render 为 markdown 解析后的结果[html]
        this.html = render;
      },
      // 将图片上传到服务器，返回地址替换到md中
      $imgAdd(pos, $file){
        var param = new FormData();
        param.append("file",$file);
        axios.post("/public/index.php/blog/uploadImg", param,{
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then((response)=> {
          if (response.data.code===0){
            this.$refs.md.$img2Url(pos, response.data.data);
          }else{
            this.$message({
              message: response.data.msg,
              type: 'error'
            });
          }
        }).catch(function(error) {
          console.log(error);
        });
      },
      onSubmit(){
        this.$refs.articleForm.validate(valid => {
          if(valid){
            this.articleForm.create_time = Math.round(new Date() / 1000);
            var param = new FormData();
            param.append('title',this.articleForm.title);
            param.append('content',this.articleForm.content);
            param.append('mark',this.articleForm.mark);
            param.append('username',JSON.parse(localStorage.getItem('userInfo')).username);
            if(this.aid){
              param.append('Id',this.aid);
            }else{
              param.append('create_time',this.articleForm.create_time);
            }
            axios.post("/public/index.php/blog/addArticle",param).then((response) => {
              if (response.data.code === 0) {
                this.$message({
                  message: response.data.msg,
                  type: 'success'
                });
                this.$router.go(-1);
              } else {
                this.$message({
                  message: response.data.msg,
                  type: 'error'
                });
              }
            }).catch(function (error) {
              console.log(error);
            });
          }
        });
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
  .msg-title{
    font-weight: bold;
  }
  .msg-desc p{
    font-size: 14px;
    line-height: 30px;
  }
  .msg-container{
    margin-top: 20px;
  }
  .addpic img{
    width: 100%;
  }
  .msg-btn{
    width: 100%;
    height: 30px;
  }
  .add-btn{
    margin-bottom: 20px;
  }
</style>
