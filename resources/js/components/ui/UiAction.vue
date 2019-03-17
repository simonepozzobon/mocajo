<template lang="html">
    <a :href="link"
        :target="target"
        class="block-action btn btn-link"
        :class="isDisabledClass"
        @click="goTo($event, url)">
        <slot></slot>
    </a>
</template>

<script>
export default {
    name: 'UiAction',
    props: {
        url: {
            type: String,
            default: null,
        },
        isDisabled: {
            type: Boolean,
            default: false
        },
        target: {
            type: String,
            default: '_self'
        },
    },
    computed: {
        isDisabledClass: function() {
            if (this.isDisabled) {
                return 'disabled'
            }
            return null
        },
        link: function() {
            if (this.target == '_self') {
                return '#'
            }
            return this.url
        },
        isExternal: function() {
            if (this.target == '_self') {
                return false
            }
            return true
        },
    },
    methods: {
        goTo: function(event, name) {
            if (!this.isExternal) {
                event.preventDefault()
                if (this.$route.name != name) {
                    this.$router.push({name: name, params: {lang: this.$root.locale}})
                }
            }

        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.block-action {
    color: $black;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.75rem;
    position: relative;
    padding-top: $spacer / 1.618;


    &::before {
        content: '';
        position: absolute;
        width: $spacer * 2;
        border-bottom: 1px solid $black;
        left: 0;
        top: 0;
    }
}
</style>
