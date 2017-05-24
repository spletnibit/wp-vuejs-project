import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import Meta from 'vue-meta'
Vue.use(Meta);

import VueResource from 'vue-resource';
Vue.use(VueResource);

var Landing = require('./pages/landing.vue');
var Projects = require('./pages/projects.vue');
var Project = require('./pages/project.vue');
var Contact = require('./pages/contact.vue');

var router = new VueRouter({
  mode: 'history',
  base: '/',
  routes: [
    { path: '/', component: Landing},
    { path: '/projekti', component: Projects},
    { path: '/projekti/:slug', component: Project},
    { path: '/kontakt', component: Contact}
  ]
});

new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
