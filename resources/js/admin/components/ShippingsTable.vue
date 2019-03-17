<template lang="html">
    <div>
        <div class="d-flex justify-content-center mb-3">
            <button class=" ml-3 btn btn-outline-primary" @click="addShipping">Aggiungi Corriere</button>
        </div>
        <b-table
            :fields="this.fields"
            :items="this.shippings">
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
            <button class=" ml-3 btn btn-outline-primary" @click="addShipping">Aggiungi Corriere</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShippingsTable',
    props: {
        shippings: {
            type: Array,
            default: function() {}
        }
    },
    data: function() {
        return {
            fields: [
                { key: 'description', sortable: true },
                { key: 'price', sortable: true },
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
        addShipping: function() {
            this.$emit('new-shipping')
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
