<template>
  <div>
    <el-card class="box-card" v-if="isMsgbd">
      <div slot="header" class="msg-title">留言板</div>
      <img :src="require('@/assets/msg.jpg')" class="msg-img">
      <div class="msg-desc">
        <p>
          1990年，旅行者1号于距地球64亿公里处最后一次回望母星，拍摄下这张照片。
        </p>
        <p>
          “我们成功地拍摄了这张照片，当你看它，会看到一个小点。那就是这里，那就是家园，那就是我们。你所爱的每个人，认识的每个人，听说过的每个人，历史上的每个人，都在它上面活过了一生。我们物种历史上的所有欢乐和痛苦，千万种言之凿凿的宗教、意识形态和经济思想，所有狩猎者和采集者，所有英雄和懦夫，所有文明的创造者和毁灭者，所有的皇帝和农夫，所有热恋中的年轻人，所有的父母、满怀希望的孩子、发明者和探索者，所有道德导师，所有腐败的政客，所有 ‘超级明星’，所有 ‘最高领袖’，所有圣徒和罪人——都发生在这颗悬浮在太阳光中的尘埃上。”
        </p>
        <p style="text-align: right">
          —— 卡尔·萨根
        </p>
      </div>
    </el-card>
    <el-card class="box-card" v-else>
      <div slot="header">
        <span class="msg-title">{{title}}</span>
        <el-button style="float: right; padding: 3px 0" type="text"  @click="toLast">返回</el-button>
      </div>
      <div class="detail-desc"><pre>{{content}}</pre></div>
    </el-card>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">发表评论</span>
        <div class="msg-container">
          <el-form :model="commentList" ref="commentList">
            <el-form-item prop="content"><el-input v-model="commentList.content" type="textarea" :rows="2" placeholder="说点什么吧..."></el-input></el-form-item>
            <el-form-item><el-button type="primary" class="msg-btn" @click="onSubmit">发送</el-button></el-form-item>
          </el-form>
        </div>
      </div>
      <div v-for="(item,index) in msgList" :key="index" class="msg-box">
        <div>
          <div class="pict">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-mid">
          </div>
          <div class="others">
            <div class="others-username">{{item.username}}</div>
            <div class="others-time">{{item.create_time}}</div>
            <div class="others-content">{{item.content}}</div>
            <el-button style="float: right; padding: 3px 0" type="text" @click="toDetail(item)">回复</el-button>
          </div>
        </div>
        <div class="underComment" v-for="(item2,index2) in msgList[index].comment" :key="index2">
          <div class="pict">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </div>
          <div class="othersComment">
            <div class="othersComment-username">{{item2.username}}</div>
            <div class="othersComment-time">{{item2.create_time}}</div>
            <div class="othersComment-content">{{item2.content}}</div>
          </div>
        </div>
      </div>
      <el-pagination
        style="float: right"
        :page-size="10"
        layout="prev, pager, next"
        @current-change="handleCurrentChange"
        :total="this.page_count">
      </el-pagination>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";

  export default {
    data(){
      return{
        // 文章详情
        title:"",
        content:"",
        username:"",
        create_time:"",
        // 评论
        msgList:[],
        // 发表评论
        commentList:{
          content:"",
          create_time:""
        },
        aid:0,
        pid:0,
        page:1,
        page_count:3 //TODO
      }
    },
    props:{
      isMsgbd:""
    },
    mounted() {
      if(this.isMsgbd===false){
        this.aid = this.$route.query.Id;
        this.getDetailArticle();
      }
      this.getMsgComment();
    },
    methods:{
      // 文章详情页
      toLast(){
        this.$router.go(-1)
      },
      // 根据Id获取文章信息
      getDetailArticle() {
        // console.log(this.$route.query);
        axios.post("/api/blog/getDetailArticle",{
          Id:this.$route.query.Id
        }).then((response) => {
          this.title = response.data.title;
          this.content = response.data.content;
          this.username = response.data.username;
          this.create_time = response.data.create_time;
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 获得评论（留言板aid=0,父评论pid=0）
      getMsgComment(){
        axios.post("/api/blog/getComment",{
          aid:this.aid,
          page:this.page
        }).then((response) => {
          this.msgList=[];
          this.page_count = response.data.data.count;
          for(let i=0;i<response.data.data.result_fa.length;i++){
            // console.log(response.data.data.result_fa[i].create_time);
            // response.data.data.result_fa[i].create_time
            this.msgList.push(response.data.data.result_fa[i]);
            this.msgList[i].comment = [];
          }
          for(let i=0;i<response.data.data.result_son.length;i++){
            for(let j=0;j<this.msgList.length;j++){
              if(this.msgList[j].Id===response.data.data.result_son[i].pid){
                this.msgList[j].comment.push(response.data.data.result_son[i]);
              }
            }
          }
          // console.log(this.msgList);
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 分页
      handleCurrentChange(val){
        this.page = val;
        this.getMsgComment();
      },
      // 发表评论
      onSubmit(){
        this.commentList.create_time = Math.round(new Date() / 1000);
        axios.post("/api/blog/addComment", {
          content: this.commentList.content,
          username: this.$cookies.get("username"),
          create_time:this.commentList.create_time,
          aid:this.aid,
          pid:this.pid
        }).then((response) => {
          if (response.data.code === 0) {
            this.$message({
              message: response.data.msg,
              type: 'success'
            });
            this.$router.go(0);
          } else {
            this.$message({
              message: response.data.msg,
              type: 'error'
            });
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
    }
  }
</script>
<style>
  /* pre自动换行 */
  pre{
    white-space: pre-wrap;           /* css-3 */
    white-space: -moz-pre-wrap;      /* Mozilla, since 1999 */
    /*white-space: -pre-wrap;          !* Opera 4-6 *!*/
    white-space: -o-pre-wrap;        /* Opera 7 */
    word-wrap: break-word;           /* Internet Explorer 5.5+ */
  }
  .detail-desc{
    margin: 20px;
    line-height: 30px;
  }
  .box-card{
    margin: 50px 100px;
  }
  .box-card:hover{
    box-shadow: 0px 1rem 2rem 0px rgba(48, 55, 66, 0.15);
    transform: translate(0,-5px);
    transition-delay: 0s !important;
  }
  .msg-img{
    margin-left: 20%;
    margin-bottom: 20px;
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
  .msg-btn{
    width: 100%;
    height: 30px;
  }
  .msg-box{
    margin: 30px 10px;
  }
  .touxiang-mid{
    width: 70px;
    border-radius: 50%;
  }
  .touxiang-small{
    width: 50px;
    border-radius: 50%;
  }
  .pict{
    float: left;
  }
  .others{
    padding-bottom: 20px;
    margin-left: 100px;
  }
  .others-username{
    font-size: 16px;
    font-weight: bold;
  }
  .others-time{
    font-size: 12px;
    color: #8c939d;
    float: right;
    margin-left: 30px;
  }
  .others-content{
    width: 430px;
    font-size: 14px;
    margin: 10px;
  }
  .othersComment-username{
    font-weight: bold;
    font-size: 14px;
  }
  .othersComment-time{
    font-size: 10px;
    color: #8c939d;
    float: right;
    margin-left: 30px;
  }
  .othersComment-content{
    width: 360px;
    font-size: 14px;
    margin: 10px;
  }
  .othersComment{
    margin-left: 70px;
  }
  .underComment{
    margin: 10px 0 20px 100px;
  }

</style>
