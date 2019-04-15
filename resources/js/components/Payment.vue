<template lang="html">
    <div class="py-5">
        <h1>Pagamento</h1>
        <div class="form-group row">
            <label for="card" class="col-md-2 col-form-label">Numero Carta</label>
            <input type="text" name="card" class="form-control col-md-10" v-model="form.card">
        </div>
        <div class="form-group row">
            <label for="expiry_month" class="col-md-2 col-form-label">Scadenza (Mese)</label>
            <input type="text" name="expiry_month" class="col-md-4 form-control" v-model="form.expiry_month">
            <label for="expiry_year" class="col-md-2 col-form-label">Scadenza (Anno)</label>
            <input type="text" name="expiry_year" class="col-md-4 form-control" v-model="form.expiry_year">
        </div>
        <div class="form-group row">
            <label for="cvv" class="col-md-2 col-form-label">CVV</label>
            <input type="text" name="cvv" class="form-control col-md-10" v-model="form.cvv">
        </div>
        <div>
            <button class="btn btn-primary" @click="pay">Paga</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Payment',
    data: function() {
        return {
            form: {
                card: null,
                expiry_year: null,
                expiry_month: null,
                cvv: null,
            }
        }
    },
    methods: {
        pay: function() {
            this.$http.post('/api/pay', this.form).then(response => {
                console.log(response);
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
