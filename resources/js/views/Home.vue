<template lang="html">
    <div id="home">
        <video-bg videoSrcMp4="/video/home.mp4">
            <div class="home-overlay">
                <div class="top-overlay text-white">
                </div>
                <div class="logo-overlay">
                    <img src="/svg/logo.svg" alt="La Scuola di Mocajo" class="home-img">
                </div>
                <div class="bottom-overlay text-white">
                    <home-menu />
                </div>
            </div>
        </video-bg>
    </div>
</template>

<script>
import HomeMenu from '../components/HomeMenu.vue'
import VideoBg from '../components/VideoBg.vue'

export default {
    name: 'Home',
    components: {
        HomeMenu,
        VideoBg
    },
    mounted: function() {
        this.$root.navLogo = false
    },
    beforeDestroy: function() {
        this.$root.navLogo = true
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

#home {
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    position: relative;

    display: flex;
    justify-content: center;
    align-items: center;

    .home-overlay {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        height: 100%;

        .home-img {
            max-width: 80%;
            max-width: 260px;
            height: auto;

            @include media-breakpoint-up('xl') {
                max-width: 80%;
                max-width: 330px;
            };
        }
    }
}
</style>
