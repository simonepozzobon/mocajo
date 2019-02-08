<template lang="html">
    <nav class="navbar navbar-dark navbar-expand-lg" ref="navbar" :class="this.navClass">
        <div class="d-flex" :class="menuClass">
            <router-link tag="a" class="nav-link-item mr-4" :to="{ path: '/carrello' }" v-if="hasCart">
                <cart-icon width="24px" color="#333" ref="icon"/>
            </router-link>
            <a href="#" class="nav-link-item d-flex align-items-center" @click="menuToggle" @mouseenter="hoverAnim">
                <menu-anim
                    ref="menu"
                    size="48px"
                    :speed="1.6"
                    class="mr-2"
                    @changeStatus="changeStatus"/>
            </a>
        </div>
    </nav>
</template>

<script>
import CartIcon from '../components/CartIcon.vue'
import MenuAnim from '../components/MenuAnim.vue'
import NavLogo from '../components/NavLogo.vue'
import SplitText from 'gsap/SplitText'
import {TimelineMax} from 'gsap'

export default {
    name: 'MainNav',
    components: {
        CartIcon,
        MenuAnim,
        NavLogo
    },
    props: {
        navClass: {
            type: String,
            default: null
        }
    },
    data: function() {
        return {
            hasCart: false,
            hasLogo: true,
            menuClass: 'ml-auto',
            opened: false,
            text: {}
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
        '$root.navLogo': function(logo) {
            if (!logo) {
                this.hasLogo = false
                this.menuClass = 'mr-auto'
                return true
            }
            this.hasLogo = true
            this.menuClass = 'ml-auto'
        }
    },
    methods: {
        hoverAnim: function() {
            this.$refs.menu.hoverAnim()
        },
        changeStatus: function(value) {
            this.opened = value
        },
        menuToggle: function($event) {
            $event.preventDefault()
            if (this.opened) {
                this.$emit('menu-close')
                this.$refs.menu.close()
            } else {
                this.$emit('menu-open')
                this.$refs.menu.open()
            }
        },
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    min-height: 60px;
    height: 130px;
    background-color: rgba($white, 0);
    z-index: 9999;
    padding-left: $spacer * 2;

    transition: $transition-base;

    .nav-link {
        font-weight: normal;
        letter-spacing: 1px;
    }

    .navbar-brand {
        padding-top: $spacer;
    }
}
</style>
