<template lang="html">
    <div>
        <transition
            name="mobile"
            mode="out-in"
            @enter="mobileEnter"
            @leave="mobileLeave">
            <main-nav
                ref="burger"
                :is-page="this.isPage"
                v-if="this.bigMenu == true"
                @toggle="toggle"/>
        </transition>


        <transition
            name="page"
            mode="out-in"
            @enter="pageEnter"
            @leave="pageLeave">
            <page-menu
                ref="page"
                :navClass="navClass"
                v-if="this.bigMenu == false"/>
        </transition>

        <transition
            name="overlay"
            mode="out-in"
            @enter="overlayEnter"
            @leave="overlayLeave">
                <menu-overlay
                ref="overlay"
                v-if="this.bigMenu == true"
                @main-click="mainClick"/>
        </transition>

        <main ref="main">
            <transition
                mode="out-in"
                @enter="enter"
                @leave="leave"
                @after-enter="afterEnter"
                @after-leave="afterLeave">
                <router-view v-bind:key="$route.fullPath"></router-view>
            </transition>
        </main>

        <language-menu />
        <cookies-panel />
    </div>
</template>

<script>
import CookiesPanel from '../components/CookiesPanel.vue'
import LanguageMenu from '../components/LanguageMenu.vue'
import MainNav from './MainNav.vue'
import MenuOverlay from './MenuOverlay.vue'
import PageMenu from './PageMenu.vue'

export default {
    name: 'MainTemplate',
    components: {
        CookiesPanel,
        LanguageMenu,
        MainNav,
        MenuOverlay,
        PageMenu
    },
    props: {
        cities: {
            type: String,
            default: null,
        },
        options: {
            type: String,
            default: null,
        },
        products: {
            type: String,
            default: null,
        },
        shippings: {
            type: String,
            default: null,
        },
    },
    watch: {
        '$root.navbar': function(color) {
            switch (color) {
                case 1:
                    this.navClass = null
                    break;
                case 2:
                    this.navClass = 'bg-primary'
                    break;
            }
        },
        '$root.isPage': function(value) {
            this.isPage = value
        },
        '$root.bigMenu': function(value) {
            this.bigMenu = value
        }
    },
    computed: {
        parsedCities: function() {
            if (this.cities) {
                return JSON.parse(this.cities)
            }
            return []
        },
        parsedOptions: function() {
            if (this.options) {
                return JSON.parse(this.options)
            }
            return []
        },
        parsedProducts: function() {
            if (this.products) {
                return JSON.parse(this.products)
            }
            return []
        },
        parsedShippings: function() {
            if (this.shippings) {
                return JSON.parse(this.shippings)
            }
            return []
        },
    },
    data: function() {
        return {
            bigMenu: null,
            cache: null,
            navClass: null,
            menuSwitch: null,
            isPage: true,
            mobileMenuTransition: false,
            status: false,
            temp: null,
        }
    },
    methods: {
        overlayEnter: function(el, done) {
            done()
        },
        overlayLeave: function(el, done) {
            let menu = this.$refs.overlay
            if (menu.master) {
                menu.master.eventCallback('onReverseComplete', () => {
                    done()
                })
                menu.master.reverse()
            } else {
                done()
            }
        },
        mobileEnter: function(el, done) {
            done()
        },
        mobileLeave: function(el, done) {
            done()
        },
        pageEnter: function(el, done) {
            let menu = this.$refs.page
            if (menu.master) {
                menu.delay = .3
                done()
            } else {
                done()
            }
        },
        pageLeave: function(el, done) {
            let menu = this.$refs.page
            if (menu.master) {
                menu.master.eventCallback('onReverseComplete', () => {
                    done()
                })

                let speed = 3
                if (this.$root.isMobile) {
                    speed = 10
                }

                menu.master.timeScale(speed).reverse()
            } else {
                done()
            }
        },
        mainClick: function(name, master = false){
            this.toggle()
            this.$nextTick(() => {
                this.$router.push({name: name, params: {lang: this.$root.locale}})
            })
        },
        toggle: function() {
            this.$refs.burger.toggle()
            this.$refs.overlay.toggle()
        },
        afterEnter: function() {
            // console.log('after-enter')
            // this.$root.$emit('page-loaded')
        },
        enter: function(el, done) {
            // console.log('entrato', el, document.body.contains(el))

            if (document.body.contains(el)) {
                let master = new TimelineMax({
                    paused: true,
                })

                master.fromTo(el, .4, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                })

                master.progress(1).progress(0)

                master.eventCallback('onComplete', () => {
                    master.kill()
                    master = null
                    done()
                })

                master.play()

                TweenLite.to(window, .2, {
                    scrollTo: {
                        y: 0
                    }
                })
            } else {
                console.log('non ');
            }
        },
        beforeLeave: function(el, done) {
            // console.log('before-leave',el, done);
        },
        afterLeave: function(el) {
            // console.log('after-leave')
        },
        leave: function(el, done) {
            // console.log('leave', el,document.body.contains(el))
            let master = new TimelineMax({
                paused: true,
            })
            master.fromTo(el, .4, {
                autoAlpha: 1,
            }, {
                autoAlpha: 0,
            })

            // master.progress(1).progress(0)

            master.eventCallback('onComplete', () => {
                // console.log('terminata la transizione');
                master.kill()
                master = null
                done()
            })

            master.play()
            // done()
        }
    },
    // created: function() {
    //     this.$root.cities = this.parsedCities
    //     this.$root.options = this.parsedOptions
    //     this.$root.products = this.parsedProducts
    //     this.$root.shippings = this.parsedShippings
    // },
    mounted: function() {
        this.$root.cities = this.parsedCities
        this.$root.options = this.parsedOptions
        this.$root.products = this.parsedProducts
        this.$root.shippings = this.parsedShippings
    }
}
</script>

<style lang="css">
</style>
