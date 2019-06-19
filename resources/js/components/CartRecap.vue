<template>
<div>
    <h1 class="pt-5">{{ item.title }}</h1>
    <table class="table my-4">
        <tbody>
            <tr>
                <td>{{ item.sub }}</td>
                <td>{{ sub.toFixed(2) }} €</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>{{ item.shipping }}</td>
                <td>{{ shipping.toFixed(2) }} €</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    <h5>{{ item.total }}</h5>
                </td>
                <td>{{ total.toFixed(2) }} €</td>
            </tr>
        </tbody>
    </table>
    <div
        class="btns"
        ref="checkoutBtn"
    >
        <div>
            <button
                class="btn btn-primary btn-block btns__btn"
                @click="showCheckout"
            >
                {{ item.checkout }}
            </button>
        </div>
        <div
            align="center"
            class="mt-2"
        >
            <a
                tag="a"
                class="btn btn-link btns__btn"
                @click="$root.goTo($event, 'vini')"
            >
                {{ item.shopping }}
            </a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'CartRecap',
    props: {
        total: {
            type: Number,
            default: 0.00,
        },
        sub: {
            type: Number,
            default: 0.00,
        },
        shipping: {
            type: Number,
            default: 0.00,
        },
    },
    data: function () {
        return {
            item: {
                title: null,
                sub: null,
                shipping: null,
                total: null,
                checkout: null,
                shopping: null,
            },
            translations: {
                title: ['Riepilogo Ordine', 'Order Summary'],
                sub: ['Subtotale', 'Total Amount'],
                shipping: ['Spedizione', 'Shipping Cost'],
                total: ['Totale', 'Grand Total'],
                checkout: ['Effettua il checkout', 'Go to checkout'],
                shopping: ['Continua lo shopping', 'Back to shopping'],
            }
        }
    },
    watch: {
        '$root.locale': function () {
            this.translate()
        },
        sub: function () {
            this.updateTotal()
        },
        shipping: function () {
            this.updateTotal()
        }
    },
    methods: {
        showCheckout: function () {
            this.$emit('show-checkout')
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
        },
        updateTotal: function () {
            let total = this.sub + this.shipping
            this.$emit('update:total', total)
        }
    },
    created: function () {
        this.translate()
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
