
require('./bootstrap');

window.Vue = require('vue').default;
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import 'vuetify/dist/vuetify.min.css';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.use(Vuetify);
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
});
