<template lang="html">
    <div class="container section pb-5">
        <div class="row">
            <div class="col">
                <div class="cart" ref="cart">
                    <h1 class="pt-5">Carrello</h1>
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
                                :is-editable="isCartEditable"
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
                                <img :src="item.logo" alt="">
                            </td>
                            <td>
                                {{ item.description }}
                            </td>
                            <td>
                                {{ item.timing }}
                            </td>
                            <td v-if="isCartEditable">
                                <i-check :use-variables="true" color="green" v-if="item.selected"/>
                                <i-uncheck @click.native="selectShipping(item)" v-else/>
                            </td>
                            <td v-else>
                                <i-check :use-variables="true" color="green" v-if="item.selected"/>
                            </td>
                            <td>
                                € {{ calculateShipping(item.price) }}
                            </td>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="4">Totale Con Spedizione</td>
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
                    ref="checkout"
                    :is-debug="this.$env.debug"
                    @completed="validateCheckout"/>

                <payment
                    ref="payment"
                    :cart="$root.cart"
                    @completed="orderCompleted"/>

            </div>
        </div>
    </div>
</template>

<script>
import CartRow from '../components/CartRow.vue'
import Checkout from '../components/Checkout.vue'
import Payment from '../components/Payment.vue'
import { ICheck, IUncheck } from '../components/icons'

export default {
    name: 'Cart',
    components: {
        CartRow,
        Checkout,
        ICheck,
        IUncheck,
        Payment,
    },
    data: function() {
        return {
            cartTotal: 0,
            shippings: null,
            shippingTotal: 0,
            totalQuantity: 0,
            products: [],
            isCartEditable: true,
        }
    },
    watch: {
        '$root.cart': function(cart) {
            this.updateTotal(cart)
        },
        '$root.shippings': function(shippings) {
            this.shippings = shippings.map(shipping => {
                if (shipping.default == 1) {
                    shipping.selected = true
                } else {
                    shipping.selected = false
                }
                return shipping
            })
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
                this.products.push(cart[i].id)
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
            let shipping = this.shippings.filter(shipping => shipping.selected == true)[0]
            return parseFloat(price * this.totalQuantity * shipping.increment).toFixed(2)
        },
        updateShipping: function() {
            if (this.shippings) {
                let shipping = this.shippings.filter(shipping => shipping.selected == true)[0]
                this.shippingTotal = this.cartTotal + (shipping.price * this.totalQuantity * shipping.increment)
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

            master.eventCallback('onStart', () => {
                this.isCartEditable = false
            })

            master.eventCallback('onComplete', () => {
                this.$nextTick(this.$refs.checkout.init)
            })

            master.play()

        },
        validateCheckout: function(event = null, checkout = null) {
            let shipping = this.shippings.filter(shipping => shipping.selected == true)[0]

            let data = {
                products: this.$root.cart,
                checkout: checkout,
                shipping: shipping,
                amount: this.shippingTotal.toFixed(2),
            }

            // console.log(data);

            this.$http.post('/api/save-order', data).then(response => {
                this.$root.customer = response.data.customer
                this.$root.order = response.data.order
                this.$nextTick(this.$refs.payment.showPayment)
            })
        },
        selectShipping: function(item) {
            if (this.isCartEditable) {
                this.shippings = this.shippings.map(shipping => {
                    if (shipping.id == item.id) {
                        shipping.selected = true
                    } else {
                        shipping.selected = false
                    }
                    return shipping
                })
                this.updateShipping()
            }
        },
        orderCompleted: function() {
            
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

        if (this.$env.debug) {
            this.$nextTick(() => {
                this.showCheckout()
            })
        }
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

    .ui-icon {
        cursor: pointer;
    }
}
</style>
