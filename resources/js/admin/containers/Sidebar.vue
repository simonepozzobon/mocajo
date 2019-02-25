<template lang="html">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" @click="goTo($event, 'homepage')">
                        Home <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Scuola Mocajo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Storia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contatti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Negozi
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
