<template lang="html">
    <div class="language-menu" ref="menu">
        <nav class="language-menu-navbar">
            <ul class="list-unstyled">
                <li class="nav-item">
                    <a href="#" class="nav-link">Ita</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Eng</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'LanguageMenu',
    watch: {
        '$route': function(route) {
            console.log(route)
            if (route.name != 'home') {
                this.$refs.menu.style.display = 'none'
                return false
            }
            this.$refs.menu.style.display = 'block'
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.language-menu {
    position: fixed;
    top: $spacer * 2.5;
    right: $spacer;
    z-index: 9999;

    nav {
        ul {
            text-align: right;
            font-size: 0.75rem;
            line-height: 1;

            li {
                .nav-link  {
                    color: $white;
                    text-transform: uppercase;
                    cursor: pointer;

                    &:hover, &:focus {
                        color: $primary;
                    }
                }
            }
        }
    }
}
</style>
