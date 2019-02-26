<template lang="html">
    <nav class="navbar navbar-light fixed-top flex-md-nowrap shadow admin-top-bar">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">La Scuola di Mocajo</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sign out</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
}
</script>

<style lang="scss">
@import '~styles/adminshared';

.admin-top-bar {
    padding-top: $spacer;
    padding-bottom: $spacer;
    @include gradient-directional($light, $gray-300, 175deg);

}
</style>
