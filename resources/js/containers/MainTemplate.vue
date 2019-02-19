<template lang="html">
    <div>
        <main-nav
            ref="mainNav"
            :navClass="navClass"
            @menu-open="menuOpen"
            @menu-close="menuClose"
            v-if="this.bigMenu == true"/>

        <page-menu
            :navClass="navClass"
            @menu-open="menuOpen"
            @menu-close="menuClose"
            v-else-if="this.bigMenu == false"/>

        <menu-overlay
            ref="menu"/>

        <main ref="main">
            <transition
                mode="out-in"
                name="fade"
                @enter="enter"
                @leave="leave"
                @after-enter="afterEnter"
                @after-leave="afterLeave">
                <router-view></router-view>
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
        }
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
        '$root.window': function(value) {
            this.hasBigMenu()
        },
        '$route.path': function(route) {
            if (this.navClass) {
                this.$refs.mainNav.changeStatus(false)
            }
            this.hasBigMenu()
        }
    },
    computed: {
        parsedCities: function() {
            if (this.cities) {
                return JSON.parse(this.cities)
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
        }
    },
    methods: {
        afterEnter: function() {
            // console.log('after-enter')
            // this.$root.$emit('page-loaded')
        },
        init: function() {
        },
        hasBigMenu: function() {
            // se siamo su mobile il menu big c'è sempre
            if (this.$root.window.w <= 576) {
                this.bigMenu = true
                this.navClass = 'bg-black'
            } else if (this.$route.name === 'home') {
                this.bigMenu = true
                this.navClass = null
            } else {
                this.bigMenu = false
                this.navClass = null
            }
        },
        menuOpen: function() {
            this.$refs.menu.toggleMobile()
        },
        menuClose: function() {
            this.$refs.menu.toggleMobile()
        },
        enter: function(el, done) {
            // console.log('entrato', el, document.body.contains(el))
            if (document.body.contains(el)) {
                let master = new TimelineMax()
                master.fromTo(el, .4, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                })

                master.eventCallback('onComplete', () => {
                    done()
                })
            }
        },
        afterLeave: function(el) {

        },
        leave: function(el, done) {
            // console.log('leave', el,document.body.contains(el))
            let master = new TimelineMax()
            master.fromTo(el, .4, {
                autoAlpha: 1,
            }, {
                autoAlpha: 0,
            })

            master.eventCallback('onComplete', () => {
                done()
            })

        }
    },
    mounted: function() {
        this.init()
        this.hasBigMenu()
        this.$root.cities = this.parsedCities
    }
}
</script>

<style lang="css">
</style>
