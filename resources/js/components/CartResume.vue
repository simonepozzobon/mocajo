<template>
<div
    class="cart cart-resume"
    ref="cart"
>
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
                @cart-remove="cartRemove"
            />
        </tbody>
        <tbody>
            <tr>
                <td colspan="2">Totale</td>
                <td>€ {{ this.cartTotal.toFixed(2) }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import CartRow from './CartRow.vue'
export default {
    name: 'CartResume',
    components: {
        CartRow,
    },
    props: {
        isCartEditable: {
            type: Boolean,
            default: true,
        },
    },
    data: function () {
        return {
            cartTotal: 0,
            products: []
        }
    },
    watch: {
        '$root.cart': function (cart) {
            this.updateTotal(cart)
        },
    },
    methods: {
        cartUpdate: function (product) {
            this.$root.cartUpdate(product)
        },
        cartRemove: function (idx) {
            this.$root.cartRemove(idx)
        },
        updateTotal: function (cart) {
            let total = 0
            this.totalQuantity = 0
            for (var i = 0; i < cart.length; i++) {
                total = total + (cart[i].quantity * cart[i].price)
                this.totalQuantity = this.totalQuantity + cart[i].quantity
                this.products.push(cart[i].id)
            }
            this.cartTotal = parseFloat(total)
            this.$emit('update-shipping')
        },

    },
    mounted: function () {
        if (this.$root.cart) {
            this.updateTotal(this.$root.cart)
        }
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
