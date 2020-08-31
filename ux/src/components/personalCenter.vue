<!-- 个人中心组件 -->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">我的资料</span>
      </div>
      <div class="msg-container">
        <div class="headPicture">
          <img :src="require('@/assets/tx'+this.userForm.img+'.jpg')">
          <!-- 遮罩层 -->
          <div class="changePicture" @mouseover="showMsg" @mouseout="removeMsg" @click="changePicture">
            <p id="changePicture"></p>
          </div>
          <el-dialog
            :visible.sync="showDialog"
            title="修改头像"
            :append-to-body="true"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="550px">
            <div class="headPicture">
              <img :src="require('@/assets/tx'+this.randomNum+'.jpg')">
            </div>
            <div class="headPicture">
              <span @click="randomPicture">随机头像</span>
              <el-divider direction="vertical"></el-divider>
              <span>上传头像</span>
            </div>
            <span slot="footer" class="dialog-footer">
              <el-button @click="showDialog = false">取 消</el-button>
              <el-button type="primary" @click="submitPicture">确 定</el-button>
            </span>
          </el-dialog>
        </div>
        <el-divider><i class="el-icon-edit"></i></el-divider>
        <el-form :model="userForm" :rules="userForm" ref="userForm">
          <el-form-item prop="username">用户名<el-input v-model="userForm.username" type="text" placeholder="标题"></el-input></el-form-item>
          <el-form-item prop="password">新密码<el-input v-model="userForm.content" type="password" placeholder="内容"></el-input></el-form-item>
          <el-form-item prop="password2">确认密码<el-input v-model="userForm.content" type="password" placeholder="内容"></el-input></el-form-item>
          <el-form-item prop="realName">真实姓名<el-input v-model="userForm.real_name" type="text" placeholder="标题"></el-input></el-form-item>
          <el-form-item prop="phone">手机号码<el-input v-model="userForm.phone" type="text" placeholder="标题"></el-input></el-form-item>
          <el-form-item><el-button type="primary" class="msg-btn" @click="onSubmit">提交</el-button></el-form-item>
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
        showDialog:false,
        randomNum:0,
        userForm:{}
      }
    },
    mounted() {
      this.getInfo();
    },
    methods:{
      // 获取用户信息
      getInfo(){
        axios.post("/api/blog/getInfo",{
          Id:JSON.parse(localStorage.getItem('userInfo')).Id
        }).then((response)=> {
          this.userForm = response.data.data[0];
          this.randomNum = this.userForm.img;
        }).catch(function(error) {
          console.log(error);
        });
      },
      showMsg(){
        var changePicture = document.getElementById('changePicture');
        changePicture.innerText = "修改头像";
      },
      removeMsg(){
        var changePicture = document.getElementById('changePicture');
        changePicture.innerText = "";
      },
      changePicture(){
        this.showDialog = true;
      },
      randomPicture(){
        this.randomNum = parseInt(Math.random()*6);
      },
      submitPicture(){
        this.userForm.img = this.randomNum;
        axios.post("/api/blog/updateUser",{
          Id:JSON.parse(localStorage.getItem('userInfo')).Id,
          img:this.randomNum
        }).then((response)=> {
          this.showDialog = false;
        }).catch(function(error) {
          console.log(error);
        });
      },
      onSubmit(){
        this.$refs.articleForm.validate(valid => {
          if(valid){
            this.articleForm.create_time = Math.round(new Date() / 1000);
            axios.post("/api/blog/addArticle", {
              title: this.articleForm.title,
              content: this.articleForm.content,
              mark: this.articleForm.mark,
              username: JSON.parse(localStorage.getItem('userInfo')).username,
              create_time:this.articleForm.create_time
            }).then((response) => {
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
  .headPicture{
    display:flex;
    justify-content:center;
  }
  .headPicture img{
    width: 150px;
    border-radius: 50%;
    margin-bottom: 20px;
  }
  .changePicture{
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    z-index: 4;
  }
  .changePicture p{
    text-align: center;
    margin-top: 70px;
    color: white;
  }
  .changePicture:hover{
    background-color:#000;
    opacity: 0.4;
  }
  .headPicture span:hover{
    color: #3a8ee6;
  }
  .msg-btn{
    width: 100%;
    height: 30px;
  }
</style>
