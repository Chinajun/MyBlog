<template>
    <div>
      <p>{{this.$store.state.count}}</p>
      <el-button @click="addFun">+</el-button>
      <el-button @click="minusFun">-</el-button>
      <p>{{getcount}}</p>
    </div>

</template>

<script>
  import {mapState,mapGetters,mapActions} from "vuex"
    export default {
        name: "vuex.vue",
      data(){
          return{

          }
      },
      methods:{
        /**
         * 同步操作
         */
        //   addCount(){
        //     this.$store.commit("add");
        //   },
        // minusCount(){
        //     this.$store.commit("minus");
        // }
        /**
         * 含有异步操作
         */
        addFun(){
          this.$store.dispatch("addFun")
        },
        minusFun(){
          this.$store.dispatch("minusFun")
        }
      },
      computed:{
          ...mapGetters({
            getcount:state => state.count
          })
      }
    }
</script>

<style scoped>

</style>
