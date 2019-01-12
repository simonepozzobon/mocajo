<template lang="html">
    <div id="home">
        <video-bg videoSrcMp4="/video/home.mp4">
            <div class="logo-overlay">
                <img src="/svg/logo.svg" alt="La Scuola di Mocajo" class="home-img">
            </div>
        </video-bg>
    </div>
</template>

<script>
import VideoBg from '../components/VideoBg.vue'

export default {
    name: 'Home',
    components: {
        VideoBg
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

    .home-img {
        max-width: 80%;
        max-width: 240px;
        height: auto;
    }
}
</style>
