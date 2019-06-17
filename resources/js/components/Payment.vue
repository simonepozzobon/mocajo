<template lang="html">
    <div class="payment-module py-5" ref="form">
        <h1>Pagamento</h1>
        <div class="form-group row mt-4">
            <label for="number" class="col-md-2 col-form-label">Numero Carta</label>
            <input
                type="text"
                name="number"
                :disabled="disableInput"
                class="form-control col-md-10"
                v-model="form.number">
        </div>
        <div class="form-group row">
            <label for="expiry_month" class="col-md-2 col-form-label">Scadenza (Mese)</label>
            <input type="text" name="expiry_month" :disabled="disableInput" class="col-md-4 form-control" v-model="form.expiry_month">
            <label for="expiry_year" class="col-md-2 col-form-label">Scadenza (Anno)</label>
            <input type="text" name="expiry_year" :disabled="disableInput" class="col-md-4 form-control" v-model="form.expiry_year">
        </div>
        <div class="form-group row">
            <label for="cvv" class="col-md-2 col-form-label">CVV</label>
            <input type="text" name="cvv" :disabled="disableInput" class="form-control col-md-10" v-model="form.cvv">
        </div>
        <div class="form-group row">
            <div class="col-12">
                <p class="text-danger">
                    Errore {{ paymentErrors }}
                </p>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" @click="pay" ref="pay">Paga</button>
        </div>
    </div>
</template>

<script>
import { TimelineMax } from 'gsap'
require('gsap/ScrollToPlugin')

export default {
    name: 'Payment',
    props: {
        cart: {
            type: Array,
            default: function() {}
        }
    },
    data: function() {
        return {
            form: {
                customer_id: 0,
                order_id: 0,
                number: null,
                expiry_year: null,
                expiry_month: null,
                cvv: null,
            },
            disableInput: false,
            offsetY: 0,
            paymentErrors: null,
        }
    },
    watch: {
        '$root.isMobile': function(value) {
            let main = document.getElementsByTagName('main')[0]
            if (value) {
                this.offsetY = 90
            } else {
                this.offsetY = 130
            }
        },
    },
    methods: {
        showPayment: function() {
            let el = this.$refs.form
            let master = new TimelineMax({ paused: true })
            master.fromTo(el, .6, {
                display: 'none',
                autoAlpha: 0,
            }, {
                display: 'block',
                autoAlpha: 1,
            })

            master.progress(1).progress(0)
            master.eventCallback('onComplete', () => {
                TweenLite.to(window, .6, {
                    scrollTo: {
                        y: el,
                        autoKill: false,
                        offsetY: this.offsetY,
                    },
                }).eventCallback('onComplete', () => {
                    master.kill()
                })
            })
            master.play()
        },
        pay: function() {
            let btn = this.$refs.pay
            this.disableInput = true
            btn.classList.add('disabled')

            this.form.order_id = this.$root.order ? this.$root.order.id : null
            this.form.customer_id = this.$root.customer ? this.$root.customer.id : null

            this.$nextTick(() => {
                this.$http.post('/api/pay', this.form).then(response => {
                    console.log(response.data);
                    if (response.data.success == false) {
                        this.displayError(response.data.errors)
                    } else {
                        this.$emit('completed')
                    }
                }).catch(errs => {
                    console.error(errs);
                })
            })
        },
        displayError: function(errors) {
            let btn = this.$refs.pay
            this.disableInput = true
            btn.classList.add('disabled')

            let message = ''

            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    message = message + errors[key] + ' '
                }
            }
            this.paymentErrors = message
        },
    },
    mounted: function() {
        if (this.$env.debug) {
            this.form = {
                ...this.form,
                'number': '4242424242424242',
                'expiry_month': 10,
                'expiry_year': 2020,
                'cvv': 314,
                'currency': 'EUR',
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';

.payment-module {
    display: none;
    opacity: 0;
}
</style>
