<template>
<div class="container section pb-5">
    <div class="row">
        <div class="col-md-8">
            <cart-resume
                ref="resume"
                :is-cart-editable="isCartEditable"
                @update-shipping="updateShipping"
                @update-total="updateSubTotal"
            />
            <cart-shipping
                ref="shipping"
                :shipping-total.sync="shippingTotal"
                :is-cart-editable="isCartEditable"
            />
        </div>
        <div class="col-md-4">
            <cart-recap
                :sub="subTotal"
                :shipping="shippingTotal"
                :total.sync="cartTotal"
                :is-cart-editable.sync="isCartEditable"
                @show-checkout="showCheckout"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <checkout
                ref="checkout"
                :is-debug="this.$env.debug"
                @completed="validateCheckout"
            />

            <payment
                ref="payment"
                :cart="$root.cart"
                @completed="orderCompleted"
            />
        </div>
    </div>
</div>
</template>

<script>
import CartRecap from '../components/CartRecap.vue'
import CartResume from '../components/CartResume.vue'
import CartRow from '../components/CartRow.vue'
import CartShipping from '../components/CartShipping.vue'
import Checkout from '../components/Checkout.vue'
import Payment from '../components/Payment.vue'

export default {
    name: 'Cart',
    components: {
        CartRecap,
        CartResume,
        CartRow,
        CartShipping,
        Checkout,
        Payment,
    },
    data: function () {
        return {
            cartTotal: 0,
            subTotal: 0,
            shippings: null,
            shippingTotal: 0,
            totalQuantity: 0,
            products: [],
            isCartEditable: true,
        }
    },
    watch: {
        '$root.isMobile': function () {

        }
    },
    methods: {
        updateShipping: function () {
            // deprecata !!!
            // if (this.$refs.shipping) {
            //     this.$refs.shipping.updateShipping()
            // }
        },
        updateSubTotal: function (total) {
            this.subTotal = total
        },
        showCheckout: function () {
            this.$refs.checkout.init()
        },
        validateCheckout: function (event = null, checkout = null) {
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

        orderCompleted: function () {

        }
    },
    mounted: function () {
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
