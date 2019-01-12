<template lang="html">
    <nav class="navbar navbar-dark navbar-expand-lg" ref="navbar" :class="this.navClass">
        <router-link tag="a" class="navbar-brand" :to="{ path: '/' }" exact-active-class="active">
            <!-- <nav-logo :width="214"  ref="logo"/> -->
            <!-- <nav-logo :width="this.logoSize" ref="logo"/> -->
        </router-link>

        <div class="d-lg-none position-relative">
            <!-- <burger :width="burgerSize" @toggle-mobile="toggleMobile"/> -->
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/' }" exact-active-class="active">
                        Home
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/odontoiatria' }" exact-active-class="active" ref="odontoiatria">
                        La Scuola di Mocajo
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/medicina-estetica' }" exact-active-class="active" ref="estetica">
                        Vini
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ path: '/about' }" exact-active-class="active">
                        I Nostri Partner
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'MainNav',
    data: function() {
        return {
            navClass: ''
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.navbar {
    // min-height: 112px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    min-height: 60px;
    height: 70px;
    background-color: rgba($white, 0);

    transition: $transition-base;

    .nav-link {
        font-weight: normal;
    }
}
</style>
