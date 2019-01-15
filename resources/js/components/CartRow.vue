<template lang="html">
    <tr>
        <td>{{ title }}</td>
        <td>
            <button class="btn btn-link" @click="removeQuantity">-</button>
            {{ quantity }}
            <button class="btn btn-link" @click="addQuantity">+</button>
        </td>
        <td>€ {{ total }}</td>
    </tr>
</template>

<script>
export default {
    name: 'CartRow',
    props: {
        title: {
            type: String,
            default: 'prodotto',
        },
        quantity: {
            type: Number,
            default: 0,
        },
        price: {
            type: Number,
            default: 0,
        },
        idx: {
            type: Number,
            default: 0,
        }
    },
    computed: {
        total: function() {
            let total = this.price * this.quantity
            return total.toFixed(2)
        }
    },
    methods: {
        addQuantity: function() {
            // this.quantity = this.quantity + 1
            let item = {
                id: this.idx,
                quantity: this.quantity + 1
            }
            this.$emit('cart-update', item)
        },
        removeQuantity: function() {
            if (this.quantity > 0) {
                // this.quantity = this.quantity - 1
                let item = {
                    id: this.idx,
                    quantity: this.quantity - 1
                }
                this.$emit('cart-update', item)
            }
        },

    }
}
</script>

<style lang="css">
</style>
