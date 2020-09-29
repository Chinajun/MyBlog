<!-- 我的文章界面 -->
<template>
  <div>
    <cyj-header></cyj-header>
    <div class="bodyBox" id="bodyBox">
      <el-row>
        <el-col :xs="16" :sm="16" :md="16">
          <cyj-myArticle></cyj-myArticle>
        </el-col>
        <el-col :xs="8" :sm="8" :md="8">
          <cyj-right></cyj-right>
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
  const myArticle = ()=>import("../components/myArticle");
  export default {
    components:{
      'cyj-header':header,
      'cyj-right':right,
      'cyj-footer':footer,
      'cyj-myArticle':myArticle
    },
    mounted() {
      if (this.isMobile()) {
        // 手机端背景图片横向不平铺，设定min-height
        var bodyBox = document.getElementById('bodyBox');
        bodyBox.style.minHeight = '2500px';
      }
    },
    methods:{
      // 识别手机端还是pc端
      isMobile() {
        let flag = navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i)
        return flag;
      },
    }
  }
</script>
<style>
  .bodyBox{
    padding-top: 100px;
    min-height: 1000px;
  }
</style>
