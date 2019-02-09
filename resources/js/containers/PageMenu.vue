<template lang="html">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/scuola-mocajo' }" exact-active-class="active">
                        Scuola Mocajo
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/la-nostra-storia' }" exact-active-class="active">
                        Storia
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/' }" exact-active-class="active">
                        <nav-logo width="56px" color="light" ref="logo"/>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/i-nostri-vini' }" exact-active-class="active">
                        I Nostri Vini
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/contatti' }" exact-active-class="active">
                        Contatti
                    </router-link>
                </li>
                <li>
                    <router-link tag="a" class="nav-link-item mr-4" :to="{ path: '/carrello' }" v-if="hasCart">
                        <cart-icon width="24px" color="#333" ref="icon"/>
                    </router-link>
                </li>
            </ul>
        </nav>
</template>

<script>
import CartIcon from '../components/CartIcon.vue'
import MenuAnim from '../components/MenuAnim.vue'
import NavLogo from '../components/NavLogo.vue'
import SplitText from 'gsap/SplitText'
import {TimelineMax} from 'gsap'

export default {
    name: 'PageMenu',
    components: {
        CartIcon,
        MenuAnim,
        NavLogo,
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
                this.$nextTick(() => {
                    this.$refs.icon.play()

                })
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
        init: function() {
            let master = new TimelineMax({
                paused: true,
            })

            master.staggerFrom('.nav-item', 1.2, {
                delay: .5,
                y: -100,
                autoAlpha: 0,
                ease: Power3.easeInOut,
            }, .3)

            master.play()
        },
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
    },
    mounted: function() {
        this.init()
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
    background-color: rgba($black, 1);
    z-index: 9999;
    padding-left: $spacer * 2;
    transition: $transition-base;

    .navbar-nav {
        align-items: center;
        justify-content: space-around;
        min-width: 80%;

        .nav-item {
            text-transform: uppercase;

            .nav-link {
                font-size: 0.75rem;
                font-weight: normal;
                letter-spacing: 2px;
            }
        }
    }

}
</style>
