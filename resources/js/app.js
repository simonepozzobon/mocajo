
require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import Cookie from './Cookies'
import MainTemplate from './containers/MainTemplate.vue'
import checkView from 'vue-check-view'
import VueLayers from 'vuelayers'
import 'vuelayers/lib/style.css'

Vue.use(VueRouter)
Vue.use(checkView)
Vue.prototype.$cookie = Cookie
Vue.use(VueLayers)

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
        cartRemove: function(productIdx) {
            if (this.cart) {
                let idx = this.cart.findIndex(item => item.id == productIdx)
                if (idx >= 0) {
                    this.cart.splice(idx, 1)
                    this.$cookie.set('mocajo-cart', JSON.stringify(this.cart))
                    if (this.cart.lenght == 0) {
                        this.$cookie.destroy('mocajo-cart')
                        this.cart = null
                    }
                }
            }
        },
        cartUpdate: function(product) {
            if (this.cart) {
                let cart = this.cart
                let idx = cart.findIndex(item => item.id == product.id)
                if (idx >= 0) {
                    cart[idx].quantity = product.quantity
                }
                this.$cookie.set('mocajo-cart', JSON.stringify(cart))
                this.cart = []
                this.cart = cart
            }
        },
        addToCart: function(product) {
            if (this.cart) {
                let cart = this.cart
                let idx = cart.findIndex(item => item.id == product.id)
                if (idx >= 0) {
                    cart[idx].quantity = cart[idx].quantity + product.quantity
                } else {
                    cart.push(product)
                }
                this.cart = []
                this.cart = cart
            } else {
                this.cart = []
                this.cart.push(product)
            }
            this.$cookie.set('mocajo-cart', JSON.stringify(this.cart))
        }
    },
    mounted: function() {
        this.getSize()
        window.addEventListener('resize', () => {
            this.getSize()
        })

        let cart = this.$cookie.get('mocajo-cart')
        if (cart) {
            this.cart = JSON.parse(cart)
        }
    }
}).$mount('#app')
