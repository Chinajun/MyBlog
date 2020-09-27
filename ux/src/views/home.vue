<!-- 首页 -->
<template>
  <div>
    <cyj-header></cyj-header>
    <div>
<!--      <img class="headImg" :src="require('@/assets/header.jpg')"/>-->
      <img class="headImg" v-lazy="headImg"/>
      <!-- 遮罩层 -->
      <div class="topLayer">
      </div>
      <div class="headWord">
        <i class="fa fa-quote-left i-left"></i>
        <div class="word">
          <span v-for="(letter,index) in words" :key="index">{{letter}}</span>
        </div>
        <i class="fa fa-quote-right i-right"></i>
        <span class="i-from">—— {{hitokoto.username}}</span>
      </div>
      <div class="i-down">
        <i class="el-icon-arrow-down" @click="toDown()"></i>
      </div>
    </div>
    <div class="bodyBox" id="page">
      <el-row>
<!--         xs手机 md电脑-->
        <el-col :xs="16" :sm="16" :md="16">
          <cyj-paper></cyj-paper>
        </el-col>
        <el-col :xs="8" :sm="8" :md="8">
          <cyj-right :isHome=true></cyj-right>
        </el-col>
      </el-row>
    </div>
    <cyj-footer></cyj-footer>
  </div>
</template>
<script>
  const header = ()=>import("../components/header");
  const right = ()=>import("../components/right");
  const footer = ()=>import("../components/footer");
  const paper = ()=>import("../components/paper");
  import axios from "axios";
  export default {
    components:{
      'cyj-header':header,
      'cyj-paper':paper,
      'cyj-right':right,
      'cyj-footer':footer,
    },
    data(){
      return{
        headImg: require('@/assets/header.jpg'),
        hitokoto:{},
        words:[],               //字母数组push，pop的载体
        str:"Hello!",          //str初始化
        letters:[],             //str分解后的字母数组
        order:1,                //表示当前是第几句话
      }
    },
    mounted(){
      this.getMotto();
      this.begin();
    },
    watch:{                     //监听order值的变化，改变str的内容
      order(old,newV){
        if(this.order===1){
          this.str="Hello!"
        }else{
          this.str=this.hitokoto.content
        }
      }
    },
    methods: {
      getMotto(){
        axios.get("https://v1.hitokoto.cn/",).then((response) => {
          this.hitokoto.content = response.data.hitokoto;
          this.hitokoto.username = response.data.from;
        }).catch(function (error) {
          console.log(error);
        });
      },
      //开始输入的效果动画
      begin(){
        this.letters=this.str.split("")
        for(var i=0;i<this.letters.length;i++){
          setTimeout(this.write(i),i*100);
        }
      },
      //开始删除的效果动画
      back(){
        let L=this.letters.length;
        for(var i=0;i<L;i++){
          setTimeout(this.wipe(i),i*50);
        }
      },
      //输入字母
      write(i){
        return ()=>{
          let L=this.letters.length;
          this.words.push(this.letters[i]);
          let that=this;
          /*如果输入完毕，在2s后开始删除*/
          if(i==L-1){
            setTimeout(function(){
              that.back();
            },2000);

          }
        }
      },
      //擦掉(删除)字母
      wipe(i){
        return ()=>{
          if(this.order!==2){
            this.words.pop(this.letters[i]);
            /*如果删除完毕，在300ms后开始输入*/
            if(this.words.length==0){
              this.order++;
              let that=this;
              setTimeout(function(){
                that.begin();
              },300);
            }
          }
        }
      },
      toDown(){
        var PageId = document.querySelector('#page');
        // console.log(this.pageHeight);
        window.scrollTo({
          'top': PageId.offsetTop,
          'behavior': 'smooth'
        })
      }
    }
  }
</script>
<style>
  /*.home-header{*/
  /*  opacity: 0.7;*/
  /*}*/
  .headImg{
    width: 100%;
    height: 100vh;
    overflow: hidden;
  }
  .topLayer{
    position: absolute;
    top: 0;
    left: 0;
    background-color:#000;
    min-width: 1200px;
    width: 100%;
    height: 100vh;
    opacity: 0.4;
  }
  .headWord{
    min-width: 1200px;
    width: 100%;
    height: 350px;
    position: absolute;
    top: 50%;
    margin-top: -150px;
    z-index: 2;
    font-size: 45px;
    color: #d9d9d9;
    overflow: hidden;
  }
  .headWord .i-left{
    position: absolute;
    left: 20%;
  }
  .headWord .i-right{
    position: absolute;
    right: 20%;
    top: 60%;
  }
  .headWord .word{
    line-height: 1.5;
    width: 80%;
    height: 50%;
    position: absolute;
    left: 50%;
    /*margin-left: -250px;*/
    top: 30%;
    text-align: center;
    color: white;
    font-weight: 400 !important;
    font-size: 2rem !important;
  }
  .word span{
    font-family: 'helloFont';
    font-size: 3rem;
    position: relative;
    left: -50%;
  }
  .headWord .i-from{
    font-family: 'helloFont';
    font-size: 30px;
    position: absolute;
    top: 80%;
    right: 20%;
  }
  .i-down{
    width: 100%;
    min-width: 1200px;
    overflow: hidden;
    text-align: center;
    position: absolute;
    top: 80%;
  }
  .i-down i{
    color: #d9d9d9;
    font-size: 60px;
    font-weight: bold;
  }
  .i-down i:hover{
    color: #8c939d;
  }
  .bodyBox{
    padding-top: 100px;
    min-height: 1000px;
  }
</style>
