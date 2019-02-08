<template lang="html">
    <router-link tag="a" class="block-action" :to="{ path: '/'+this.url }" exact-active-class="active" @click.native="toggleMobile">
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    name: 'UiAction',
    props: {
        url: {
            type: String,
            default: null,
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

    &::before {
        content: '';
        position: absolute;
        width: $spacer * 2;
        border-bottom: 1px solid $black;
        left: 0;
    }
}
</style>
