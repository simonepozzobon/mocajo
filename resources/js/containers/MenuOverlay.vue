<template lang="html">
    <div class="mobile-nav" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/scuola-mocajo' }" exact-active-class="active" @click.native="toggleMobile" ref="odontoiatria">
                    Scuola Mocajo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/la-nostra-storia' }" exact-active-class="active" @click.native="toggleMobile" ref="odontoiatria">
                    Storia
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/i-nostri-vini' }" exact-active-class="active" @click.native="toggleMobile" ref="estetica">
                    I Nostri Vini
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/partner' }" exact-active-class="active" @click.native="toggleMobile">
                    Contatti
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import { TweenMax } from 'gsap'

export default {
    name: 'MobileNav',
    components: {
    },
    data: function() {
        return {
            isOpen: false,
            master: null,
            height: 0,
        }
    },
    methods: {
        goTo: function(path) {
            this.$router.push(path)
        },
        toggleMobile: function() {
            let container = this.$refs.container
            let height = container.offsetHeight

            if (!this.isOpen) {
                let master = new TimelineMax({
                    paused: true,
                })

                master.fromTo(container, .3, {
                    height: 0,
                    minHeight: 0,
                    autoAlpha: 0,
                },{
                    height: height,
                    scaleY: 1,
                    minHeight: '100vh',
                    autoAlpha: 1,
                    display: 'flex',
                    ease: Cubic.easeInOut,
                })

                master.progress(1).progress(0);
                master.play()

                this.isOpen = true
            } else {
                let master = new TimelineMax({
                    paused: true,
                })

                master.fromTo(container, .2, {
                    height: height,
                    scaleY: 1,
                    minHeight: '100vh',
                    autoAlpha: 1,
                    display: 'flex',
                },{
                    height: 0,
                    minHeight: 0,
                    autoAlpha: 0,
                    display: 'flex',
                })

                master.set(container, {
                    display: 'none'
                })

                master.progress(1).progress(0)
                master.play()

                this.isOpen = false
            }
        }
    },
    mounted: function() {

    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.mobile-nav {
    position: fixed;
    width: 100vw;
    min-height: 100vh;
    background-color: $black;
    z-index: 4;
    display: flex;
    justify-content: center;
    align-items: center;

    // position: relative;
    visibility: hidden; /* hides all .Tile-flyout on load so GSAP autoAlpha can do its thing */
    height: auto; /* tell the browser that initial height is auto */
    overflow: hidden;

    transform-origin: center top 0;

    ul {
        text-align: center;

        li {
            .nav-link {
                font-weight: 200;
                color: $white;
                font-size: 1.875rem;
                line-height: 3;

                @include media-breakpoint-down('md') {
                    font-size: 1.25rem;
                    line-height: 2;
                }
            }

            .mobile-nav-link {
                font-size: 1.5rem;
                font-weight: bold;
            }
        }

    }
}
</style>
