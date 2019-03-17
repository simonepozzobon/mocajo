<template lang="html">
    <a href="#" class="block-action btn btn-link" :class="isDisabledClass" @click="goTo($event, url)">
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
        }
    },
    computed: {
        isDisabledClass: function() {
            if (this.isDisabled) {
                return 'disabled'
            }
            return null
        }
    },
    methods: {
        goTo: function(event, name) {
            event.preventDefault()
            console.log(this.$route.name, name);
            if (this.$route.name != name) {
                console.log('ciao');
                this.$router.push({name: name, params: {lang: this.$root.locale}})
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
