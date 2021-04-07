require('./bootstrap');

import Vue from 'vue'
Vue.component('app', require('./App.vue').default);
Vue.prototype.$eventBus = new Vue();

new Vue({
    el: '#app',
});
