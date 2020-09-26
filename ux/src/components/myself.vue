<template>
  <div>
    <el-card class="box-card">
      <div slot="header" class="msg-title">关于我</div>
      <img :src="require('@/assets/qingnv.jpg')" class="about-img">
      <div class="about-desc">
        <p>嗨，你好。</p>
        <p>欢迎来到我的秘密基地。</p>
        <el-table
          :data="myElement"
          border
          stripe
          :show-header="false"
          style="width: 100%;margin: 20px 0">
          <el-table-column prop="title">
            <template slot-scope="scope"><span style="color: #f78989;font-weight: bold">{{scope.row.title}}</span></template>
          </el-table-column>
          <el-table-column prop="content"></el-table-column>
        </el-table>
      </div>
    </el-card>
  </div>
</template>
<script>
  export default {
    data(){
      return{
        myElement:[
          {title:'姓名',content:'菅野千寻'},
          {title:'生日',content:'1999/12/24'},
          {title:'星座',content:'魔羯'},
          {title:'成分',content:'聪明，可爱，善良，勇敢，坚强'},
          {title:'曾经的梦想',content:'穿越撒哈拉沙漠'},
          {title:'现在的梦想',content:'混吃混喝'},
          {title:'喜欢的食物',content:'火锅，多肉葡萄，巧克力，甜甜圈，以及巧克力甜甜圈'},
          {title:'喜欢的天气',content:'雨天'},
          {title:'音乐品味',content:'Future bass、trap（我的音乐品味就是坠吊的！）'},
          {title:'座右铭',content:'保持独立思考'},
        ]
      }
    },
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
