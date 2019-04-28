<template lang="html">
    <page-template title="Gestione Ordini">
        <b-table
            striped
            hover
            :items="this.orders"
            :fields="this.fields">
            <template slot="amount" slot-scope="data">
                {{ data.item.amount }} €
            </template>
            <template slot="tools" slot-scope="data">
                <button class="btn btn-outline-primary" @click="openDetail($event, data.item.id)">Apri</button>
            </template>
        </b-table>
    </page-template>
</template>

<script>
import PageTemplate from '../containers/PageTemplate.vue'
export default {
    name: 'Ordini',
    components: {
        PageTemplate,
    },
    data: function() {
        return {
            orders: [],
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true,
                },
                {
                    key: 'amount',
                    label: 'Totale',
                    sortable: true,
                },
                {
                    key: 'status_code.description',
                    label: 'Stato',
                    sortable: true,
                },
                {
                    key: 'complete_name',
                    label: 'Cliente',
                    sortable: true,
                },
                {
                    key: 'tools',
                    label: 'Azioni',
                    sortable: false,
                }
            ],
        }
    },
    methods: {
        getData: function() {
            this.$http.get('/api/admin/orders/get-orders').then(response => {
                this.orders = response.data.orders
            })
        },
        openDetail: function(event, id) {
            // id => order id
            this.$router.push({
                name: 'ordine',
                params: {
                    id: id,
                }
            })
        }
    },
    mounted: function() {
        this.getData()
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
