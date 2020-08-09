<!-- 右侧列表 -->
<template>
  <div>
    <div class="rightBox-1">
      <el-card>
        <img :src="require('@/assets/touxiang.jpg')" class="touxiang">
        <div class="intro-1">
          <span>菅野千寻</span>
        </div>
        <div class="contact">
          <el-tooltip  class="item" content="Github">
            <a><i class="fa fa-github"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="QQ">
            <a><i class="fa fa-qq"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="微博">
            <a><i class="fa fa-weibo"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="微信">
            <a><i class="fa fa-wechat"></i></a>
          </el-tooltip>
          <el-tooltip  class="item" content="简历">
            <a><i class="fa fa-file-code-o"></i></a>
          </el-tooltip>
        </div>
      </el-card>
    </div>
    <div class="rightBox-2">
      <el-card>
        <div class="intro-2">
          <span>我的朋友们</span>
        </div>
        <div class="users">
          <el-tooltip  class="item" content="菅野千寻">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </el-tooltip>
          <el-tooltip  class="item" content="菅野千寻">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </el-tooltip>
          <el-tooltip  class="item" content="菅野千寻">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </el-tooltip>
          <el-tooltip  class="item" content="菅野千寻">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </el-tooltip>
          <el-tooltip  class="item" content="菅野千寻">
            <img :src="require('@/assets/touxiang.jpg')" class="touxiang-small">
          </el-tooltip>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
  export default {
    data(){
      return{

      }
    },
    methods:{

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
  .rightBox-2 .users .item{
    margin: 10px 15px;
  }
  .box-card{
    margin: 50px 100px;
  }
</style>
