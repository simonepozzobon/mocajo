<template lang="html">
    <div class="container">
        <div class="row section">
            <div class="col">
                <h1>Carrello</h1>
                <table class="table my-4">
                    <thead>
                        <tr>
                            <td>Prodotto</td>
                            <td>Quantità</td>
                            <td>Prezzo</td>
                        </tr>
                    </thead>
                    <tbody>
                        <cart-row
                            v-for="product in this.$root.cart"
                            :key="product.id"
                            :idx="product.id"
                            :title="product.title"
                            :price="product.price"
                            :quantity="product.quantity"
                            @cart-update="cartUpdate"/>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Totale</td>
                            <td>€ {{ this.cartTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="btns">
                    <a href="#" class="btn btn-primary">Procedi con il pagamento</a>
                    <router-link tag="a" class="btn btn-link" :to="{ path: '/vini' }" exact-active-class="active">
                        Continua con lo shopping
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CartRow from '../components/CartRow.vue'

export default {
    name: 'Cart',
    components: {
        CartRow
    },
    data: function() {
        return {
            cartTotal: 0,
        }
    },
    watch: {
        '$root.cart': function(cart) {
            this.updateTotal(cart)
        }
    },
    methods: {
        updateTotal: function(cart) {
            let total = 0
            for (var i = 0; i < cart.length; i++) {
                total = total + (cart[i].quantity * cart[i].price)
            }
            this.cartTotal = total.toFixed(2)
        },
        cartUpdate: function(product) {
            this.$root.cartUpdate(product)
        }
    },
    mounted: function() {
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.section {
    max-width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

}
</style>
