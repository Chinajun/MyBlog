<template>
  <div>
    <el-card class="box-card">
      <div slot="header" class="msg-title">关于我</div>
      <img :src="require('@/assets/qingnv.jpg')" class="about-img">
      <div class="about-desc">
        <p>
          嗨，你好。这里是千寻。自我介绍施工中...
        </p>
      </div>
    </el-card>
  </div>
</template>
<script></script>
<style>
  .box-card{
    margin: 50px 100px;
  }
  .box-card:hover{
    box-shadow: 0px 1rem 2rem 0px rgba(48, 55, 66, 0.15);
    transform: translate(0,-5px);
    transition-delay: 0s !important;
  }
  .about-img{
    width: 100%;
    margin-bottom: 20px;
  }
  .msg-title{
    font-weight: bold;
  }
  .about-desc p{
    text-align: center;
    font-size: 14px;
    line-height: 30px;
  }
</style>
