<template lang="html">
    <div class="collapse-container">
        <div class="collapse-header" @click="openPanel">
            <div class="button" ref="close">
                +
            </div>
            <div class="title" ref="title">
                {{ title }}
            </div>
        </div>
        <div class="collapse-body" ref="panel">
            <p class="collapse-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'titolo'
        }
    },
    data: function() {
        return {
            master: null,
            isOpen: false,
            panelHeight: 0,
        }
    },
    methods: {
        openPanel: function() {
            if (this.isOpen) {
                this.master.reverse()
                this.isOpen = false
            } else {
                if (!this.master) {
                    let panel = this.$refs.panel
                    let close = this.$refs.close
                    let title = this.$refs.title

                    this.master = new TimelineMax({
                        paused: true,
                        reversed: true,
                    })

                    this.master.fromTo(panel, .6, {
                        height: 0,
                        autoAlpha: 0,
                        transformOrigin: "left top 0",
                    },{
                        height: this.panelHeight,
                        scaleY: 1,
                        autoAlpha: 1,
                        transformOrigin: "left top 0",
                        ease: Sine.easeInOut
                    }, 0)

                    this.master.fromTo(close, .3, {
                        rotation: 0,
                        scale: 1,
                    }, {
                        rotation: 45,
                        scale: 1.5,
                    }, 0)

                    this.master.fromTo(title, .3, {
                        fontSize: 16,
                        fontWeight: 400,
                    }, {
                        fontSize: 18,
                        fontWeight: 600,
                    }, 0)

                    this.master.progress(1).progress(0);
                    this.master.play()
                    this.isOpen = true
                } else {
                    this.master.play()
                    this.isOpen = true
                }
            }
        }
    },
    mounted: function() {
        this.panelHeight = this.$refs.panel.offsetHeight
        TweenLite.set(this.$refs.panel, {
            height: 0,
            autoAlpha: 0,
            transformOrigin: "left top 0",
        })
    }
}
</script>

<style lang="scss" >
@import '~styles/shared';

.collapse-container {
    border-bottom: 1px solid $black;

    .collapse-header {
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        padding: ($spacer / 2) * 1.618;
    }

    .collapse-body {
        position: relative;
        height: 0;

        visibility:hidden; /* hides all .Tile-flyout on load so GSAP autoAlpha can do its thing */
        height:auto; /* tell the browser that initial height is auto */
        overflow:hidden;

        .collapse-content {
            padding-top: $spacer * 1.618;
            padding-bottom: $spacer * 1.618 * 2;
        }
    }
}

</style>
