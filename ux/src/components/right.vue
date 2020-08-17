<!-- 右侧列表 -->
<template>
  <div>
    <div class="rightBox-1" id="rightBox-1">
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
    <div class="rightBox-2" id="rightBox-2">
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
<!--    <div>-->
<!--      <section :class="fixDo?'rs2 fixed':'rs2'" @click="lovemeFun">-->
<!--        <p>-->
<!--          Do you like me?-->
<!--        </p>-->
<!--        <div class="">-->
<!--          <i :class="loveme?'heart active':'heart'" ></i>-->
<!--          <span>{{likeNum}}</span>-->
<!--        </div>-->
<!--      </section>-->
<!--    </div>-->
  </div>
</template>
<script>
  import axios from "axios";
  export default {
    data(){
      return{
        contactList:{
          github:"https://github.com/Chinajun",
          weibo:"https://weibo.com/vitamin61/home",
          // qq:"require('@/assets/qq.jpg')",
          // wechat:"require('@/assets/wechat.png')",
        },
        userList:[],
      }
    },
    mounted() {
      this.getUsers();
    },
    // watch:{
    //   isFixed(old,newV){
    //     // 鼠标滚动时
    //     window.onscroll=function(){
    //       var topScroll =document.body.scrollTop;//滚动的距离,距离顶部的距离
    //       var pageScroll1 = document.getElementById("rightBox-1");
    //       var pageScroll2 = document.getElementById("rightBox-2");//获取到导航栏id
    //       if(topScroll >= 150){
    //         debugger
    //         //当滚动距离小于250的时候执行下面的内容，也就是让导航栏恢复原状
    //         pageScroll1.style.position = 'static';
    //       }else{
    //         debugger
    //         //当滚动距离大于250px时执行下面的东西
    //         pageScroll1.style.position = 'fixed';
    //         console.log(pageScroll1)
    //       }
    //     }
    //   }
    // },
    methods:{
      getUsers(){
        axios.post("/api/blog/getUsers",).then((response) => {
          for(let i=0;i<response.data.length;i++){
            this.userList.push(response.data[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      }
    }
  }
</script>
<style>
  .rightBox-1{
    width: 400px;
    margin: 50px 0;
    position: fixed;
  }
  .rightBox-2{
    width: 400px;
    position: fixed;
    margin: 400px 0;
  }
  .rightBox-1:hover,.rightBox-2:hover{
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
  .rightBox-2 .users{
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
  /*.rightlistBox .rs2{*/
  /*  !*padding:10px 0 4px 0;*!*/
  /*  min-height: 100px;*/
  /*}*/
  /*.rightlistBox .rs2.fixed{*/
  /*  position: fixed;*/
  /*  top:40px;*/
  /*  width:22%;*/
  /*}*/
  /*.rightlistBox .rs2 p{*/
  /*  color:#DF2050;*/
  /*  cursor: pointer;*/
  /*  font-size: 20px;*/
  /*  margin-bottom: 10px;*/
  /*  white-space: nowrap;*/
  /*  overflow: hidden;*/
  /*  text-overflow: ellipsis;*/
  /*  text-align: center;*/
  /*  margin-top:10px;*/
  /*  font-weight: 500;*/
  /*}*/
  /*.rightlistBox .rs2 div{*/
  /*  color:#DF2050;*/
  /*  cursor: pointer;*/
  /*  text-align: center;*/
  /*  font-size: 40px;*/
  /*  position: absolute;*/
  /*  width:100%;*/
  /*  height:100px;*/
  /*  line-height: 100px;*/
  /*  left:0;*/
  /*  top:30px;*/
  /*}*/
  /*.rightlistBox .rs2 div i.heart{*/
  /*  display: inline-block;*/
  /*  text-align: center;*/
  /*  width: 100px;*/
  /*  height: 100px;*/
  /*  margin-left: -20px;*/
  /*  margin-top:-5px;*/
  /*  background: url(../../static/img/heart.png) no-repeat;*/
  /*  background-position: 0 0;*/
  /*  cursor: pointer;*/
  /*  -webkit-transition: background-position 1s steps(28);*/
  /*  transition: background-position 1s steps(28);*/
  /*  -webkit-transition-duration: 0s;*/
  /*  transition-duration: 0s;*/
  /*  vertical-align: middle;*/
  /*}*/
  /*.rightlistBox .rs2 div i.heart:hover{*/
  /*  transform: scale(1.15);*/
  /*  -webkit-transform: scale(1.15);*/
  /*}*/
  /*.rightlistBox .rs2 div i.heart.active{*/
  /*  -webkit-transition-duration: 1s;*/
  /*  transition-duration: 1s;*/
  /*  background-position: -2800px 0;*/
  /*}*/
  /*.rightlistBox .rs2 div span{*/
  /*  margin-left: -30px;*/
  /*}*/
</style>
