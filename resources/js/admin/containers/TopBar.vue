<template lang="html">
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap admin-top-bar">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
            <nav-logo width="40px" color="light" ref="logo" class="logo"/><span class="text"> - Admin Panel</span>
        </a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sign out</a>
            </li>
        </ul>
    </nav>
</template>

<script>
import NavLogo from '../components/NavLogo.vue'
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
    @include gradient-directional(darken(#343a40, 3), lighten(#0a0a0a, 2), 165deg);
    display: flex;
    align-items: baseline;
    @include box-shadows($black);

    .navbar-brand {
        letter-spacing: 1px;
        font-variant: small-caps;
        @include text-shadow($white);
        -webkit-text-size-adjust: 100%;
        /* Font varient */
        font-variant-ligatures: none;
        -webkit-font-variant-ligatures: none;
        /* Smoothing */
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
        display: inline-flex;
        align-items: stretch;
        width: 50vw;
        min-width: 600px;

        span {
            line-height: 2.4;
            display: block;
            padding-left: $spacer;
        }
    }

}
</style>
