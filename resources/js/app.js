import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);
Vue.prototype.$bus = new Vue();

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
});
