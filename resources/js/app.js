
require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import MainTemplate from './containers/MainTemplate.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    dir: __dirname,
    routes: routes,
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
            }
        }
    },
    methods: {
        getSize: function() {
            this.window = {
                h: window.innerHeight,
                w: window.innerWidth
            }
        }
    },
    mounted: function() {
        this.getSize()
        window.addEventListener('resize', () => {
            this.getSize()
        })
    }
}).$mount('#app')
