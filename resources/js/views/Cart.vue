<template lang="html">
    <div class="container">
        <div class="row section">
            <div class="col">
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
                        <tr>
                            <td>Vino 1</td>
                            <td>
                                <button class="btn btn-link">-</button>
                                2
                                <button class="btn btn-link">+</button>
                            </td>
                            <td>€ 30,00</td>
                        </tr>
                        <tr>
                            <td>Vino 3</td>
                            <td>
                                <button class="btn btn-link">-</button>
                                2
                                <button class="btn btn-link">+</button>
                            </td>
                            <td>€ 40,00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Totale</td>
                            <td>€ 70,00</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="btns">
                    <a href="#" class="btn btn-primary">Procedi con il pagamento</a>
                    <router-link tag="a" class="btn btn-link" :to="{ path: '/vini' }" exact-active-class="active">
                        Continua con lo shopping
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cart'
}
</script>

<style lang="scss">
@import '~styles/shared';

.section {
    max-width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

}
</style>
