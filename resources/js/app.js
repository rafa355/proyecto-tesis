import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

window.axios = require('axios');
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

import App from '~/views/Index.vue';

import plugins from "../plugins";

import router from "~/router";
import store from "~/store";

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }

    // if logged in redirect to search
    if (to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'search' })
        return
    }

    next()
})

// window.Vue = require('vue');


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

window.onload = function() {
    const app = new Vue({
        router,
        store,
        render: h => h(App)
    }).$mount('#app')
}

const $ = require('jquery')
window.$ = $

require('./bootstrap');
// require('../plugins/bootstrap.js');
// require('../plugins/bootstrap.min.js');
require('../plugins/owl.carousel.js');
require('../plugins/jquery.fancybox.min.js');
// require('../plugins/gmap.js');
// require('http://maps.google.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U');
require('../plugins/swiper.jquery.min.js');

require('../plugins/script.js');