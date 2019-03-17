<template lang="html">
    <div>
        <top-bar></top-bar>
        <div class="container-fluid main-container">
            <div class="row no-gutters">
                <sidebar></sidebar>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
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

<style lang="scss">
@import '~styles/adminshared';

.main-container {
    padding: 0;
}
</style>
