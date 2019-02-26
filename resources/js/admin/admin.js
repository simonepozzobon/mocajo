
require('../bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './adminroutes'
import Cookie from '../Cookies'
import checkView from 'vue-check-view'
import axios from 'axios'
import VueLayers from 'vuelayers'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vuelayers/lib/style.css'
import MainTemplate from './containers/MainTemplate.vue'

Vue.use(VueRouter)
Vue.use(checkView)
Vue.prototype.$cookie = Cookie
Vue.use(VueLayers)
Vue.prototype.$http = axios
Vue.use(BootstrapVue)

const router = new VueRouter({
    mode: 'history',
    dir: __dirname,
    routes: routes,
    base: '/admin'
})

const app = new Vue({
    router,
    components: {
        MainTemplate
    },
    data: function() {
        return {
            navbar: 1,
            window: {
                h: 0,
                w: 0,
            },
            cart: null,
            navLogo: true,
            cities: null,
            isMobile: false,
        }
    },
    methods: {
        getSize: function() {
            this.window = {
                h: window.innerHeight,
                w: window.innerWidth
            }

            if (this.window.w <= 576) {
                this.isMobile = true
            } else {
                this.isMobile = false
            }
        },
    },
    mounted: function() {
        this.getSize()
        window.addEventListener('resize', () => {
            this.getSize()
        })
    }
}).$mount('#admin')
