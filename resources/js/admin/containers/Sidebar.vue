<template lang="html">
    <nav class="col-md-2 d-none d-md-block sidebar admin-sidebar shadows">
        <div class="sidebar-sticky">
            <h5 class="text-light pl-3">Pagine</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'homepage')">
                        Home <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'scuola-mocajo')">
                        Scuola Mocajo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'storia')">
                        Storia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'vini')">
                        Vini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'contatti')">
                        Contatti
                    </a>
                </li>
            </ul>
            <div class="divider"></div>
            <h5 class="text-light pl-3">Vini</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'prodotti')">
                        Vini <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'negozi')">
                        Negozi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'cities')">
                        Città
                    </a>
                </li>
            </ul>
            <div class="divider"></div>
            <h5 class="text-light pl-3">Negozio</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'homepage')">
                        Gestione Ordini <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <div class="divider"></div>
            <h5 class="text-light pl-3">Generali</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'settings')">
                        Impostazioni <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Sidebar',
    methods: {
        goTo: function(event, route) {
            event.preventDefault()
            this.$router.push(route)
        }
    }
}
</script>

<style lang="scss">
@import '~styles/adminshared';

.admin-sidebar {
    min-height: 100vh;
    @include gradient-directional($dark, $black, 135deg);
    @include box-shadows($black);
    z-index: 1;

    .sidebar-sticky {
        padding-top: $spacer * 8.38;
    }

    .divider {
        width: 10%;
        height: 1px;
        margin: $spacer $spacer;
        background-color: rgba($light, .3);
    }

    .nav-link {
        color: $gray-500;
    }
}
</style>
