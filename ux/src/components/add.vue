<!-- 发表文章组件 -->
<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="msg-title">写文章</span>
        <el-button style="float: right; padding: 3px 0" type="text"  @click="toLast">返回</el-button>
      </div>
      <div class="msg-container">
        <el-form model="">
          <div class="add-btn">
            <span>请选择文章标签：</span>
            <el-radio v-model="mark" label="笔记" border>笔记</el-radio>
            <el-radio v-model="mark" label="日常" border>日常</el-radio>
          </div>
          <el-form-item><el-input type="text" :rows="2" placeholder="标题"></el-input></el-form-item>
          <el-form-item><el-input type="textarea" :rows="10" placeholder="内容"></el-input></el-form-item>
          <el-form-item><el-button type="primary" class="msg-btn">发布</el-button></el-form-item>
        </el-form>
      </div>
    </el-card>
  </div>
</template>
<script>
  export default {
    data(){
      return{
        mark:"笔记"
      }
    },
    methods:{
      toLast(){
        this.$router.go(-1)
      }
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
  .add-btn{
    margin-bottom: 20px;
  }
</style>
