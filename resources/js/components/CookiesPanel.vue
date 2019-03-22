<template lang="html">
    <div class="cookies-policy container-fluid" ref="panel">
        <div class="cookies-policy-content">
            <p v-html="this.text"></p>
            <button class="btn btn-outline-primary" @click="cookieAccepted">
                {{ this.btnText }}
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import {TimelineMax} from 'gsap'

export default {
    name: 'CookiesPanel',
    data: function() {
        return {
            text: null,
            cookies: null,
            cookie: null,
            accepted: false,
            btnText: null,
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setOptions(options.cookies)
            this.translate()
        },
        '$root.locale': function(locale) {
            this.translate(locale)
        },
    },
    methods: {
        translate: function(locale = false) {
            locale = locale ? locale : this.$root.locale

            switch (locale) {
                case 'en':
                    this.btnText = 'Accept'
                    this.text = this.cookies ? this.cookies.text_en : null
                    break;
                case 'it':
                    this.btnText = 'Accetto'
                    this.text = this.cookies ? this.cookies.text : null
                    break;
            }
        },
        setOptions: function(section) {
            this.cookies = section
            this.text = this.$root.locale == 'it' ? section.text : section.text_en
        },
        goTo: function(event, path) {
            event.preventDefault()
            if (this.$route.path != path) {
                this.$router.push(path)
                return false
            }
            return false
        },
        showPanel: function() {
            let master = new TimelineMax({
                paused: true
            })

            master.fromTo(this.$refs.panel, 1, {
                autoAlpha: 0,
                yPercent: 100,
                display: 'none',
            }, {
                autoAlpha: 1,
                yPercent: 0,
                display: 'block',
                ease: Cubic.easeInOut
            }, .0)

            master.play()
        },
        hidePanel: function() {
            let master = new TimelineMax({
                paused: true
            })

            master.fromTo(this.$refs.panel, .4, {
                autoAlpha: 1,
                yPercent: 0,
            }, {
                autoAlpha: 0,
                yPercent: 100,
                display: 'none',
                ease: Cubic.easeInOut
            }, .0)

            master.play()
        },
        cookieAccepted: function() {
            axios.post('/api/cookies/accepted').then(response => {
                this.$cookie.set('mocajo-cookie-policy', JSON.stringify(response.data))
                this.hidePanel()
                this.accepted = true
            })
        }
    },
    mounted: function() {
        // this.hidePanel()
        if (this.$root.options) {
            this.setOptions(this.$root.options.cookies)
        }
        if (!this.accepted) {
            let cookie = this.$cookie.get('mocajo-cookie-policy')
            if (cookie) {
                this.cookie = JSON.parse(cookie)
            } else {
                this.showPanel()
            }
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.cookies-policy {
    position: fixed;
    bottom: 0;
    z-index: 1090;
    background-color: $black;
    color: rgba($white, .8);
    display: none;

    .cookies-policy-content {
        padding: $spacer * 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        p {
            font-size: 0.65rem;
            text-align: center;
        }
    }
}
</style>
