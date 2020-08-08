<template>
  <div>
    <el-card class="box-card" style="margin:100px auto">
        <div slot="header" class="clearfix">
            <span>论坛</span>
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
              <el-button type="submit" @click="onSubmit">登录</el-button>
            </el-form-item>
        </el-form>
        </div>
    </el-card>
  </div>
</template>
<script>
  import axios from 'axios'
  export default {
    name:'login',
    data :function() {
      return {
        form:{
          username : "",
          password : ""
        }
      }
    },
    methods: {
      onSubmit() {
        axios.post("/api/register/login", {
          username: this.form.username,
          password: this.form.password
        }).then((response) => {
          if (response.data.code === 0) {//登陆成功
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
            this.$router.replace({//repalce:没有页面记录，无法返回上一页
              name: 'page1',
              params: {
                username: this.form.username
              }
            });
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
