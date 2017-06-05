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
    { path: '/', component: Landing, name: 'landing'},
    { path: '/projekti', component: Projects, name: 'projects'},
    { path: '/projekti/:slug', component: Project, name: 'project'},
    { path: '/kontakt', component: Contact, name: 'contact'}
  ]
});

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
