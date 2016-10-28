window.$ = window.jQuery = require('jquery');
require('bootstrap');
window.swal = require('sweetalert2');

import "sweetalert2/dist/sweetalert2.css";
import 'bootstrap/dist/css/bootstrap.css';
import './assets/css/AdminLTE.min.css';
import './assets/css/font-awesome.css';
import './assets/css/style.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import VueValidator from 'vue-validator';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(VueValidator);

Vue.config.debug = true;
Vue.config.silent = false;
Vue.config.devtools = true;
Vue.http.options.root = '/admin';

/**
 * 路由配置
 */
let router = new VueRouter();
import routeMap from './routes';
routeMap(router);

/**
 * 用户登录信息
 */
import Auth from './lib/Auth';
window.Auth = Auth;
let user = Auth.getUser();
if (!!user) {
    // 添加header认证
    Vue.http.headers.common['Authorization'] = 'Bearer ' + user.token;
}

/**
 * 请求、响应拦截器
 */
import interceptors from './interceptors';
interceptors(router);

import App from './app.vue';
router.start(App, '#app');


