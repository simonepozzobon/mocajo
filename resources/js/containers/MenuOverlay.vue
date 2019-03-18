<template lang="html">
    <div class="mobile-nav" ref="container">
        <div class="mobile-nav__content">
            <div class="mobile-nav__logo" ref="logo">
                <img src="/svg/logo-new.svg" alt="" class="img-fluid" @click="goTo($event, 'home')">
            </div>
            <ul class="mobile-nav__menu" ref="menu">
                <li class="mobile-nav__item">
                    <a href="#" class="mobile-nav__link" @click="goTo($event, 'scuola')">
                        {{ this.menu.scuola }}
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="#" class="mobile-nav__link" @click="goTo($event, 'storia')">
                        {{ this.menu.storia }}
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="#" class="mobile-nav__link" @click="goTo($event, 'vini')">
                        {{ this.menu.vini }}
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="#" class="mobile-nav__link" @click="goTo($event, 'contatti')">
                        {{ this.menu.contatti }}
                    </a>
                </li>
            </ul>
            <div class="mobile-social" ref="mobileSocial">
                <ul class="mobile-social__menu" ref="social">
                    <li class="mobile-social__item">
                        <a href="https://www.facebook.com/scuolamocajo" class="mobile-social__link" target="_blank">
                            <svg width="10px" height="20px" viewBox="0 0 10 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="facebook-icon"  class="mobile-social__icon" transform="translate(-1131.000000, -35.000000)" fill="#ffffff"><g id="facebook" transform="translate(1131.000000, 34.000000)"><path d="M6.4905777,21 L6.4905777,11.877238 L9.43898672,11.877238 L9.88075378,8.32144003 L6.4905777,8.32144003 L6.4905777,6.05165886 C6.4905777,5.02233203 6.76614149,4.32092665 8.18721038,4.32092665 L10,4.3196432 L10,1.13989604 C9.68674699,1.09625874 8.61044177,1 7.35866543,1 C4.74513438,1 2.95582329,2.65693384 2.95582329,5.69935186 L2.95582329,8.32144003 L0,8.32144003 L0,11.877238 L2.95582329,11.877238 L2.95582329,21 L6.4905777,21 Z" id="Facebook-Copy-3"></path></g></g></g></svg>
                        </a>
                    </li>
                    <li class="mobile-social__item">
                        <a href="https://www.instagram.com/scuolamocajo/" class="mobile-social__link" target="_blank">
                            <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="instagram-icon" class="mobile-social__icon" transform="translate(-1285.000000, -34.000000)" fill="#ffffff"><g id="instagram" transform="translate(1131.000000, 34.000000)"><path d="M172.503805,0 L156.496195,0 C155.117503,0 154,1.11463874 154,2.49046723 L154,18.5095328 C154,19.8847885 155.117503,21 156.496195,21 L172.503805,21 C173.882497,21 175,19.8847885 175,18.5095328 L175,2.49046723 C175,1.11463874 173.882497,0 172.503805,0 L172.503805,0 Z M169.094018,3.28090991 C169.094018,2.91891007 169.387857,2.62449881 169.749857,2.62449881 L171.718517,2.62449881 C172.08109,2.62449881 172.374928,2.91891007 172.374928,3.28090991 L172.374928,5.24957041 C172.374928,5.61214303 172.08109,5.90598151 171.718517,5.90598151 L169.749857,5.90598151 C169.387857,5.90598151 169.094018,5.61214303 169.094018,5.24957041 L169.094018,3.28090991 L169.094018,3.28090991 Z M164.524343,6.49537681 C166.754766,6.49537681 168.563047,8.29964815 168.563047,10.5237706 C168.563047,12.7496113 166.754766,14.5533099 164.524343,14.5533099 C162.294493,14.5533099 160.486212,12.7496113 160.486212,10.5237706 C160.486212,8.29964815 162.294493,6.49537681 164.524343,6.49537681 L164.524343,6.49537681 Z M173.031339,18.3749284 C173.031339,18.7369282 172.737501,19.0313395 172.374928,19.0313395 L156.625072,19.0313395 C156.262499,19.0313395 155.968661,18.7369282 155.968661,18.3749284 L155.968661,8.53105311 L158.593732,8.53105311 C158.25178,9.02307503 158.136077,9.94124867 158.136077,10.5237706 C158.136077,14.0383766 161.002291,16.897717 164.524343,16.897717 C168.046968,16.897717 170.913182,14.0383766 170.913182,10.5237706 C170.913182,9.94124867 170.830128,9.03682186 170.406268,8.53105311 L173.031339,8.53105311 L173.031339,18.3749284 L173.031339,18.3749284 Z" id="Instagram"></path></g></g></g></svg>
                        </a>
                    </li>
                    <li class="mobile-social__item">
                        <a href="https://www.youtube.com/channel/UCUjslBPqCg9-9i3CuRclh9A/featured?view_as=public" class="mobile-social__link" target="_blank">
                            <svg width="24px" height="18px" viewBox="0 0 24 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="16" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="youtube-icon"  class="mobile-social__icon" transform="translate(-1230.000000, -36.000000)" fill="#ffffff"><g id="youtube" transform="translate(1131.000000, 34.000000)"><path d="M99,11 C99,10.0999955 99.0044642,9.39687753 99.0133929,8.890625 C99.0223215,8.38437247 99.0602675,7.74453512 99.1272321,6.97109375 C99.1941968,6.19765238 99.2946422,5.50625305 99.4285714,4.896875 C99.5714293,4.21249658 99.8794619,3.63593984 100.352679,3.1671875 C100.825895,2.69843516 101.379461,2.42656287 102.013393,2.3515625 C103.995546,2.11718633 106.991051,2 111,2 C115.008949,2 118.004454,2.11718633 119.986607,2.3515625 C120.620539,2.42656287 121.176337,2.69843516 121.654018,3.1671875 C122.131699,3.63593984 122.441964,4.21249658 122.584821,4.896875 C122.709822,5.50625305 122.805803,6.19765238 122.872768,6.97109375 C122.939732,7.74453512 122.977679,8.38437247 122.986607,8.890625 C122.995536,9.39687753 123,10.0999955 123,11 C123,11.9000045 122.995536,12.6031225 122.986607,13.109375 C122.977679,13.6156275 122.939732,14.2554649 122.872768,15.0289063 C122.805803,15.8023476 122.705358,16.493747 122.571429,17.103125 C122.428571,17.7875034 122.120538,18.3640602 121.647321,18.8328125 C121.174105,19.3015648 120.620539,19.5734371 119.986607,19.6484375 C118.004454,19.8828137 115.008949,20 111,20 C106.991051,20 103.995546,19.8828137 102.013393,19.6484375 C101.379461,19.5734371 100.823663,19.3015648 100.345982,18.8328125 C99.8683012,18.3640602 99.5580364,17.7875034 99.4151786,17.103125 C99.2901779,16.493747 99.1941968,15.8023476 99.1272321,15.0289063 C99.0602675,14.2554649 99.0223215,13.6156275 99.0133929,13.109375 C99.0044642,12.6031225 99,11.9000045 99,11 Z M107.571429,15.5 C107.571429,15.8562518 107.718749,16.1187492 108.013393,16.2875 C108.156251,16.3625004 108.294642,16.4 108.428571,16.4 C108.607144,16.4 108.758928,16.3531255 108.883929,16.259375 L115.741071,11.759375 C116.00893,11.5999992 116.142857,11.3468767 116.142857,11 C116.142857,10.6531233 116.00893,10.4000008 115.741071,10.240625 L108.883929,5.740625 C108.607141,5.55312406 108.316966,5.54374916 108.013393,5.7125 C107.718749,5.88125084 107.571429,6.14374822 107.571429,6.5 L107.571429,15.5 Z" id="icon"></path></g></g></g></svg>
                        </a>
                    </li>
                </ul>
            </div>
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
            menu: {
                scuola: null,
                storia: null,
                vini: null,
                contatti: null,
            },
            duration: .6,
            scale: 2,
            ease: Sine.easeOut,
            back: Back.easeOut.config(1.3),
            customEase: null,
            status: false,
            started: true,
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setOptions(options.menu)
        }
    },
    computed: {
        uuid: function() {
            // https://stackoverflow.com/questions/105034/create-guid-uuid-in-javascript
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            )
        },
    },
    methods: {
        setOptions: function(section) {
            this.menu = section
        },
        goTo: function(event, name) {
            event.preventDefault()
            this.$emit('main-click', name, true)
        },
        init: function() {
            if (!this.master) {
                let duration = this.duration
                let scale = 2
                let invscale = 1 / scale

                let container = this.$refs.container
                let el = this.$refs.content
                let links = Array.prototype.slice.apply(container.getElementsByClassName('mobile-nav__logo'))

                let items = Array.prototype.slice.apply(container.getElementsByClassName('mobile-nav__item'))
                let socials = this.$refs.mobileSocial

                links = links.concat(items)
                links = links.concat(socials)

                let rect = container.getBoundingClientRect()
                let height = window.innerHeight

                let linksDuration = duration * .4
                let linksDelay = linksDuration / links.length
                let linksStart = duration * 0.27

                // TweenMax.set(container, {
                //     height: 0,
                //     position: 'absolute',
                //     left: 0,
                //     bottom: 0,
                // })

                this.master = new TimelineMax({
                    paused: true,
                    reversed: true,
                })
                this.master.fromTo(container, .05, {
                    display: 'none',
                }, {
                    display: 'block',
                }, 0)

                this.master.fromTo(container, duration / 2, {
                    opacity: 0,
                    yPercent: 100,
                    ease: ExpoScaleEase.config(invscale, 1, this.backSoft),
                }, {
                    yPercent: 0,
                    opacity: 1,
                    ease: ExpoScaleEase.config(invscale, 1, this.backSoft),
                }, 0)

                this.master.staggerFromTo(links, linksDuration, {
                    opacity: 0,
                    x: -30,
                    y: 5,
                    scaleY: .8,
                    ease: ExpoScaleEase.config(invscale, 1, Power4.easeIn),
                }, {
                    opacity: 1,
                    x: 0,
                    y: 0,
                    scaleY: 1,
                    ease: ExpoScaleEase.config(invscale, 1, Power4.easeIn),
                }, linksDelay, linksStart)

                this.master.progress(1).progress(0)

                // vai sempre in alto quando apre il il menu
                this.$emit('ready')

            } else {
                this.master.kill()
                this.master = null
                this.$nextTick(() => {
                    this.init()
                })
            }
        },
        toggle: function() {
            if (this.status) {
                this.status = false
                return this.close()
            }
            this.status = true
            return this.open()
        },
        open: function() {
            this.master.play()
        },
        close: function() {
            this.master.reverse()
        },
        destroy: function() {
            return new Promise(resolve => {
                if (this.master) {
                    console.log('attendo');
                    this.master.pause()
                    this.master.eventCallback('onReverseComplete', () => {
                        resolve()
                    })
                    this.master.reverse()
                } else {
                    resolve()
                }
            })
        }
    },
    mounted: function() {
        if (this.$root.options) {
            this.setOptions(this.$root.options.menu)
        }
        this.init()
    },
}
</script>

<style lang="scss">
@import '~styles/shared';

.mobile-nav {
    position: fixed;
    width: 100vw;
    height: 100vh;
    background-color: $black;
    z-index: 1090;
    overflow-x: hidden;
    overflow-y: scroll;

    // visibility: hidden; /* hides all .Tile-flyout on load so GSAP autoAlpha can do its thing */
    // height: auto; /* tell the browser that initial height is auto */
    // overflow: hidden;
    opacity: 0;

    transform-origin: center top 0;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;

    &__content {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        min-height: 100vh;
        padding-top: $spacer * 4;

        @include media-breakpoint-up('sm') {
            justify-content: center;
            padding-top: inherit;
        };
    }

    &__logo {
        max-width: 80%;
        max-width: 180px;
        height: auto;
        margin-bottom: $spacer * 2;
        display: block;
        padding-bottom: 0;
        margin-top: 0;

        @include media-breakpoint-up('sm') {
            display: block;
            margin-top: -$spacer;
            padding-bottom: 40px;
        };
    }

    &__menu {
        text-align: center;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    &__item {

    }

    &__link {
        font-weight: 200;
        color: $white;
        font-size: 1.25rem;
        line-height: 2;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: $transition-base;
        @include media-breakpoint-up('md') {
            font-size: 1.75rem;
            line-height: 3;
        }

        &:hover, &:focus {
            color: $primary;
            text-decoration: none;
            transition: $transition-base;
        }
    }

    &__social {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }
}

.mobile-social {
    $self: &;

    &__menu {
        list-style-type: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    &__item {
        padding: $spacer;
    }

    &__link {
        $link: &;

        &:hover {
            #{$self}__icon {
                fill: $primary;
                transition: $transition-base;
            }
        }
    }

    &__icon {
        transition: $transition-base;
    }
}
</style>
