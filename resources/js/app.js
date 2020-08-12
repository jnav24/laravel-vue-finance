require('./bootstrap');
window.Vue = require('vue');

Vue.prototype.$bus = new Vue();

Vue.component('balance-list', require('./components/BalanceList.vue').default);
Vue.component('balance-summary', require('./components/Summary.vue').default);
Vue.component('navigation', require('./components/Nav.vue').default);

const app = new Vue({
    el: '#app',
});
