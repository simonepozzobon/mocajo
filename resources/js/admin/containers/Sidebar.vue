<template lang="html">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5">
        <div class="sidebar-sticky">
            <hr>
            <h5 class="text-center">Pagine</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" @click="goTo($event, 'homepage')">
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
                    <a class="nav-link" href="#" @click="goTo($event, 'contatti')">
                        Contatti
                    </a>
                </li>
            </ul>
            <hr>
            <h5 class="text-center">Vini</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" @click="goTo($event, 'vini')">
                        Vini <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="goTo($event, 'negozi')">
                        Negozi
                    </a>
                </li>
            </ul>
            <hr>
            <h5 class="text-center">Negozio</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" @click="goTo($event, 'homepage')">
                        Gestione Ordini <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <hr>
            <h5 class="text-center">Generali</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" @click="goTo($event, 'homepage')">
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
@import '~styles/shared';
.sidebar {
    min-height: 100vh;
}
</style>
