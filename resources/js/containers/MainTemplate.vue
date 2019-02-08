<template lang="html">
    <div>
        <main-nav :navClass="navClass" @menu-open="menuOpen" @menu-close="menuClose"/>
        <menu-overlay ref="menu"/>
        <main ref="main">
            <transition>
                <router-view />
            </transition>
        </main>
        <cookies-panel />
    </div>
</template>

<script>
import CookiesPanel from '../components/CookiesPanel.vue'
import MainNav from './MainNav.vue'
import MenuOverlay from './MenuOverlay.vue'

export default {
    name: 'MainTemplate',
    components: {
        CookiesPanel,
        MainNav,
        MenuOverlay
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
        }
    },
    data: function() {
        return {
            navClass: null
        }
    },
    methods: {
        init: function() {
            this.setPadding()
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
    }
}
</script>

<style lang="css">
</style>
