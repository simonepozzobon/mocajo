<template lang="html">
    <div class="home-menu-container" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/' }" exact-active-class="active" @click.native="toggleMobile">
                    Home
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/about' }" exact-active-class="active" @click.native="toggleMobile" ref="odontoiatria">
                    La Scuola di Mocajo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/vini' }" exact-active-class="active" @click.native="toggleMobile" ref="estetica">
                    Vini
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" :to="{ path: '/partner' }" exact-active-class="active" @click.native="toggleMobile">
                    I Nostri Partner
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
                font-family: $font-family-sans-serif;
                color: $white;
                font-weight: 100;
                letter-spacing: 1px;
            }
        }
    }
}
</style>
