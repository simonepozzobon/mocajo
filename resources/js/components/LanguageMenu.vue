<template lang="html">
    <div class="language-menu" ref="container">
        <nav class="language-menu-navbar">
            <ul class="list-unstyled">
                <li class="nav-item">
                    <a href="#" @click="setLocale($event, 'it')" class="nav-link">Ita</a>
                </li>
                <li class="nav-item">
                    <a href="#" @click="setLocale($event, 'en')" class="nav-link">Eng</a>
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
            if (route.name != 'home') {
                this.$refs.container.style.display = 'none'
                return false
            }
            this.$refs.container.style.display = 'block'
        },
        '$root.isMobile': function(value) {
            if (value) {
                this.$refs.container.style.top = '1rem'
            } else {
                this.$refs.container.style.top = '2.5rem'
            }
        }
    },
    methods: {
        setLocale: function(event, locale) {
            event.preventDefault()
            let name = this.$route.name
            this.locale = locale
            this.$router.push({name: name, params: {lang: locale}})
        }
    },
    mounted: function() {
        if (this.$route.name != 'home') {
            this.$refs.container.style.display = 'none'
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
    z-index: 10000;

    nav {
        ul {
            text-align: right;
            font-size: 0.75rem;
            line-height: 1;

            li {
                .nav-link  {
                    color: $black;
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
