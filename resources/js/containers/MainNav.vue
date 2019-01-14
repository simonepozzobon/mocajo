<template lang="html">
    <nav class="navbar navbar-dark navbar-expand-lg" ref="navbar" :class="this.navClass">
        <router-link tag="a" class="navbar-brand" :to="{ path: '/' }" exact-active-class="active" v-if="hasLogo">
            <!-- <nav-logo :width="this.logoSize" ref="logo"/> -->
            Logo
        </router-link>

        <!-- <div class="d-lg-none position-relative">
            <burger :width="burgerSize" @toggle-mobile="toggleMobile"/>
        </div> -->
        <div class="ml-auto">
            <a href="#" class="nav-link-item d-flex align-items-center" @click="menuToggle">
                <span ref="text" class="mr-2">MENU </span> <menu-anim ref="menu" size="32px" :speed="1.6" class="mr-2"/>
            </a>
        </div>
        <!-- <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/' }" exact-active-class="active">
                        Home
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/about' }" exact-active-class="active" ref="odontoiatria">
                        La Scuola di Mocajo
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/vini' }" exact-active-class="active" ref="estetica">
                        Vini
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/partner' }" exact-active-class="active">
                        I Nostri Partner
                    </router-link>
                </li>
            </ul>
        </div> -->
    </nav>
</template>

<script>
import {TimelineMax} from 'gsap'
import SplitText from 'gsap/SplitText'
import MenuAnim from '../components/MenuAnim.vue'

export default {
    name: 'MainNav',
    components: {
        MenuAnim
    },
    props: {
        hasLogo: {
            type: Boolean,
            default: true,
        },
        navClass: {
            type: String,
            default: null
        }
    },
    data: function() {
        return {
            opened: false,
            text: {}
        }
    },
    methods: {
        menuToggle: function($event) {
            $event.preventDefault()
            let text = new SplitText(this.$refs.text, {type: 'chars'})
            if (this.opened) {
                let t1 = new TimelineMax()
                t1.staggerTo(text.chars, .1, {
                    opacity: 0,
                    y: -10,
                }, .05)
                    .set(this.$refs.text, {
                        opacity: 0,
                    })
                    .eventCallback('onComplete', () => {
                        t1.pause()
                        text.revert()
                        this.$refs.text.innerHTML = 'MENU'
                        text = new SplitText(this.$refs.text, {type: 'chars'})
                        for (let i = 0; i < text.chars.length; i++) {
                            text.chars[i].style.opacity = 0
                        }
                        this.$refs.text.style.opacity = 1
                        TweenMax.staggerFromTo(text.chars, .1, {
                            opacity: 0,
                            y: -10,
                        }, {
                            opacity: 1,
                            y: 0
                        }, .05)
                    })

                this.$refs.menu.close()
            } else {
                let text = new SplitText(this.$refs.text, {type: 'chars'})
                let t1 = new TimelineMax()
                t1.staggerTo(text.chars, .1, {
                    opacity: 0,
                    y: -10,
                }, .05)
                    .set(this.$refs.text, {
                        opacity: 0,
                    })
                    .eventCallback('onComplete', () => {
                        t1.pause()
                        text.revert()
                        this.$refs.text.innerHTML = 'CHIUDI'
                        text = new SplitText(this.$refs.text, {type: 'chars'})
                        for (let i = 0; i < text.chars.length; i++) {
                            text.chars[i].style.opacity = 0
                        }
                        this.$refs.text.style.opacity = 1
                        TweenMax.staggerFromTo(text.chars, .1, {
                            opacity: 0,
                            y: -10,
                        }, {
                            opacity: 1,
                            y: 0
                        }, .05)
                    })


                this.$refs.menu.open()
            }
        },
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.navbar {
    // min-height: 112px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    min-height: 60px;
    height: 70px;
    background-color: rgba($white, 0);
    z-index: 9999;

    transition: $transition-base;

    .nav-link {
        font-weight: normal;
        letter-spacing: 1px;
    }
}
</style>
