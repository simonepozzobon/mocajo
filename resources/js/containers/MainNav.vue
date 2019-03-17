<template lang="html">
    <nav
        ref="navbar"
        :class="menuClass">
        <a
            href="#"
            class="mobile-menu__link"
            @click="mainClick"
            @mouseenter="hoverAnim">

            <menu-anim
                ref="menu"
                size="48px"
                :speed="1.6"
                />
        </a>
    </nav>
</template>

<script>
import MenuAnim from '../components/MenuAnim.vue'
import NavLogo from '../components/NavLogo.vue'
import SplitText from 'gsap/SplitText'
import {TimelineMax} from 'gsap'

export default {
    name: 'MainNav',
    components: {
        MenuAnim,
        NavLogo
    },
    props: {
        isPage: {
            type: Boolean,
            default: true
        }
    },
    data: function() {
        return {
            hasCart: false,
            hasLogo: true,
            opened: false,
            text: {},
            status: false,
        }
    },
    watch: {
        '$root.cart': function(cart) {
            if (cart && cart.length > 0) {
                this.hasCart = true
                this.$refs.icon.play()
            } else {
                this.hasCart = false
                this.$refs.icon.hide()
            }
        },
    },
    computed: {
        menuClass: function(value) {
            if (value) {
                return 'mobile-menu mobile-menu--dark'
            }
            return 'mobile-menu'
        }
    },
    methods: {
        goTo: function(event, name) {
            event.preventDefault()
            this.$router.push({name: name, params: {lang: this.$root.locale}})
        },
        mainClick: function() {
            this.$emit('toggle')
        },
        toggle: function() {
            return this.$refs.menu.toggle()
        },
        hoverAnim: function() {
            return this.$refs.menu.hoverAnim()
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.mobile-menu {
    $self: &;
    position: fixed;
    top: 0;
    left: 0;
    min-height: 60px;
    height: $section-sm-padding;
    background-color: rgba($white, 0);
    z-index: 9999;
    padding-left: $spacer * 2;
    // padding-top: $spacer * 2;
    display: flex;
    justify-content: flex-start;
    align-items: center;

    @include media-breakpoint-up('sm') {
        height: $section-padding;
    }

    &#{$self}--dark {
        background-color: $black;
        // padding-top: $spacer;
        width: 100%;

    }
}
</style>
