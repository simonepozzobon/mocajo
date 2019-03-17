<template lang="html">
    <div>
        <div class="d-flex justify-content-center mb-3">
            <button class=" ml-3 btn btn-outline-primary" @click="addCity">Aggiungi Città</button>
        </div>
        <b-table
            :fields="this.fields"
            :items="this.cities">
            <template slot="tools" slot-scope="data">
                <div class="btn-group">
                    <button class="btn btn-outline-info" @click="edit(data.item)">
                        Modifica
                    </button>
                    <button class="btn btn-outline-danger" @click="destroy(data.item)">
                        Elimina
                    </button>
                </div>
            </template>
        </b-table>
        <hr>
        <div class="d-flex justify-content-center">
            <button class=" ml-3 btn btn-outline-primary" @click="addCity">Aggiungi Città</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsTable',
    props: {
        cities: {
            type: Array,
            default: function() {}
        }
    },
    data: function() {
        return {
            fields: [
                { key: 'name', sortable: true },
                { key: 'tools', sortable: false },
            ],
        }
    },
    methods: {
        edit: function(product) {
            this.$emit('edit', product)
        },
        destroy: function(product) {
            this.$emit('destroy', product)
        },
        addCity: function() {
            this.$emit('new-city')
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
