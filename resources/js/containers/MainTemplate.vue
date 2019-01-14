<template lang="html">
    <div>
        <main-nav :navClass="navClass"/>
        <transition>
            <router-view />
        </transition>
    </div>
</template>

<script>
import MainNav from './MainNav.vue'
export default {
    name: 'MainTemplate',
    components: {
        MainNav
    },
    watch: {
        '$root.navbar': function(color) {
            switch (color) {
                case 1:
                    this.navClass = null
                    break;
                case 2:
                    this.navClass = 'bg-primary'
            }
        }
    },
    data: function() {
        return {
            navClass: null
        }
    }
}
</script>

<style lang="css">
</style>
