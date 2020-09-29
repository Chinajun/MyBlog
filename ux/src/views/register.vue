<template>
  <div>
    <cyj-header></cyj-header>
    <div class="loginBox">
      <el-card class="box-card-login">
        <div slot="header">
          <span>注册</span>
        </div>
        <div class="text item">
          <el-form ref="registerForm" :model="registerForm" :rules="registerRules" label-width="80px">
            <el-form-item label="用户名" prop="username">
              <el-input v-model="registerForm.username" type="text"></el-input>
            </el-form-item>
            <el-form-item label="手机号" prop="phone">
              <el-input v-model="registerForm.phone" type="text"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password">
              <el-input v-model="registerForm.password" type="password"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="checkPass">
              <el-input v-model="registerForm.checkPass" type="password"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="submit" @click="onSubmit">确认</el-button>
            </el-form-item>
          </el-form>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
    import axios from "axios";
    const header = ()=>import("../components/header");
    export default {
      components:{
        'cyj-header':header,
      },
        data :function() {
          var validatePass = (rule, value, callback) => {
            if (value === '') {
              callback(new Error('请再次输入密码'));
            } else if (value !== this.registerForm.password) {
              callback(new Error('两次输入密码不一致!'));
            } else {
              callback();
            }
          };
          var validateUsername = (rule, value, callback) => {
            if (value === '') {
              callback(new Error('请输入用户名'));
            } else if (value.length>6||value.length<2) {
              callback(new Error('长度为2-6个字符'));
            } else {
              axios.post("/public/index.php/blog/validateUser",{
                type: 'username',
                value: value
              }).then((response)=> {
                console.log(response.data);
                if (response.data.code===0){
                  callback(new Error('该用户名已被注册'));
                }else{
                  callback();
                }
              }).catch(function(error) {
                console.log(error);
              });
            }
          };
          var validatePhone = (rule, value, callback) => {
            if (value === '') {
              callback(new Error('请输入手机号'));
            } else if (value.length!==11) {
              callback(new Error('手机号格式错误'));
            } else {
              axios.post("/public/index.php/blog/validateUser",{
                type: 'phone',
                value: value
              }).then((response)=> {
                console.log(response.data);
                if (response.data.code===0){
                  callback(new Error('该手机号已被注册'));
                }else{
                  callback();
                }
              }).catch(function(error) {
                console.log(error);
              });
            }
          };
            return {
              registerForm:{
                username : "",
                password : "",
                phone:"",
                checkPass:"",
                create_time:""
              },
              registerRules:{
                username: [
                  // { required: true, message: '请输入用户名', trigger: 'blur' },
                  // { min: 2, max: 6, message: '长度在 2 到 6 个字符', trigger: 'blur' },
                  { required: true,trigger: 'blur', validator: validateUsername }
                ],
                password: [
                  { required: true, message: '请输入密码', trigger: 'blur' },
                  { min: 6, max: 12, message: '长度在 6 到 12 个字符', trigger: 'blur' }
                ],
                phone: [
                  // { required: true, message: '请输入手机号', trigger: 'blur' },
                  // { min: 11, max: 11, message: '手机号格式错误', trigger: 'blur' },
                  { required: true,trigger: 'blur', validator: validatePhone }
                ],
                checkPass: [
                  { required: true, trigger: 'blur', validator: validatePass }
                ]
              }
            }
        },
      mounted:function(){

      },
      methods: {
        onSubmit() {
          this.$refs.registerForm.validate(valid => {
            if (valid) {
              this.registerForm.create_time = Math.round(new Date() / 1000);
              axios.post("/public/index.php/blog/register",{
                username: this.registerForm.username,
                password: this.registerForm.password,
                phone:this.registerForm.phone,
                create_time:this.registerForm.create_time,
                img:parseInt(Math.random()*6)
              }).then((response)=> {
                console.log(response.data);
                if (response.data.code===0){
                  this.$message({
                    message: response.data.msg,
                    type: 'success'
                  });
                  this.$router.replace('login');
                }else{
                  this.$message({
                    message: response.data.msg,
                    type: 'error'
                  });
                }
              }).catch(function(error) {
                console.log(error);
              });
            } else {
              this.$message.error('注册失败，信息填写不正确');
              return false
            }
          })
        }
    }
    }
</script>
<style>
  .loginBox{
    padding-top: 200px;
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
