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
import Dropdown from 'vue-simple-search-dropdown';
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'

Vue.use(Dropdown);
Vue.use(VueRouter);
Vue.use( CKEditor );
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)
Vue.component('index', require('./components/profile/index.vue').default);
Vue.component('content-component', require('./components/profile/content-component.vue').default);
Vue.component('users-list', require('./components/users/list.vue').default);
Vue.component('animals-list', require('./components/animals/list.vue').default);
Vue.component('animalweight', require('./components/animals/animalweight.vue').default);
Vue.component('animalration', require('./components/animals/animalration.vue').default);
Vue.component('rations-list', require('./components/admin-rations/list.vue').default);
Vue.component('ration-create', require('./components/rations/create.vue').default);
Vue.component('list-food', require('./components/rations/listFood.vue').default);
Vue.component('front-rations-list', require('./components/rations/list.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

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
