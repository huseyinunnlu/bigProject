/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import CKEditor from 'ckeditor4-vue';

Vue.use( CKEditor );
Vue.use(VueRouter);
Vue.component('index', require('./components/profile/index.vue').default);
Vue.component('content-component', require('./components/profile/content-component.vue').default);
Vue.component('users-list', require('./components/users/list.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode:'history',
    routes:routes
});

const app = new Vue({
    el: '#app',
    router: router,
});
