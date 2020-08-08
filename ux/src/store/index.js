import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
const store = new Vuex.Store({
  state:{
    count:1
  },
  getters:{
    getcount(state){
      return state.count+1
    }
  },
  mutations:{
    add(state){
      state.count = state.count+1
    },
    minus(state){
      state.count = state.count-1
    }
  },
  actions:{
    addFun(context){
      context.commit("add")
    },
    minusFun(context){
      context.commit("minus")
    }
  }
});

export default store;
