<template lang="html">
    <div class="">
        <h1>Home Page</h1>
        <hr class="pb-4">
        <div class="form">
            <div class="form-group row">
                <label for="video" class="col-md-3">Cambia video</label>
                <div class="input-group mb-3 col-md-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Scegli Video</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="videoPreview" class="col-md-3">Video Preview</label>
                <div class="col-md-9">
                    <video-player
                        class="video-player-box"
                        ref="videoPlayer"
                        :options="playerOptions"
                        :playsinline="true"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'video.js/dist/video-js.css'
import { videoPlayer } from 'vue-video-player'

export default {
    name: 'HomePage',
    components: {
        videoPlayer,
    },
    data: function() {
        return {
            playerOptions: {
                sources: [],
            }
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

</style>
