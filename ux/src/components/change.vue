<template>
  <div>
    <el-card class="box-card" style="margin:100px auto">
      <div slot="header" class="clearfix">
        <span>修改信息界面</span>
      </div>
      <div class="text item">
        <el-form ref="form" :model="form" label-width="80px">
          <el-form-item label="用户名">
            <el-input v-model="form.username" type="text" v-show="form.username!=='admin'"></el-input>
            <el-input v-model="form.username" type="text" v-show="form.username==='admin'" disabled></el-input>
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

  export default{
    data :function(){
      return{
        form:{
          username : this.$route.query.username,
          password : ""
        }
      }
    },
    mounted:function(){
      this.getMsg();
    },
    methods:{
      getMsg(){
        axios.post("/register/getMsg").then((response) => {
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
      onSubmit(){
        axios.post("/register/changeUser", {
          oldUsername: this.$route.query.username,
          newUsername: this.form.username,
          password: this.form.password
        }).then((response) => {
          if (response.data.code === 0) {
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
            this.$router.replace('/admin');//刷新界面
          }else{
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
