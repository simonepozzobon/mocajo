<template lang="html">
    <div>
        <div class="d-flex justify-content-center mb-3">
            <button class="btn btn-outline-primary" @click="newShop">Aggiungi Negozio</button>
        </div>
        <b-table
            :fields="this.fields"
            :items="this.shops">
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
            <button class="btn btn-outline-primary" @click="newShop">Aggiungi Negozio</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsTable',
    props: {
        shops: {
            type: Array,
            default: function() {}
        }
    },
    data: function() {
        return {
            fields: [
                { key: 'name', sortable: true },
                { key: 'city.name', label: 'Città', sortable: true },
                { key: 'tools', sortable: false },
            ],
        }
    },
    methods: {
        newShop: function() {
            this.$emit('new-shop')
        },
        edit: function(product) {
            this.$emit('edit', product)
        },
        destroy: function(product) {
            this.$emit('destroy', product)
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
