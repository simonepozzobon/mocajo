<template lang="html">
    <nav id="page-menu" class="navbar navbar-expand-sm navbar-dark bg-black" ref="menu">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, 'scuola')">
                    {{ this.menu.scuola }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, 'storia')">
                    {{ this.menu.storia }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, 'home')">
                    <nav-logo width="80px" color="light" ref="logo"/>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, 'vini')">
                    {{ this.menu.vini }}
                </a>
            </li>
            <li class="nav-item">
                <a :href="this.shopLink" class="nav-link">
                    Shop
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, 'contatti')">
                    {{ this.menu.contatti }}
                </a>
            </li>
            <li class="nav-item" v-if="hasCart">
                <a href="#" class="nav-link" @click="goTo($event, 'cart')">
                    <cart-icon width="24px" color="rgb(250, 200, 35)" ref="icon"/>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import CartIcon from '../components/CartIcon.vue'
import MenuAnim from '../components/MenuAnim.vue'
import NavLogo from '../components/NavLogo.vue'
import {
    TimelineMax,
    TweenLite
}
from 'gsap'
import ScrollToPlugin from 'gsap/ScrollToPlugin'
import SplitText from 'gsap/SplitText'

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
    data: function () {
        return {
            hasCart: false,
            hasLogo: true,
            menuClass: 'ml-auto',
            opened: false,
            menuHidden: false,
            text: {},
            initialized: false,
            didScroll: null,
            lastScrollTop: 0,
            delta: 5,
            navbarHeight: 0,
            menu: {
                scuola: null,
                storia: null,
                vini: null,
                contatti: null,
            },
            master: null,
            delay: 0,
            changeBgTimeline: null,
            shopLink: 'https://scuolamocajo.it/shop/',
        }
    },
    watch: {
        '$root.cart': function (cart) {
            if (cart && cart.length > 0) {
                this.hasCart = true
                this.$nextTick(() => {
                    this.$refs.icon.play()

                })
            }
            else {
                this.hasCart = false
                this.$refs.icon.hide()
            }
        },
        '$root.navLogo': function (logo) {
            if (!logo) {
                this.hasLogo = false
                this.menuClass = 'mr-auto'
                return true
            }
            this.hasLogo = true
            this.menuClass = 'ml-auto'
        },
        '$root.options': function (options) {
            this.setOptions(options.menu)
        },
        '$root.locale': function (locale) {
            if (locale == 'it') {
                this.shopLink = 'https://scuolamocajo.it/shop/'
            }
            else {
                this.shopLink = 'https://scuolamocajo.it/shop/en'
            }
        }
    },
    methods: {
        goTo: function (event, name) {
            event.preventDefault()
            this.$router.push({
                name: name,
                params: {
                    lang: this.$root.locale
                }
            })
        },
        setOptions: function (section) {
            this.menu = section
        },
        init: function () {
            if (!this.master) {
                let el = this.$refs.menu
                let links = el.getElementsByClassName('nav-item')

                this.master = new TimelineMax({
                    paused: true,
                    yoyo: true,
                })

                this.changeBgTimeline = new TimelineMax({
                    paused: true,
                    yoyo: true,
                })

                this.changeBgTimeline.fromTo(el, .6, {
                    backgroundColor: '#ffffff',
                    ease: Sine.easeInOut,
                }, {
                    backgroundColor: '#000000',
                    ease: Sine.easeInOut,
                }, 0)

                this.master.add(this.changeBgTimeline)

                this.master.fromTo(el, .6, {
                    opacity: 0,
                    ease: Sine.easeInOut,
                }, {
                    opacity: 1,
                    ease: Sine.easeInOut,
                }, 0)

                this.master.staggerFromTo(links, 1.2, {
                    delay: .5,
                    y: -100,
                    autoAlpha: 0,
                    ease: Power3.easeInOut,
                }, {
                    y: 0,
                    autoAlpha: 1,
                    ease: Power3.easeInOut,
                }, .3, .3)

                this.master.progress(1).progress(0)

                this.master.eventCallback('onComplete', () => {
                    this.addScrollListener()
                    this.master.delay(0)
                    this.$nextTick(() => {
                        this.master.removeCallback('onComplete')
                    })

                })

                this.$nextTick(() => {
                    this.master.delay(this.delay).play()
                })
            }
        },
        addScrollListener: function () {
            TweenLite.to(window, .2, {
                scrollTo: 0
            }).play()

            $(window).scroll(() => {
                this.didScroll = true
            })

            setInterval(() => {
                if (this.didScroll) {
                    this.hasScrolled()
                    this.didScroll = false
                }
            }, 250)
        },
        hoverAnim: function () {
            this.$refs.menu.hoverAnim()
        },
        hasScrolled: function () {
            let st = $(window).scrollTop();

            // Make sure they scroll more than delta
            if (Math.abs(this.lastScrollTop - st) <= this.delta)
                return;

            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > this.lastScrollTop && st > this.navbarHeight) {
                // Scroll Down
                $('#page-menu').removeClass('nav-down').addClass('nav-up');
            }
            else {
                // Scroll Up
                if (st + $(window).height() < $(document).height()) {
                    $('#page-menu').removeClass('nav-up').addClass('nav-down');
                }
            }

            this.lastScrollTop = st;
        },
        scrollTop: function () {
            return new Promise(resolve => {
                TweenLite.to(window, .2, {
                    scrollTo: {
                        y: 0,
                    },
                    onComplete: () => {
                        console.log('completed')
                        resolve()
                    }
                })
            })
        }
    },
    mounted: function () {
        this.navbarHeight = $('#page-menu').outerHeight();
        let el = this.$refs.menu
        // TweenMax.set(el, {
        //     y: -this.navbarHeight
        // }, 0)

        if (this.$root.options) {
            this.setOptions(this.$root.options.menu)
        }
        this.$nextTick(() => {
            this.init()
        })


    },
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
    background-color: rgba($black, 1);
    z-index: 9999;
    padding-left: $spacer * 2;
    // transition: $transition-base;

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

    &.nav-up {
        top: -$section-padding;
        transition: $transition-base;
    }
    &.down {
        transition: $transition-base;
    }

}
</style>
