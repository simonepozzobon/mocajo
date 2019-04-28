<template lang="html">
    <page-template :title="orderTitle">
        <ui-order-section title="Stato dell'Ordine" v-if="this.order">
            <ui-order-field label="Stato" :value="order.status_code.description" size="12"/>
            <ui-order-field label="Codice Transazione" :value="order.transaction_id" size="12"/>
            <ui-order-div class="mb-4" v-if="this.editable"/>
            <div class="col-md-12 d-flex justify-content-around" v-if="this.editable">
                <button class="btn btn-outline-primary" @click="setShipped" v-if="this.order.status_code_id == 2">Imposta su Spedito</button>
                <button class="btn btn-outline-success" @click="setDelivered" v-if="this.order.status_code_id == 3">Imposta su Consegnato</button>
            </div>
            <div class="col-md-12 mt-4" v-if="this.editable">
                <p class="text-center small text-danger">
                    Attenzione: Una volta modificato lo stato dell'ordine una mail sarà inviata anche al cliente
                </p>
            </div>
            <ui-order-div />
        </ui-order-section>
        <ui-order-section title="Dati Cliente" v-if="this.customer">
            <ui-order-field label="Tipologia" value="nessuna"/>
            <ui-order-field label="Email" :value="customer.email"/>
            <ui-order-field label="Ragione Sociale" :value="customer.company_name" size="12"/>
            <ui-order-field label="IVA" :value="customer.vat"/>
            <ui-order-field label="Codice Fiscale" :value="customer.code"/>
            <ui-order-div />
            <ui-order-field label="Nome" :value="customer.name"/>
            <ui-order-field label="Cognome" :value="customer.surname"/>
            <ui-order-field label="Telefono" :value="customer.phone" size="12"/>
            <ui-order-div />
            <ui-order-field label="Stato" :value="customer.country_name" size="12"/>
            <ui-order-field label="Provincia" :value="customer.region"/>
            <ui-order-field label="C.A.P." :value="customer.cap"/>
            <ui-order-field label="Città" :value="customer.city" size="12"/>
            <ui-order-field label="Indirizzo" :value="customer.address" size="12"/>
            <ui-order-field label="Indirizzo Aggiuntivo" :value="customer.address_secondary" size="12"/>
            <ui-order-div />
        </ui-order-section>
        <ui-order-section title="Prodotti" v-if="this.order">
            <div class="col-md-12">
                <b-table
                    hover
                    striped
                    :items="products"
                    :fields="fields">
                    <template slot="price" slot-scope="data">
                        {{ data.item.price }} €
                    </template>
                    <template slot="amount" slot-scope="data">
                        {{ data.item.amount }} €
                    </template>
                </b-table>
            </div>
        </ui-order-section>
        <ui-order-section title="Spedizione" v-if="this.order">
            <ui-order-field label="Descrizione" :value="this.shipping.description" />
            <ui-order-field label="Incremento" :value="this.shipping.increment" />
            <ui-order-field label="Prezzo" :value="this.shipping.price" />
            <ui-order-field label="Tempo" :value="this.shipping.timing" />
        </ui-order-section>
    </page-template>
</template>

<script>
import PageTemplate from '../containers/PageTemplate.vue'
import { UiOrderDiv, UiOrderField, UiOrderSection, UiOrderTitle } from '../components/ui'

export default {
    name: 'OrdineSingolo',
    components: {
        PageTemplate,
        UiOrderDiv,
        UiOrderField,
        UiOrderSection,
        UiOrderTitle,
    },
    data: function() {
        return {
            order: null,
            customer: null,
            shipping: null,
            editable: null,
            products: [],
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true,
                },
                {
                    key: 'alt',
                    label: 'Descrizione',
                    sortable: true,
                },
                {
                    key: 'price',
                    label: 'Prezzo Unitario',
                    sortable: true,
                },
                {
                    key: 'pivot.quantity',
                    label: 'Quantità',
                    sortable: true,
                },
                {
                    key: 'amount',
                    label: 'Totale',
                    sortable: true,
                }
            ],
        }
    },
    computed: {
        orderTitle: function() {
            if (this.order) {
                return 'Ordine - ID: ' + this.order.id
            }
            return 'Nessun Ordine'
        },
    },
    methods: {
        getOrder: function() {
            let id = this.$route.params.id
            let url = '/api/admin/orders/get-order/'+ id
            this.$http.get(url).then(response => {
                this.order = response.data.order
                this.customer = response.data.order.customer
                this.shipping = response.data.order.shipping

                if (this.order.status_code_id == 2 || this.order.status_code_id == 3) {
                    this.editable = true
                } else {
                    this.editable = false
                }

                this.products = response.data.order.products.map(product => {
                    product.amount = (product.price * product.pivot.quantity).toFixed(2)
                    return product
                })
                console.log(this.order);
            })
        },
        setShipped: function() {
            let id = this.order.id
            let url = '/api/admin/orders/set-shipped/' + id
            this.$http.get(url).then(response => {
                console.log(response.data);
                this.getOrder()
            })
        },
        setDelivered: function() {
            let id = this.order.id
            let url = '/api/admin/orders/set-delivered/' + id
            this.$http.get(url).then(response => {
                console.log(response.data);
                this.getOrder()
            })
        },
    },
    created: function() {
        this.getOrder()
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
