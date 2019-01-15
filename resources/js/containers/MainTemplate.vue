<template lang="html">
    <div>
        <main-nav :navClass="navClass" @menu-open="menuOpen" @menu-close="menuClose"/>
        <menu-overlay ref="menu"/>
        <main ref="main">
            <transition>
                <router-view />
            </transition>
        </main>
    </div>
</template>

<script>
import MainNav from './MainNav.vue'
import MenuOverlay from './MenuOverlay.vue'
export default {
    name: 'MainTemplate',
    components: {
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
            let main = this.$refs.main
            if (main.offsetHeight > value.h) {
                main.style.paddingTop = '100px'
            } else {
                main.style.paddingTop = null
            }
        }
    },
    data: function() {
        return {
            navClass: null
        }
    },
    methods: {
        menuOpen: function() {
            this.$refs.menu.toggleMobile()
        },
        menuClose: function() {
            this.$refs.menu.toggleMobile()
        },
    }
}
</script>

<style lang="css">
</style>
