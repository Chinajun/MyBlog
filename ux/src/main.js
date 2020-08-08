// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router.js'//引用router.js
import ElementUI from 'element-ui'//引入element ui
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI);
import axios from "axios";
import VueSession from 'vue-session';
Vue.use(VueSession);
import VueCookies from 'vue-cookies'
Vue.use(VueCookies);
import Vuex from 'vuex'
Vue.use(Vuex)
import store from './store'
Vue.config.productionTip = false;
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
});

