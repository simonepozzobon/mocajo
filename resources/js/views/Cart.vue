<template lang="html">
    <div class="container">
        <div class="row section">
            <div class="col">
                <div class="cart" ref="cart">
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
                                @cart-update="cartUpdate"
                                @cart-remove="cartRemove"/>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2">Totale</td>
                                <td>€ {{ this.cartTotal.toFixed(2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="spedizione" ref="shipping">
                    <h1>Spedizione</h1>
                    <table class="table my-4">
                        <tbody
                            v-for="item in this.shippings"
                            :key="item.id">
                            <td>
                                {{ item.description }}
                            </td>
                            <td>
                                O
                            </td>
                            <td>
                                € {{ calculateShipping(item.price) }}
                            </td>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2">Totale</td>
                                <td>€ {{ parseFloat(this.shippingTotal).toFixed(2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btns">
                    <button class="btn btn-primary">
                        Effettua il checkout
                    </button>
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
            shippings: null,
            shippingTotal: 0,
            totalQuantity: 0,
        }
    },
    watch: {
        '$root.cart': function(cart) {
            this.updateTotal(cart)
        },
        '$root.shippings': function(shippings) {
            this.shippings = shippings
            this.updateShipping()
        }
    },
    methods: {
        updateTotal: function(cart) {
            let total = 0
            this.totalQuantity = 0
            for (var i = 0; i < cart.length; i++) {
                total = total + (cart[i].quantity * cart[i].price)
                this.totalQuantity = this.totalQuantity + cart[i].quantity
            }
            this.cartTotal = parseFloat(total)
            this.updateShipping()

        },
        cartUpdate: function(product) {
            this.$root.cartUpdate(product)
        },
        cartRemove: function(idx) {
            this.$root.cartRemove(idx)
        },
        calculateShipping: function(price) {
            return parseFloat(price * this.totalQuantity * this.shippings[0].increment).toFixed(2)
        },
        updateShipping: function() {
            if (this.shippings) {
                this.shippingTotal = this.cartTotal + (this.shippings[0].price * this.totalQuantity * this.shippings[0].increment)
            }
        }
    },
    mounted: function() {
        if (this.$root.cart) {
            this.updateTotal(this.$root.cart)
        }

        if (this.$root.shippings) {
            this.shippings = this.$root.shippings
            this.updateShipping()
        }
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
