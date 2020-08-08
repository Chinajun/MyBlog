<template>
  <div>
    <h1>账号管理界面</h1>
    <br>
    <el-button @click="onReg" type="primary">新增用户</el-button>
    <br>
    <el-table :data="tableData" border style="width: 100%">
      <el-table-column prop="id" label="序号" width="80">
        <template slot-scope="scope">
          {{scope.$index+1}}
        </template>
      </el-table-column>
      <el-table-column prop="username" label="姓名" width="180"></el-table-column>
      <el-table-column prop="create_time" label="注册时间" width="180"></el-table-column>
      <el-table-column label="管理用户" width="180">
        <template slot-scope="scope">
        <el-button type="primary" icon="el-icon-edit" circle @click="edit(scope.$index)"></el-button>
        <el-button type="danger" icon="el-icon-delete" circle @click="dele(scope.$index)"></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    name:'admin',
    data:function () {
      return {
        tableData:[],
      }
    },
    mounted:function(){
      this.getAllMsg();
    },
    methods:{
      getAllMsg(){
        axios.post("/register/getAllMsg").then((response) => {
          if(response.data.code===500){
              this.$router.go(-1);
              this.$message({
                message: response.data.msg,
                type: 'error'
              });
          }else{
            this.tableData=[];
            for(let i=0;i<response.data.length;i++){
              this.tableData.push(response.data[i]);
            }
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      onReg() {
        this.$router.push('/register');//push:有页面记录
      },
      dele(index){
        axios.post("/register/deleteUser", {
          username: this.tableData[index].username
        }).then((response) => {
          if (response.data.code === 0) {
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
            this.$router.go(0);//刷新界面
          }else{
            this.$message({
              message: response.data.msg,
              type: 'error'
            });
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      edit(index){
        this.$router.push({
          path: '/change',
          query: {//通过url传参
            username: this.tableData[index].username
          }
        });
      }
    }
  }
</script>
<style>
</style>
