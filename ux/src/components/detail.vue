<template>
  <div>
    <el-card class="box-card">
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
            <el-form-item><el-button type="primary" class="msg-btn">发送</el-button></el-form-item>
          </el-form>
        </div>
      </div>
      <div v-for="(item,index) in msgList" :key="index" class="msg-box">
        <div class="pict">
          <img :src="require('@/assets/touxiang.jpg')" class="touxiang-mid">
        </div>
        <div class="others">
          <div class="others-username">{{item.username}}</div>
          <div class="others-time">{{item.time}}</div>
          <div class="others-content">{{item.content}}</div>
        </div>
        <br>
      </div>
    </el-card>
  </div>
</template>
<script>
  import axios from "axios";

  export default {
    data(){
      return{
        title:"标题标题",
        content:"1990年，旅行者1号于距地球64亿公里处最后一次回望母星，拍摄下这张照片。\n          “我们成功地拍摄了这张照片，当你看它，会看到一个小点。那就是这里，那就是家园，那就是我们。你所爱的每个人，认识的每个人，听说过的每个人，历史上的每个人，都在它上面活过了一生。我们物种历史上的所有欢乐和痛苦，千万种言之凿凿的宗教、意识形态和经济思想，所有狩猎者和采集者，所有英雄和懦夫，所有文明的创造者和毁灭者，所有的皇帝和农夫，所有热恋中的年轻人，所有的父母、满怀希望的孩子、发明者和探索者，所有道德导师，所有腐败的政客，所有 ‘超级明星’，所有 ‘最高领袖’，所有圣徒和罪人——都发生在这颗悬浮在太阳光中的尘埃上。”\n",
        username:"菅野千寻",
        create_time:"2020/8/10 11:54",
        msgList:[],
        commentList:{
          content:""
        }
      }
    },
    mounted() {
      this.getDetailArticle();
    },
    methods:{
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
  .detail-desc{
    margin: 20px;
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
  .pict{
    float: left;
  }
  .others{
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
  }
  .others-content{
    font-size: 14px;
    margin: 10px;
  }
</style>
