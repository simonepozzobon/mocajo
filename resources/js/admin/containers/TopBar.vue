<template lang="html">
    <nav class="navbar navbar-light fixed-top flex-md-nowrap shadow admin-top-bar">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
            <nav-logo width="45px" color="light" ref="logo"/>
        </a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sign out</a>
            </li>
        </ul>
    </nav>
</template>

<script>
import NavLogo from '../../components/NavLogo.vue'
export default {
    name: 'TopBar',
    components: {
        NavLogo
    },
}
</script>

<style lang="scss">
@import '~styles/adminshared';

.admin-top-bar {
    padding-top: $spacer;
    padding-bottom: $spacer;
    @include gradient-directional($gray-300, $gray-400, 179deg);

    .navbar-brand {
        font-weight: 600;
        letter-spacing: 1px;
        font-variant: small-caps;
        @include text-shadow($black);
        font-size: 150%;
        -webkit-text-size-adjust: 100%;
        /* Font varient */
        font-variant-ligatures: none;
        -webkit-font-variant-ligatures: none;
        /* Smoothing */
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
    }

}
</style>
