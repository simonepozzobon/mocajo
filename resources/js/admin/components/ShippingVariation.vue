<template>
<div class="shipping-variation">
    <div class="form-group row">
        <label
            for="add-variation"
            class="col-md-3"
        >
            Nuova Variazione
        </label>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-2">
                    <input
                        type="text"
                        name="left"
                        class="form-control"
                        v-model="variation.left"
                    />
                </div>
                <div class="col-md-2">
                    <select
                        class="form-control"
                        name="operator"
                        v-model="variation.operator"
                    >
                        <option value=">">
                            {{ '>' }}
                        </option>
                        <option value=">=">
                            {{ '>=' }}
                        </option>
                        <option value="=">
                            {{ '=' }}
                        </option>
                        <option value="<">
                            {{ '<' }}
                        </option>
                        <option value="<=">
                            {{ '<=' }}
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input
                        type="text"
                        name="right"
                        class="form-control"
                        v-model="variation.right"
                    >
                </div>
                <div class="offset-md-1 col-md-2">
                    <input
                        type="text"
                        name="left"
                        class="form-control"
                        placeholder="Prezzo"
                        v-model="variation.price"
                    />
                </div>
            </div>
            <small class="text-muted">
                Se il campo di sinistra viene lasciato vuoto, tende ad infinito (eg. > 100)
            </small>
        </div>
    </div>
    <div class="form-group row">
        <label
            for="add-variation"
            class="col-md-3"
        >
            Aggiungi Variazione
        </label>
        <div class="col-md-9">
            <button
                class="btn btn-outline-primary"
                @click="addVariation"
            >
                Aggiungi Variazione
            </button>
        </div>
    </div>
    <div class="form-group row">
        <label
            for="add-variation"
            class="col-md-3"
        >
            Variazioni
        </label>
        <div class="col-md-9">
            <shipping-single-var
                v-for="variation in variations"
                :key="variation.uuid"
                :variation="variation"
                @delete="deleteVar"
            />
        </div>
    </div>
</div>
</template>

<script>
import ShippingSingleVar from './ShippingSingleVar.vue'
import {
    Uuid
}
from '../../Utilities'

export default {
    name: 'ShippingVariation',
    components: {
        ShippingSingleVar,
    },
    props: {
        variations: {
            type: Array,
            default: function () {
                return []
            },
        },
    },
    data: function () {
        return {
            variation: {
                left: 0,
                operator: '',
                right: null,
                price: 0,
            },
        }
    },
    // watch: {
    //     variations: {
    //         handler: function (variations) {
    //             // this.$emit('update', variations)
    //         },
    //         deep: true
    //     }
    // },
    methods: {
        resetVariation: function () {
            this.variation = {
                left: 0,
                operator: '',
                right: null,
                price: 0,
            }
        },
        addVariation: function () {
            let newVar = {
                ...this.variation,
                uuid: Uuid.get()
            }

            let temp = this.variations
            temp.push(newVar)

            this.$emit('update:variations', temp)
            this.resetVariation()
        },
        deleteVar: function (uuid) {
            let idx = this.variations.findIndex(variation => variation.uuid === uuid)
            if (idx > -1) {
                this.variations.splice(idx, 1)
            }
        }
    },
    mounted: function () {
        // console.log(this.variations);
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
