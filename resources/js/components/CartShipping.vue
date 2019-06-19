<template>
<div
    class="spedizione"
    ref="shipping"
>
    <h1 class="pt-5">{{ item.title }}</h1>
    <table class="table my-4">
        <tbody
            v-for="item in this.shippings"
            :key="item.id"
        >
            <td>
                <img :src="item.logo">
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
                € {{ calculateShipping(item.variations, item.price) }}
            </td>
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
        shippingTotal: Number,
    },
    data: function () {
        return {
            totalQuantity: 0,
            shippings: [],
            item: {
                title: null,
            },
            translations: {
                title: ['Sepdizione', 'Shipping'],
            },
        }
    },
    watch: {
        '$root.cart': function (cart) {
            this.totalQuantity = 0
            for (let i = 0; i < cart.length; i++) {
                this.totalQuantity += cart[i].quantity
            }
            this.updateShipping()
        },
        '$root.shippings': function (shippings) {
            this.setDefaultShipping()
        },
        '$root.locale': function () {
            this.translate()
        }
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
        calculateShipping: function (variations, price) {
            let shipping = this.shippings.find(shipping => shipping.selected == true)
            if (shipping) {
                return parseFloat(this.getPriceVariation(variations, price)).toFixed(2)
            }
            return 'error'
        },
        getPriceVariation: function (variations, price) {
            let quantity = this.totalQuantity

            // https://stackoverflow.com/questions/22919340/javascript-evaluate-string-as-a-comparison-operator
            let comparison = {
                '>': function (value) {
                    return parseFloat(value[0]) > parseFloat(value[1])
                },
                '>=': function (value) {
                    return parseFloat(value[0]) >= parseFloat(value[1])
                },
                '=': function (value) {
                    return parseFloat(value[0]) == parseFloat(value[1])
                },
                '<': function (value) {
                    return parseFloat(value[0]) < parseFloat(value[1])
                },
                '<=': function (value) {
                    return parseFloat(value[0]) <= parseFloat(value[1])
                },
            }

            for (let i = 0; i < variations.length; i++) {
                let variation = variations[i]
                let left = variation.left
                let right = variation.right
                let leftCheck, rightCheck

                if (left || left === 0) {
                    // console.log('abbiamo un left', variation.operator);
                    let leftValue = [left, quantity]
                    let rightValue = [quantity, right]

                    leftCheck = comparison[variation.operator](leftValue)
                    rightCheck = comparison[variation.operator](rightValue)

                    if (leftCheck && rightCheck) {
                        return variation.price
                    }
                }
                else {
                    let rightValue = [quantity, right]
                    rightCheck = comparison[variation.operator](rightValue)

                    if (rightCheck) {
                        return variation.price
                    }
                }
            }

            return price
        },
        updateShipping: function () {
            // deprecata !!!
            let selected = this.shippings.find(shipping => shipping.selected === true)
            let shippingCost = parseFloat(this.getPriceVariation(selected.variations, selected.price))
            // console.log(shippingCost);
            this.$emit('update:shippingTotal', shippingCost)
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
        translate: function () {
            for (let key in this.item) {
                if (this.item.hasOwnProperty(key)) {
                    this.item[key] = this.getTranslation(key)
                }
            }
        },
        getTranslation: function (key) {
            if (this.$root.locale == 'it') {
                return this.translations[key][0]
            }
            return this.translations[key][1]
        }
    },
    created: function () {
        this.translate()
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
