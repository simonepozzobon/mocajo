<template lang="html">
    <div class="home-menu-container" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/scuola-mocajo' }" exact-active-class="active">
                    Scuola Mocajo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/la-nostra-storia' }" exact-active-class="active">
                    Storia
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/i-nostri-vini' }" exact-active-class="active">
                    I Nostri Vini
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/contatti' }" exact-active-class="active">
                    Contatti
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'HomeMenu'
}
</script>

<style lang="scss">
@import '~styles/shared';

.home-menu-container {
    ul {
        li {
            display: inline-block;

            .nav-link {
                font-weight: 300;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: $white;

                &:hover {
                    color: $primary;
                }
            }
        }
    }
}
</style>
