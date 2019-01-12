<template lang="html">
    <div>
        <main-nav />
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
    }
}
</script>

<style lang="css">
</style>
