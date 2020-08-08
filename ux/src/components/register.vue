<template>
  <div>
    <el-card class="box-card" style="margin:100px auto">
    <div slot="header" class="clearfix">
      <span>新增用户界面</span>
    </div>
    <div class="text item">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="用户名">
          <el-input v-model="form.username" type="text"></el-input>
        </el-form-item>
        <el-form-item label="密码">
          <el-input v-model="form.password" type="password"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="submit" @click="onSubmit">确认</el-button>
        </el-form-item>
      </el-form>
    </div>
  </el-card>
  </div>
</template>
<script>
    import axios from "axios";
    export default {
        data :function() {
            return {
              form:{
                username : "",
                password : ""
              }
            }
        },
      mounted:function(){
        this.getMsg();
      },
      methods: {
        getMsg(){
          axios.post("/register/getMsg").then((response) => {
            console.log(response.data.code);
            if(response.data.code!==1){
              this.$router.go(-1);
              this.$message({
                message: response.data.msg,
                type: 'error'
              });
            }
          }).catch(function (error) {
            console.log(error);
          });
        },
        onSubmit() {
          axios.post("/register/register",{
            username: this.form.username,
            password: this.form.password
          }).then((response)=> {
            console.log(response.data);
            if (response.data.code===0){
              this.$message({
                message: response.data.msg,
                type: 'success'
              });
              this.$router.replace('/admin');
            }else{
              this.$message({
                message: response.data.msg,
                type: 'error'
              });
            }
          }).catch(function(error) {
            console.log(error);
          });
        }
    }
    }
</script>
<style>
  .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }

  .box-card {
    width: 480px;
  }
  a{
    text-decoration:none;
  }
</style>
