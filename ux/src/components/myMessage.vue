<!--消息提醒页组件-->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">消息提醒</span>
      </div>
      <div>
        <el-table :data="myMsgList" style="width: 100%" :show-header="false" @row-click="articleDetail">
          <el-table-column prop="id" width="50">
            <template slot-scope="scope">
              {{scope.$index+1}}
            </template>
          </el-table-column>
          <el-table-column prop="content">
            <template slot-scope="scope">
              您收到了一条留言“{{scope.row.content|ellipsis}}”
              <el-badge is-dot v-show="notSee"/>
            </template>
          </el-table-column>
        </el-table>
      </div>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    data(){
      return{
        myMsgList:[],
        notSee:true,
      }
    },
    mounted:function(){
      this.getMyMsg();
    },
    filters: {
      // 过滤器 限制文章内容显示字符
      ellipsis (value) {
        if (!value) return '';
        if (value.length > 30) {
          return value.slice(0,30) + '...'
        }
        return value
      }
    },
    methods:{
      // 获取消息提示
      getMyMsg(){
        axios.post("/public/index.php/blog/getCommentRes",{
          Id:JSON.parse(localStorage.getItem('userInfo')).Id,
          username:JSON.parse(localStorage.getItem('userInfo')).username
        }).then((response) => {
          if (response.data.data.count>0) {
            this.myMsgList = response.data.data.result;
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 跳转文章详情界面
      articleDetail(row,event,column){
        axios.post("/public/index.php/blog/readComment",{
          Id:row.Id
        }).then((response) => {

        }).catch(function (error) {
          console.log(error);
        });
        if(row.aid===0){
          this.$router.push("message")
        }else{
          this.$router.push({path:"articleDetail",query:{Id:row.aid}})
        }
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
</style>
