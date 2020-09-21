<!-- 文章列表 -->
<template>
  <div>
    <div v-for="(item,index) in paperList" :key="index">
      <el-card class="box-card">
        <div slot="header">
          <div style="text-align: center;font-weight: bold" @click="toDetail(item)">{{item.title}}</div>
        </div>
        <div class="paper-content">
          <div class="paper-desc">
            <div class="paper-info">
              <i class="fa fa-user">{{item.username}}</i>
              <i class="el-icon-time">{{item.create_time}}</i>
              <i class="el-icon-view">{{item.view}}</i>
              <el-tag>{{item.mark}}</el-tag>
            </div>
            <div class="paper-content" v-html="$options.filters.ellipsis(item.content)">
<!--              {{item.content|ellipsis}}-->
<!--              <mavon-editor-->
<!--                v-model="item.content"-->
<!--                :editable="isEdit"-->
<!--                :toolbarsFlag="isEdit"-->
<!--                :subfield="isEdit"-->
<!--                defaultOpen="preview"-->
<!--                :boxShadow="isEdit"-->
<!--                previewBackground="#fff"/>-->
            </div>
          </div>
        </div>
        <div class="paper-btn"><el-button class="paper-btn-c" type="primary" @click="toDetail(item)">阅读全文</el-button></div>
      </el-card>
    </div>
    <div class="loadMore" v-if="page<page_count"><el-button @click='loadMore'>点击加载更多</el-button></div>
    <div class="loadMore" v-else ><el-button>没有更多了</el-button></div>
  </div>
</template>
<script>
  import axios from "axios";
  import marked from "marked";
  export default {
    data (){
      return{
        paperList:[],
        page:1,
        page_count:'',
        isEdit:false,
      }
    },
    mounted() {
      this.getAllArticle();
    },
    filters: {
      // 过滤器 限制文章内容显示字符
      ellipsis (value) {
        if (!value) return '';
        if (value.length > 150) {
          return value.slice(0,150) + '...'
        }
        return value
      }
    },
    methods:{
      toDetail(item){
        this.$router.push({path:"articleDetail",query:{Id:item.Id}})
      },
      getAllArticle(){
        axios.post("/api/blog/getArticle",{
          page:this.page
        }).then((response) => {
          // this.paperList = [];
          this.page_count = response.data.data.count/10;
          for(let i=0;i<response.data.data.result.length;i++){
            console.log(response.data.data.result[i].content);
            response.data.data.result[i].content = marked(response.data.data.result[i].content);
            console.log(response.data.data.result[i].content);
            this.paperList.push(response.data.data.result[i]);
          }
        }).catch(function (error) {
          console.log(error);
        });
      },
      // 点击加载更多
      loadMore(){
        this.page+=1;
        this.getAllArticle();
      }
    }
  }
</script>
<style>
  .paper-btn{
    display:flex;
    justify-content:center;
  }
  .paper-info i{
    margin-right: 20px;
  }
  .paper-info{
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
    text-align: center;
    color: #8c939d;
  }
  .paper-content{
    margin: 10px;
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
  .loadMore{
    margin: 50px 100px;
    text-align: center;
  }
</style>
