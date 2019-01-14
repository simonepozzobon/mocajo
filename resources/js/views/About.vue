<template lang="html">
    <div class="container section">
        <div class="row">
            <div class="col-md-6">
                <h1>La Scuola di Mocajo</h1>
                <p>
                    Mauris tempus, augue gravida lacinia hendrerit, orci sem pretium augue, nec tempor mi turpis in tortor. Sed porta lectus in quam sodales, venenatis fermentum magna convallis. Morbi vel laoreet est, vitae euismod magna. Nulla facilisi. Nunc ornare, erat ut iaculis sagittis, lectus tellus tincidunt dolor, tristique pulvinar felis nisl finibus neque. Nunc maximus risus at felis ultrices bibendum sit amet nec velit. Fusce sit amet purus velit. Pellentesque blandit turpis eu lacus ullamcorper pharetra. Phasellus tincidunt leo in lectus congue facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed a risus accumsan, ullamcorper urna et, scelerisque nulla.
                </p>
            </div>
            <div class="col-md-6">
                <img src="/images/about.jpg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</template>

<script>
import {TimelineMax} from 'gsap'

export default {
    name: 'LaScuola',
    mounted: function() {
        this.$root.navbar = 1
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.section {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
