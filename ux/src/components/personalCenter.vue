<!-- 个人中心组件 -->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">我的资料</span>
      </div>
      <div class="msg-container">
        <div class="headPicture">
          <img :src="require('@/assets/'+this.userForm.img)">
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
              <img v-if="imageUrl" :src="imageUrl">
              <img v-else :src="require('@/assets/'+this.randomNum)">
            </div>
            <div class="headPicture">
              <span @click="randomPicture">随机头像</span>
              <el-divider direction="vertical"></el-divider>
              <div
                class="select-picture"
                @click="changePersonImage">
                <span>上传头像</span>
              </div>
                <input
                  v-show="false"
                  ref="referenceUpload"
                  id="inputFile"
                  type="file"
                  name="file"
                  accept="image/png, image/jpeg, image/gif, image/jpg"
                  @change="uploadFile">
            </div>
            <span slot="footer" class="dialog-footer">
              <el-button @click="handleCancel">取 消</el-button>
              <el-button type="primary" @click="submitPicture">确 定</el-button>
            </span>
          </el-dialog>
        </div>
        <el-divider><i class="el-icon-edit"></i></el-divider>
        <el-form :model="userForm" :rules="userRules" ref="userForm">
          <el-form-item label="用户名" prop="username"><el-input v-model="userForm.username" type="text" placeholder="请输入用户名" disabled></el-input></el-form-item>
          <el-form-item label="手机号码" prop="phone"><el-input v-model="userForm.phone" type="text" placeholder="请输入手机号码" disabled></el-input></el-form-item>
          <el-form-item label="旧密码" prop="password0"><el-input v-model="userForm.password0" type="password" placeholder="请输入旧密码"></el-input></el-form-item>
          <el-form-item label="新密码" prop="password1"><el-input v-model="userForm.password1" type="password" placeholder="请输入新密码"></el-input></el-form-item>
          <el-form-item label="确认密码" prop="password2"><el-input v-model="userForm.password2" type="password" placeholder="请再次输入新密码"></el-input></el-form-item>
          <el-form-item><el-button type="primary" class="msg-btn" @click="onSubmit">提交</el-button></el-form-item>
        </el-form>
      </div>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    data:function () {
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入新密码'));
        } else if (value !== this.userForm.password1) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
      return{
        imageUrl:"",
        imgFile: [File],
        showDialog:false,
        randomNum:'tx0.jpg',
        userForm:{
          img:'tx0.jpg'
        },
        userRules:{
          password0: [
            { required: true, message: '请输入旧密码', trigger: 'blur' },
            { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
          ],
          password1: [
            { required: true, message: '请输入新密码', trigger: 'blur' },
            { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
          ],
          password2: [
            { required: true, trigger: 'blur', validator: validatePass }
          ]
        }
      }
    },
    created(){
      this.getInfo();
    },
    mounted() {

    },
    methods:{
      // 获取用户信息
      getInfo(){
        // this.userForm = JSON.parse(localStorage.getItem('userInfo'));
        axios.post("/blog/getInfo",{
          Id:JSON.parse(localStorage.getItem('userInfo')).Id
        }).then((response)=> {
          this.userForm = response.data.data[0];
          this.randomNum = this.userForm.img;
        }).catch(function(error) {
          console.log(error);
        });
      },
      handleCancel(){
        this.showDialog = false;
        this.imageUrl = "";
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
        this.imageUrl = "";
        this.randomNum = 'tx'+parseInt(Math.random()*6)+'.jpg';
      },
      submitPicture(){
        var param = new FormData();
        if(this.imageUrl){
          param.append("file",this.imgFile);
          param.append("Id",JSON.parse(localStorage.getItem('userInfo')).Id);
        }else{
          param.append("img",this.randomNum);
          param.append("Id",JSON.parse(localStorage.getItem('userInfo')).Id);
        }
        axios.post("/blog/updateUser", param,{
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then((response)=> {
          this.showDialog = false;
          if (response.data.code===0){
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
        }).catch(function(error) {
          console.log(error);
        });
      },
      onSubmit(){
        this.$refs.userForm.validate(valid => {
          if(valid){
            axios.post("/blog/updateUser", {
              Id:JSON.parse(localStorage.getItem('userInfo')).Id,
              oldPass: this.userForm.password0,
              newPass: this.userForm.password1,
            }).then((response) => {
              if (response.data.code === 0) {
                // 重新登陆
                axios.post("/blog/logout").then((response) => {
                  if (response.data.code === 0) {
                    localStorage.removeItem('userInfo');
                    this.loginStatus = false;
                    this.$router.go(0);
                    this.$message({
                      message: '修改信息成功，请重新登录',
                      type: 'success'
                    });
                  }
                }).catch(function (error) {
                  console.log(error);
                });
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
      },
      changePersonImage() {
        document.getElementById('inputFile').click();
      },
      /** 图片选择出发 */
      uploadFile(event) {
        var files = event.target.files;
        const file = files[0];
        this.imgFile = file;

        // 上传头像前
        const isJPG = file.type === 'image/jpeg';
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isJPG) {
          this.$message.error('上传头像图片只能是 JPG 格式!');
          return;
        }
        if (!isLt2M) {
          this.$message.error('上传头像图片大小不能超过 2MB!');
          return;
        }

        const reader = new FileReader();
        var self = this;
        reader.onload = function(e) {
          let result;
          if (typeof e.target.result === 'object') {
            // 把Array Buffer转化为blob 如果是base64不需要
            result = window.URL.createObjectURL(new Blob([e.target.result]))
          } else {
            result = e.target.result
          }
          self.imageUrl = this.result;
        };
        reader.readAsDataURL(file);
        // 解决同一个文件无法上传两次问题
        this.$refs.referenceUpload.value = null;
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
    height: 150px;
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
