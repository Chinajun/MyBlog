<!-- TODO 可删除 -->
<template>
  <div>
  <span>用户{{username}}登陆成功！</span>
    <el-button @click="logout">退出登录</el-button>
  </div>
</template>
<script>
  import axios from "axios";
  export default{
    name:'page1',
    data:function () {
      return{
        username:this.$route.params.username//注意!!!获取时要用this.$route不是$this.$router!!!
        // username:''
      }
    },
    mounted:function(){
      this.getMsg();
    },
    methods:{
      getMsg(){
        axios.post("/api/register/getMsg").then((response) => {
          if(response.data.code===1){
            this.$router.replace('/admin');
            this.$cookies.set('data',this.$route.params.username);
          }else if(response.data.code===0){
            // this.username=response.data;
            this.$cookies.set('data',this.$route.params.username);
          }else{
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
      logout(){
        this.$cookies.remove('data','/','localhost');
        this.$router.replace('/login');
      }
    }
  }
</script>
