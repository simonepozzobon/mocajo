<template lang="html">
    <div>
        <main-nav :navClass="navClass" @menu-open="menuOpen" @menu-close="menuClose" v-if="this.bigMenu == true"/>
        <page-menu :navClass="navClass" @menu-open="menuOpen" @menu-close="menuClose" v-else-if="this.bigMenu == false"/>
        <menu-overlay ref="menu"/>
        <main ref="main">
            <transition>
                <router-view />
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
            this.setPadding()
        },
        '$route.path': function(route) {
            this.hasBigMenu()
        }
    },
    data: function() {
        return {
            bigMenu: null,
            navClass: null
        }
    },
    methods: {
        afterEnter: function() {
            this.$root.$emit('page-loaded')
        },
        init: function() {
            this.setPadding()
        },
        hasBigMenu: function() {
            if (this.$route.name === 'home') {
                this.bigMenu = true
            } else {
                this.bigMenu = false
            }
        },
        setPadding: function() {
            // let main = this.$refs.main
            // if (main.offsetHeight > this.$root.window.h) {
            //     main.style.paddingTop = '100px'
            // } else {
            //     main.style.paddingTop = null
            // }
        },
        menuOpen: function() {
            this.$refs.menu.toggleMobile()
        },
        menuClose: function() {
            this.$refs.menu.toggleMobile()
        },
    },
    mounted: function() {
        this.init()
        this.hasBigMenu()
    }
}
</script>

<style lang="css">
</style>
