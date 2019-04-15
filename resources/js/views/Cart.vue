<template lang="html">
    <div class="container section pb-5">
        <div class="row">
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

                <div class="btns" ref="checkoutBtn">
                    <button class="btn btn-primary btns__btn" @click="showCheckout">
                        Effettua il checkout
                    </button>
                    <router-link tag="a" class="btn btn-link btns__btn" :to="{ path: '/vini' }" exact-active-class="active">
                        Continua con lo shopping
                    </router-link>
                </div>

                <checkout
                    ref="checkPanel"
                    @completed="showPayment"/>

                <payment
                    ref="payment"/>
            </div>
        </div>
    </div>
</template>

<script>
import CartRow from '../components/CartRow.vue'
import Checkout from '../components/Checkout.vue'
import Payment from '../components/Payment.vue'

export default {
    name: 'Cart',
    components: {
        CartRow,
        Checkout,
        Payment,
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
        },
        '$root.isMobile': function() {

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
        },
        showCheckout: function() {
            let container = this.$refs.checkoutBtn
            let btns = container.getElementsByClassName('btns__btn')
            let master = new TimelineMax({
                paused: true,
            })

            master.staggerFromTo(btns, .6, {
                autoAlpha: 1,
            }, {
                autoAlpha: 0,
            }, .1, 0)


            master.progress(1).progress(0)

            master.eventCallback('onComplete', () => {
                this.$nextTick(this.$refs.checkPanel.init)
            })

            master.play()

        },
        showPayment: function() {
            console.log();
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

        this.$nextTick(this.$refs.checkPanel.init)
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.section {
    padding-top: $section-padding;
    overflow-x: hidden;

    @include media-breakpoint-down('sm') {
        padding-top: $section-sm-padding;
    }
}
</style>
