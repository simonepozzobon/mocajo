<template lang="html">
    <div class="language-menu">
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
    name: 'LanguageMenu'
}
</script>

<style lang="scss">
@import '~styles/shared';

.language-menu {
    position: absolute;
    bottom: $spacer;
    right: $spacer;

    nav {
        ul {
            text-align: right;

            li {
                .nav-link  {
                    color: $white;
                    text-transform: uppercase;
                }
            }
        }
    }
}
</style>
