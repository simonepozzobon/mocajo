<template lang="html">
    <nav class="navbar navbar-dark navbar-expand-lg" ref="navbar" :class="this.navClass">
        <div class="d-flex mr-auto">
            <router-link tag="a" class="nav-link-item mr-4" :to="{ path: '/carrello' }" v-if="hasCart">
                <cart-icon width="24px" color="#333" ref="icon"/>
            </router-link>
            <a href="#" class="nav-link-item d-flex align-items-center" @click="menuToggle" @mouseenter="hoverAnim">
                <menu-anim
                    ref="menu"
                    size="48px"
                    :speed="1.6"
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
            menuClass: 'mr-auto',
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
        '$route': function(to, from) {
            this.opened = true
            this.menuToggle()
        }
    },
    methods: {
        hoverAnim: function() {
            this.$refs.menu.hoverAnim()
        },
        changeStatus: function(value) {
            this.opened = value
        },
        menuToggle: function($event = null) {
            if ($event) {
                $event.preventDefault()
            }
            if (this.opened) {
                this.$emit('menu-close')
                if (this.navClass) {
                    TweenMax.to(this.$refs.navbar, .1, {
                        delay: 1,
                        className: '+='+this.navClass
                    })
                }
                this.opened = false
                this.$refs.menu.close()
            } else {
                this.$emit('menu-open')
                if (this.navClass) {
                    TweenMax.to(this.$refs.navbar, .1, {
                        className: '-='+this.navClass
                    })
                }
                this.opened = true
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
    height: $section-padding;
    background-color: rgba($white, 0);
    z-index: 9999;
    padding-left: $spacer * 2;

    transition: $transition-base;

    @include media-breakpoint-down('sm') {
        height: $section-sm-padding;
    }

    .nav-link {
        font-weight: normal;
        letter-spacing: 1px;
    }

    .navbar-brand {
        padding-top: $spacer;
    }
}
</style>
