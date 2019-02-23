<template lang="html">
    <div class="mobile-nav" ref="container">
        <div class="brand-logo" ref="logo">
            <img src="/svg/logo-new.svg" alt="" class="img-fluid" @click="goTo($event, '/')">
        </div>
        <ul class="list-unstyled" ref="menu">
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, '/scuolamocajo')">
                    Scuola Mocajo
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, '/storia')">
                    Storia
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, '/vini')">
                    I Nostri Vini
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" @click="goTo($event, '/contatti')">
                    Contatti
                </a>
            </li>
        </ul>
        <div class="social-links">
            <ul class="navbar-nav" ref="social">
                <li class="nav-item">
                    <a href="https://www.facebook.com/scuolamocajo" class="nav-link" target="_blank">
                        <svg width="10px" height="20px" viewBox="0 0 10 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="facebook-icon" transform="translate(-1131.000000, -35.000000)" fill="#ffffff"><g id="facebook" transform="translate(1131.000000, 34.000000)"><path d="M6.4905777,21 L6.4905777,11.877238 L9.43898672,11.877238 L9.88075378,8.32144003 L6.4905777,8.32144003 L6.4905777,6.05165886 C6.4905777,5.02233203 6.76614149,4.32092665 8.18721038,4.32092665 L10,4.3196432 L10,1.13989604 C9.68674699,1.09625874 8.61044177,1 7.35866543,1 C4.74513438,1 2.95582329,2.65693384 2.95582329,5.69935186 L2.95582329,8.32144003 L0,8.32144003 L0,11.877238 L2.95582329,11.877238 L2.95582329,21 L6.4905777,21 Z" id="Facebook-Copy-3"></path></g></g></g></svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://www.instagram.com/scuolamocajo/" class="nav-link" target="_blank">
                        <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="instagram-icon" transform="translate(-1285.000000, -34.000000)" fill="#ffffff"><g id="instagram" transform="translate(1131.000000, 34.000000)"><path d="M172.503805,0 L156.496195,0 C155.117503,0 154,1.11463874 154,2.49046723 L154,18.5095328 C154,19.8847885 155.117503,21 156.496195,21 L172.503805,21 C173.882497,21 175,19.8847885 175,18.5095328 L175,2.49046723 C175,1.11463874 173.882497,0 172.503805,0 L172.503805,0 Z M169.094018,3.28090991 C169.094018,2.91891007 169.387857,2.62449881 169.749857,2.62449881 L171.718517,2.62449881 C172.08109,2.62449881 172.374928,2.91891007 172.374928,3.28090991 L172.374928,5.24957041 C172.374928,5.61214303 172.08109,5.90598151 171.718517,5.90598151 L169.749857,5.90598151 C169.387857,5.90598151 169.094018,5.61214303 169.094018,5.24957041 L169.094018,3.28090991 L169.094018,3.28090991 Z M164.524343,6.49537681 C166.754766,6.49537681 168.563047,8.29964815 168.563047,10.5237706 C168.563047,12.7496113 166.754766,14.5533099 164.524343,14.5533099 C162.294493,14.5533099 160.486212,12.7496113 160.486212,10.5237706 C160.486212,8.29964815 162.294493,6.49537681 164.524343,6.49537681 L164.524343,6.49537681 Z M173.031339,18.3749284 C173.031339,18.7369282 172.737501,19.0313395 172.374928,19.0313395 L156.625072,19.0313395 C156.262499,19.0313395 155.968661,18.7369282 155.968661,18.3749284 L155.968661,8.53105311 L158.593732,8.53105311 C158.25178,9.02307503 158.136077,9.94124867 158.136077,10.5237706 C158.136077,14.0383766 161.002291,16.897717 164.524343,16.897717 C168.046968,16.897717 170.913182,14.0383766 170.913182,10.5237706 C170.913182,9.94124867 170.830128,9.03682186 170.406268,8.53105311 L173.031339,8.53105311 L173.031339,18.3749284 L173.031339,18.3749284 Z" id="Instagram"></path></g></g></g></svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://www.youtube.com/channel/UCUjslBPqCg9-9i3CuRclh9A/featured?view_as=public" class="nav-link" target="_blank">
                        <svg width="24px" height="18px" viewBox="0 0 24 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="youtube-icon" transform="translate(-1230.000000, -36.000000)" fill="#ffffff"><g id="youtube" transform="translate(1131.000000, 34.000000)"><path d="M99,11 C99,10.0999955 99.0044642,9.39687753 99.0133929,8.890625 C99.0223215,8.38437247 99.0602675,7.74453512 99.1272321,6.97109375 C99.1941968,6.19765238 99.2946422,5.50625305 99.4285714,4.896875 C99.5714293,4.21249658 99.8794619,3.63593984 100.352679,3.1671875 C100.825895,2.69843516 101.379461,2.42656287 102.013393,2.3515625 C103.995546,2.11718633 106.991051,2 111,2 C115.008949,2 118.004454,2.11718633 119.986607,2.3515625 C120.620539,2.42656287 121.176337,2.69843516 121.654018,3.1671875 C122.131699,3.63593984 122.441964,4.21249658 122.584821,4.896875 C122.709822,5.50625305 122.805803,6.19765238 122.872768,6.97109375 C122.939732,7.74453512 122.977679,8.38437247 122.986607,8.890625 C122.995536,9.39687753 123,10.0999955 123,11 C123,11.9000045 122.995536,12.6031225 122.986607,13.109375 C122.977679,13.6156275 122.939732,14.2554649 122.872768,15.0289063 C122.805803,15.8023476 122.705358,16.493747 122.571429,17.103125 C122.428571,17.7875034 122.120538,18.3640602 121.647321,18.8328125 C121.174105,19.3015648 120.620539,19.5734371 119.986607,19.6484375 C118.004454,19.8828137 115.008949,20 111,20 C106.991051,20 103.995546,19.8828137 102.013393,19.6484375 C101.379461,19.5734371 100.823663,19.3015648 100.345982,18.8328125 C99.8683012,18.3640602 99.5580364,17.7875034 99.4151786,17.103125 C99.2901779,16.493747 99.1941968,15.8023476 99.1272321,15.0289063 C99.0602675,14.2554649 99.0223215,13.6156275 99.0133929,13.109375 C99.0044642,12.6031225 99,11.9000045 99,11 Z M107.571429,15.5 C107.571429,15.8562518 107.718749,16.1187492 108.013393,16.2875 C108.156251,16.3625004 108.294642,16.4 108.428571,16.4 C108.607144,16.4 108.758928,16.3531255 108.883929,16.259375 L115.741071,11.759375 C116.00893,11.5999992 116.142857,11.3468767 116.142857,11 C116.142857,10.6531233 116.00893,10.4000008 115.741071,10.240625 L108.883929,5.740625 C108.607141,5.55312406 108.316966,5.54374916 108.013393,5.7125 C107.718749,5.88125084 107.571429,6.14374822 107.571429,6.5 L107.571429,15.5 Z" id="icon"></path></g></g></g></svg>
                    </a>
                </li>
            </ul>
        </div>
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
        goTo: function(event, path) {
            event.preventDefault()
            if (this.$route.path != path) {
                this.$router.push(path)
                return false
            }
            return false
        },
        toggleMobile: function() {
            let container = this.$refs.container
            let height = container.offsetHeight
            let menu = this.$refs.menu
            let social = this.$refs.social

            if (!this.isOpen) {
                let master = new TimelineMax({
                    paused: true,
                })

                // Black panel
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

                master.fromTo(this.$refs.logo, .3, {
                    autoAlpha: 0,
                    x: -20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                })

                // Menu items appears
                master.staggerFromTo(menu.getElementsByClassName('nav-item'), 1, {
                    autoAlpha: 0,
                    x: -20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                }, .1)

                // Social items appears
                master.staggerFromTo(social.getElementsByClassName('nav-item'), .5, {
                    autoAlpha: 0,
                    x: -20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                }, .1, 1)

                master.progress(1).progress(0);
                master.play()

                this.isOpen = true
            } else {
                let master = new TimelineMax({
                    paused: true,
                })

                master.fromTo([this.$refs.logo, menu.getElementsByClassName('nav-item'), social.getElementsByClassName('nav-item')], 1, {
                    autoAlpha: 1,
                }, {
                    autoAlpha: 0,
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
    flex-direction: column;
    justify-content: center;
    align-items: center;

    // position: relative;
    visibility: hidden; /* hides all .Tile-flyout on load so GSAP autoAlpha can do its thing */
    height: auto; /* tell the browser that initial height is auto */
    overflow: hidden;

    transform-origin: center top 0;

    .brand-logo {
        max-width: 80%;
        max-width: 120px;
        height: auto;
        margin-top: -$spacer;
        margin-bottom: $spacer * 2;

        // @include media-breakpoint-down('xs') {
        //     display: none;
        // };
    }

    .social-links {
        .navbar-nav {
            flex-direction: row;
            li {
                padding: $spacer;
            }
        }
    }

    ul {
        text-align: center;

        li {
            .nav-link {
                font-weight: 200;
                color: $white;
                font-size: 1.75rem;
                line-height: 3;
                text-transform: uppercase;
                letter-spacing: 2px;
                transition: $transition-base;

                &:hover, &:focus {
                    color: $primary;
                    transition: $transition-base;
                }

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
