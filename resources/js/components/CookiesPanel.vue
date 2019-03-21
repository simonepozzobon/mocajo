<template lang="html">
    <div class="cookies-policy container-fluid" ref="panel">
        <div class="cookies-policy-content">
            <p v-html="this.text"></p>
            <button class="btn btn-outline-primary" @click="cookieAccepted">
                Accetto
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
        }
    },
    watch: {
        '$root.options': function(options) {
            this.text = this.translate(options.cookies)
            this.setContent(options.cookies)
        },
    },
    methods: {
        translate: function(obj) {
            if (obj) {
                if (this.$root.locale == 'it') {
                    return obj.text
                }
                return obj.text_en
            }
        },
        setContent: function(section) {
            this.cookies = section.cookies
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
