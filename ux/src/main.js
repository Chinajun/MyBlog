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
Vue.use(Vuex);
import store from './store'
Vue.config.productionTip = false;
import 'font-awesome/css/font-awesome.css' //引用fa
import  mavonEditor  from 'mavon-editor' // 引用md文本编辑器
import 'mavon-editor/dist/css/index.css'
Vue.use(mavonEditor);
import VueLazyload from 'vue-lazyload' // 图片懒加载
Vue.use(VueLazyload);

router.beforeEach((to, from, next) => {
  // 更换页面名
  if (to.meta.title) {
  document.title = to.meta.title
  }

  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;

  // 判断该路由是否需要登录权限
  if (to.meta.type === 'login') {
    if (localStorage.getItem('userInfo')) {
      next()
    } else {
      next('/login')
    }
  } else {
    next()  // 确保一定要有next()被调用
  }
});

new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
});


