<template lang="html">
    <div>
        <b-table
            :fields="this.fields"
            :items="this.products">
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
            <button class="btn btn-outline-primary" @click="newProduct">Aggiungi Vino</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsTable',
    props: {
        products: {
            type: Array,
            default: function() {}
        }
    },
    data: function() {
        return {
            fields: [
                { key: 'title', sortable: true },
                { key: 'is_active', sortable: true, },
                { key: 'tools', sortable: false },
            ],
        }
    },
    methods: {
        newProduct: function() {
            this.$emit('new-product')
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
