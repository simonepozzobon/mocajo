<template lang="html">
    <div class="collapse-container">
        <div class="collapse-header" @click="openPanel" ref="header">
            <div class="button" ref="close">
                +
            </div>
            <div class="title" ref="title">
                {{ this.title }}
            </div>
        </div>
        <div class="collapse-body" ref="panel">
            <p class="collapse-content" ref="content">
                {{ this.text }}
            </p>
        </div>
    </div>
</template>

<script>
import CSSPlugin from 'gsap/CSSPlugin'

export default {
    props: {
        isDisabled: {
            type: Boolean,
            default: false,
        },
        item: {
            type: Object,
            default: function() {}
        }
    },
    data: function() {
        return {
            master: null,
            isOpen: false,
            panelHeight: 0,
            title: null,
            text: null,
            isAnimating: false,
            panel: null,
        }
    },
    watch: {
        '$root.window': function() {
            this.reset()
        },
        '$root.locale': function(locale) {
            this.translate()
        }
    },
    methods: {
        translate: function() {
            this.title = this.$root.locale == 'it' ? this.item.title : this.item.title_en
            this.text = this.$root.locale == 'it' ? this.item.content : this.item.content_en
        },
        reset: function() {
            let panel = this.$refs.panel
            let content = this.$refs.content
            let cRect = content.getBoundingClientRect()
            let cHeight = cRect.height + 16

            if (this.isOpen) {
                TweenLite.set(panel, {
                    clearProps: 'all'
                })
                this.panel.kill()

                TweenLite.to(panel, .3, {
                    height: cHeight,
                    autoAlpha: 1,
                    transformOrigin: "left top 0",
                })

                this.panel = TweenMax.fromTo(panel, .6, {
                    height: 0,
                    autoAlpha: 0,
                    transformOrigin: "left top 0",
                    ease: Power3.easeInOut
                },{
                    height: cHeight,
                    autoAlpha: 1,
                    transformOrigin: "left top 0",
                    ease: Power3.easeInOut,
                })
                this.master.add(this.panel, 0)
            }
        },
        init: function() {
            let panel = this.$refs.panel
            let content = this.$refs.content
            let close = this.$refs.close
            let title = this.$refs.title

            if (this.master) {
                this.isOpen = false
                this.master.kill()
            }

            let cRect = content.getBoundingClientRect()
            let cHeight = cRect.height + 16
            this.panelHeight = cHeight

            TweenLite.set(panel, {
                height: 0,
                autoAlpha: 0,
                transformOrigin: "left top 0",
            })

            this.master = new TimelineMax({
                paused: true,
            })

            this.panel = TweenMax.fromTo(panel, .6, {
                height: 0,
                autoAlpha: 0,
                transformOrigin: "left top 0",
                ease: Power3.easeInOut
            },{
                height: cHeight,
                autoAlpha: 1,
                transformOrigin: "left top 0",
                ease: Power3.easeInOut,
            })
            this.master.add(this.panel, 0)

            this.master.fromTo(close, .3, {
                rotation: 0,
                scale: 1,
            }, {
                rotation: 45,
                scale: 1.5,
                ease: Sine.easeInOut
            }, 0)

            this.master.fromTo(content, .9, {
                autoAlpha: 0,
            }, {
                autoAlpha: 1,
                ease: Sine.easeInOut
            }, 0)

            this.master.fromTo(title, .5, {
                css: {
                    fontWeight: 400,
                }
            }, {
                css: {
                    fontWeight: 600,
                }
            }, 0)

            this.master.progress(1).progress(0)
        },
        openPanel: function() {
            if (this.isOpen) {
                this.isOpen = false
                this.master.reverse(0)
            } else {
                this.isOpen = true
                this.master.restart()
            }
        }
    },
    mounted: function() {
        this.translate()
        this.$nextTick(() => {
            this.init()
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
        // height: 0;

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
