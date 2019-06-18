<template>
<div
    class="spedizione"
    ref="shipping"
>
    <h1 class="pt-5">Spedizione</h1>
    <table class="table my-4">
        <tbody
            v-for="item in this.shippings"
            :key="item.id"
        >
            <td>
                <img
                    :src="item.logo"
                    alt=""
                >
            </td>
            <td>
                {{ item.description }}
            </td>
            <td>
                {{ item.timing }}
            </td>
            <td v-if="isCartEditable">
                <i-check
                    :use-variables="true"
                    color="green"
                    v-if="item.selected"
                />
                <i-uncheck
                    @click.native="selectShipping(item)"
                    v-else
                />
            </td>
            <td v-else>
                <i-check
                    :use-variables="true"
                    color="green"
                    v-if="item.selected"
                />
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
</template>

<script>
import {
    ICheck,
    IUncheck
}
from './icons'
export default {
    name: 'CartShipping',
    components: {
        ICheck,
        IUncheck
    },
    props: {
        isCartEditable: {
            type: Boolean,
            default: true,
        },
    },
    data: function () {
        return {
            shippingTotal: 0,
            shippings: []
        }
    },
    watch: {
        '$root.shippings': function (shippings) {
            this.setDefaultShipping()
        },
    },
    methods: {
        setDefaultShipping: function () {
            this.shippings = this.$root.shippings.map(shipping => {
                if (shipping.default == 1) {
                    shipping.selected = true
                }
                else {
                    shipping.selected = false
                }
                return shipping
            })
            this.updateShipping()
        },
        calculateShipping: function (price) {
            let shipping = this.shippings.find(shipping => shipping.selected == true)
            if (shipping) {
                return parseFloat(price * this.totalQuantity * shipping.increment).toFixed(2)
            }
            return 'error'
        },
        updateShipping: function () {
            if (this.shippings) {
                let shipping = this.shippings.find(shipping => shipping.selected === true)
                this.shippingTotal = this.cartTotal + (shipping.price * this.totalQuantity * shipping.increment)
            }
        },
        selectShipping: function (item) {
            if (this.isCartEditable) {
                this.shippings = this.shippings.map(shipping => {
                    if (shipping.id == item.id) {
                        shipping.selected = true
                    }
                    else {
                        shipping.selected = false
                    }
                    return shipping
                })
                this.updateShipping()
            }
        },
    },
    mounted: function () {
        if (this.$root.shippings) {
            this.shippings = this.$root.shippings
            this.setDefaultShipping()
        }
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
