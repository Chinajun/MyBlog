<!-- 右侧列表 -->
<template>
  <div>
      <div :class="isHome?'rightBox-1-home':'rightBox-1'" id="rightBox-1">
      <el-card>
        <img :src="require('@/assets/tx999.jpg')" class="touxiang">
        <div class="intro-1">
          <span>菅野千寻</span>
        </div>
        <div class="contact">
          <el-tooltip  class="item" content="Github">
            <a :href="contactList.github" target="_blank"><i class="fa fa-github"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="QQ">
            <a :href="require('@/assets/qq.jpg')" target="_blank"><i class="fa fa-qq"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="微博">
            <a :href="contactList.weibo" target="_blank"><i class="fa fa-weibo"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="微信">
            <a :href="require('@/assets/wechat.png')" target="_blank"><i class="fa fa-wechat"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="简历">
            <a target="_blank"><i class="fa fa-file-code-o"></i></a>
          </el-tooltip>
        </div>
      </el-card>
    </div>
    <div :class="isHome?'rightBox-2-home':'rightBox-2'" id="rightBox-2">
      <el-card>
        <div class="intro-2">
          <span>我的朋友们</span>
        </div>
        <div class="users" v-for="(item,index) in userList" :key="index">
          <el-tooltip  class="item" :content="item.username">
            <img :src="require('@/assets/tx'+item.img+'.jpg')" class="touxiang-small">
          </el-tooltip>
        </div>
        <div class="users users-more" v-show="userList.length==7">
          <a><i class="el-icon-more"></i></a>
        </div>
      </el-card>
    </div>
    <!--   do you like me -->
<!--    <div class="rightBox-2">-->
<!--      <el-card>-->
<!--        <section class="rs2">-->
<!--          <p>-->
<!--            Do you like me?-->
<!--          </p>-->
<!--          <div class="rs2-like">-->
<!--            <i :class="like?'heart-active':'heart'" @click="addLike"></i>-->
<!--            &lt;!&ndash;          <i :class="loveme?'heart active':'heart'" ></i>&ndash;&gt;-->
<!--&lt;!&ndash;            <span>{{likeNum}}</span>&ndash;&gt;-->
<!--          </div>-->
<!--        </section>-->
<!--      </el-card>-->
<!--    </div>-->
    <!--   do you like me -->
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    props:{
      isHome:''
    },
    data(){
      return{
        contactList:{
          github:"https://github.com/Chinajun",
          weibo:"https://weibo.com/vitamin61/home",
          // qq:"require('@/assets/qq.jpg')",
          // wechat:"require('@/assets/wechat.png')",
        },
        userList:[],
        top:0,
        // likeNum:0,
        // like:false,
      }
    },
    mounted() {
      this.getUsers();
      // window.addEventListener('beforeunload', e => this.beforeunloadHandler(e))
    },
    // destroyed() {
    //   window.removeEventListener('beforeunload', e => this.beforeunloadHandler(e))
    // },
    created() {
      var that_isHome = this.isHome;
      window.onscroll = function(){
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if(that_isHome===true){
          var pageScroll1 = document.getElementById("rightBox-1");
          var pageScroll2 = document.getElementById("rightBox-2");
          var PageId = document.querySelector('#page');
          if(t>PageId.offsetTop){
            pageScroll1.style.position = 'fixed';
            pageScroll2.style.position = 'fixed';
          }else{
            pageScroll1.style.position = 'static';
            pageScroll2.style.position = 'static';
          }
        }
      }
    },
    methods:{
      getUsers(){
        axios.post("/api/blog/getUsers",).then((response) => {
          for(let i=0;i<response.data.length;i++){
            this.userList.push(response.data[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // addLike(){
      //   // this.like = true;
      // },
      // beforeunloadHandler(e){
      //   // if (e) {
      //   //   // e.returnValue = "您是否确认离开此页面-您输入的数据可能不会被保存";
      //   //   e.returnValue = "aaa-bbb";
      //   // }
      //   // return "ccc-ddd";
      //   // // return "您是否确认离开此页面-您输入的数据可能不会被保存";
      // },
    }
  }
</script>
<style>
  .rightBox-1-home{
    width: 400px;
    margin: 50px 0;
    right: 7%;
    top: 10%;
  }
  .rightBox-1{
    width: 400px;
    margin: 50px 0;
    position: fixed;
  }
  .rightBox-2-home{
    width: 400px;
    margin: 400px 0;
    right: 7%;
    top: 10%;
  }
  .rightBox-2{
    width: 400px;
    position: fixed;
    margin: 400px 0;
  }
  .rightBox-1:hover,.rightBox-2:hover,.rightBox-1-home:hover,.rightBox-2-home:hover{
    box-shadow: 0px 1rem 2rem 0px rgba(48, 55, 66, 0.15);
    transform: translate(0,-5px);
    transition-delay: 0s !important;
  }
  .touxiang{
    border-radius: 50%;
    width: 150px;
    margin-left: 100px;
  }
  .touxiang-small{
    width: 50px;
    border-radius: 50%;
  }
  .intro-1{
    text-align: center;
    margin-top: 20px;
    font-weight: bold;
  }
  .intro-2{
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .contact .item i{
    background-color: #d9d9d9;
    font-size: 18px;
    width:42px;
    height:42px;
    line-height: 42px;
    text-align: center;
    border-radius: 50%;
    margin: 10px;
  }
  .users{
    margin: 0px 10px 10px 20px;
    float: left;
  }
  .users-more{
    background-color: #d9d9d9;
    font-size: 18px;
    width:50px;
    height:50px;
    line-height: 50px;
    text-align: center;
    border-radius: 50%;
  }

  /*!*************do you like me*******************!*/
  .rs2{
    /*padding:10px 0 4px 0;*/
    min-height: 100px;
  }
  /*.rightlistBox .rs2.fixed{*/
  /*  position: fixed;*/
  /*  top:40px;*/
  /*  width:22%;*/
  /*}*/
  .rs2 p{
    color:#DF2050;
    cursor: pointer;
    font-size: 20px;
    margin-bottom: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
    margin-top:10px;
    font-weight: 500;
  }
  .rs2-like{
    color:#DF2050;
    cursor: pointer;
    text-align: center;
    font-size: 40px;
    position: absolute;
    width:100%;
    height:100px;
    line-height: 100px;
    left:0;
    top:30px;
  }
  .heart{
    width: 50px;
    height: 50px;
    /*test*/
    display: inline-block;
    text-align: center;
    /*width: 100px;*/
    /*height: 100px;*/
    margin-left: -20px;
    margin-top:-5px;
    background-image: url("../assets/heart.png");
    background-size: 100% 100%;
    cursor: pointer;
    -webkit-transition: background-position 1s steps(28);
    transition: background-position 1s steps(28);
    -webkit-transition-duration: 0s;
    transition-duration: 0s;
    vertical-align: middle;
  }
  .heart:hover{
    transform: scale(1.15);
    -webkit-transform: scale(1.15);
  }
  .heart-active{
    -webkit-transition-duration: 1s;
    transition-duration: 1s;
    background-position: -2800px 0;
  }
  .rs2 div span{
    margin-left: -30px;
  }
</style>
