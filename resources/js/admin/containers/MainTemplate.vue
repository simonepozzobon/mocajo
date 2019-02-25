<template lang="html">
    <div>
        <top-bar></top-bar>
        <div class="container-fluid">
            <div class="row">
                <sidebar></sidebar>
                <main role="main" class="pt-5 col-md-9 ml-sm-auto col-lg-10 px-4">
                    <router-view></router-view>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue'
import TopBar from './TopBar.vue'

export default {
    name: 'MainTemplate',
    components: {
        Sidebar,
        TopBar,
    }
}
</script>

<style lang="scss" scoped>
</style>
