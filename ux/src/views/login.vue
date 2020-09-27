<template>
  <div>
    <cyj-header></cyj-header>
    <div class="loginBox">
      <el-card class="box-card-login">
        <div slot="header">
          <span>登录</span>
        </div>
        <div class="text item">
          <el-form ref="form" :model="form" label-width="80px" :rules="loginRules">
            <el-form-item label="手机号" prop="phone">
              <el-input v-model="form.phone" type="text"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password">
              <el-input v-model="form.password" type="password"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="submit" @click="onSubmit">登录</el-button>
            </el-form-item>
          </el-form>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  const header = ()=>import("../components/header");
  export default {
    name:'login',
    components:{
      'cyj-header':header,
    },
    data :function() {
      return {
        form:{
          phone : "",
          password : ""
        },
        loginRules:{
          password: [
            { required: true, message: '请输入密码', trigger: 'blur' },
            { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
          ],
          phone: [
            { required: true, message: '请输入手机号', trigger: 'blur' },
            { min: 11, max: 11, message: '手机号格式错误', trigger: 'blur' }
          ]
        }
      }
    },
    methods: {
      onSubmit() {
        axios.post("/api/blog/login", {
          phone: this.form.phone,
          password: this.form.password
        }).then((response) => {
          if (response.data.code === 0) {//登陆成功
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
            // this.$cookies.set("uid",response.data.data.userInfo.Id);
            localStorage.setItem('userInfo',JSON.stringify(response.data.data.userInfo));
            localStorage.setItem('authKey',response.data.data.authKey);
            this.$router.replace('home');
          } else {//登陆失败
            this.$message({
              message: response.data.msg,
              type: 'error'
            });
          }
        }).catch(function (error) {
          console.log(error);
        });
      }
    }
  }
</script>
<style>
  .loginBox{
    padding-top: 200px;
    min-height: 1000px;
  }
  .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .box-card-login {
    width: 480px;
    margin: 0 auto;
  }
  a{
    text-decoration:none;
  }
</style>
