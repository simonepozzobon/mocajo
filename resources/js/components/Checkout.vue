<template lang="html">
    <div class="checkout-panel" ref="form">
        <h1>Checkout</h1>
        <div class="form-group row mt-4">
            <label for="category" class="col-md-2 col-form-label">Tipologia</label>
            <select class="form-control col-md-4" name="category" v-model="formValues.category" required>
                <option value="1">Persona Fisica</option>
                <option value="2">Azienda</option>
                <option value="3">Professionista</option>
            </select>
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <input type="email" name="email" class="form-control col-md-4" v-model="formValues.email" required/>
        </div>
        <div class="form-group row">
            <label for="company_name" class="col-md-2 col-form-label">Ragione Sociale</label>
            <input type="company_name" name="company_name" class="form-control col-md-10" v-model="formValues.company_name"/>
        </div>
        <div class="form-group row">
            <label for="vat" class="col-md-2 col-form-label">IVA</label>
            <input type="vat" name="vat" class="form-control col-md-4" v-model="formValues.vat"/>
            <label for="code" class="col-md-2 col-form-label">Codice Fiscale</label>
            <input type="code" name="code" class="form-control col-md-4" v-model="formValues.code"/>
        </div>
        <hr class="my-5"/>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label">Nome</label>
            <input type="name" name="name" class="form-control col-md-4" v-model="formValues.name" required/>
            <label for="surname" class="col-md-2 col-form-label">Cognome</label>
            <input type="surname" name="surname" class="form-control col-md-4" v-model="formValues.surname" required/>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-md-2 col-form-label">Telefono</label>
            <input type="phone" name="phone" class="form-control col-md-10" v-model="formValues.phone" required/>
        </div>
        <hr class="my-5"/>
        <div class="form-group row">
            <label for="country" class="col-md-2 col-form-label">Stato</label>
            <select class="form-control col-md-10" name="country" v-model="formValues.country" required>
                <option
                    v-for="(country, i, key) in this.countries"
                    :key="i"
                    :value="i">
                    {{ country }}
                </option>
            </select>
        </div>
        <div class="form-group row">
            <label for="region" class="col-md-2 col-form-label">Provincia</label>
            <input type="region" name="region" class="form-control col-md-4" v-model="formValues.region" required/>
            <label for="cap" class="col-md-2 col-form-label">C.A.P.</label>
            <input type="cap" name="cap" class="form-control col-md-4" v-model="formValues.cap" required/>
        </div>
        <div class="form-group row">
            <label for="city" class="col-md-2 col-form-label">Città</label>
            <input type="city" name="city" class="form-control col-md-10" v-model="formValues.city" required/>
        </div>
        <div class="form-group row">
            <label for="address" class="col-md-2 col-form-label">Indirizzo</label>
            <input type="address" name="address" class="form-control col-md-10" v-model="formValues.address" required/>
        </div>
        <div class="form-group row">
            <label for="address_secondary" class="col-md-2 col-form-label">Aggiuntivo</label>
            <input type="address_secondary" name="address_secondary" class="form-control col-md-10" v-model="formValues.address_secondary"/>
        </div>
        <div class="recaptcha">
            <google-re-captcha-v3
                ref="captcha"
                v-model="form.gRecaptchaResponse"
                :site-key="siteKey"
                :id="'checkout_id'"
                :inline="true"
                :action="'checkout'"/>
        </div>
        <div>
            <button ref="submit" class="btn btn-primary" @click="pay">Vai Al Pagamento</button>
        </div>
    </div>
</template>

<script>
import GoogleReCaptchaV3 from './googlerecaptchav3/GoogleReCaptchaV3.vue'
require('gsap/ScrollToPlugin')

export default {
    name: 'CheckoutModule',
    components: {
        GoogleReCaptchaV3,
    },
    props: {
        isDebug: {
            type: Boolean,
            default: false,
        }
    },
    data: function() {
        return {
            countries: [
                "Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas"
            	,"Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands"
            	,"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica"
            	,"Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea"
            	,"Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana"
            	,"Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India"
            	,"Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia"
            	,"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania"
            	,"Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia"
            	,"New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal"
            	,"Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles"
            	,"Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan"
            	,"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia"
            	,"Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay"
            	,"Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"
            ],
            form: { gRecaptchaResponse: null },
            siteKey: process.env.MIX_RECAPTCHA_KEY,
            formValues: {
                category: 0,
                email: null,
                company_name: null,
                code: null,
                vat: null,
                city: null,
                cap: null,
                region: null,
                address: null,
                country: 94,
                phone: null,
                surname: null,
                name: null,
                address_secondary: null,
            },
            captchaValidation: null,
            offsetY: 0,
            hasErrors: null,
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
        setDebug: function() {
            this.formValues = {
                category: 3,
                email: 'info@simonepozzobon.com',
                company_name: 'Simone Pozzobon',
                code: 'PZZSMN89L28M172V',
                vat: '90585049860954',
                city: 'Salzano',
                cap: '30030',
                region: 'Venezia',
                address: 'Via puccini, 10',
                country: 94,
                phone: '3402967333',
                surname: 'Pozzobon',
                name: 'Simone',
                address_secondary: 'scala 2, interno a',
            }
        },
        init: function() {
            let master = new TimelineMax({
                paused: true
            })

            master.fromTo(this.$refs.form, .6, {
                display: 'none',
                autoAlpha: 0,
            }, {
                display: 'block',
                autoAlpha: 1,
            }, 0)

            master.progress(1).progress(0)

            master.eventCallback('onComplete', () => {
                TweenLite.to(window, .6, {
                    scrollTo: {
                        y: this.$refs.form,
                        autoKill: false,
                        offsetY: this.offsetY
                    }
                })
            })
            master.play()
        },
        verifyHuman: function() {
            return new Promise( (resolve, reject) => {
                let submit = this.$refs.submit
                submit.classList.add('disabled')
                this.$http.post('/api/verify', this.form).then(response => {
                    this.$refs.captcha.execute()
                    this.captchaValidation = response.data
                    resolve(response.data)
                }).catch(err => {
                    this.$refs.captcha.execute()
                    reject(err)
                })
            })

        },
        checkFields: function(isPaying = false) {
            if (isPaying == true) {
                this.hasErrors = false
            } else {
                this.hasErrors = null
            }
            this.$nextTick(() => {
                for (let key in this.formValues) {
                    if (this.formValues.hasOwnProperty(key)) {
                        this.checkField(key, this.formValues[key], isPaying)
                    }
                }
            })
        },
        checkField: function(key, value, isPaying) {
            let element = document.getElementsByName(key)[0]
            let parent = element.parentNode
            let isRequired = element.hasAttribute('required')
            let previous = this.formValues[key]
            let type = element.getAttribute('type')

            element.classList.remove('is-invalid')
            element.classList.remove('is-valid')

            if (isRequired) {
                if (value == 0 || !value) {
                    this.hasErrors = true
                    this.setInvalidField(element, previous, isPaying)
                } else if (type == 'email') {
                    if (this.validateEmail(value)) {
                        this.setValidField(element, previous, isPaying)
                    } else {
                        this.hasErrors = true
                        this.setInvalidField(element, previous, isPaying)
                    }
                }
            } else {
                this.setValidField(element, previous, isPaying)
            }
        },
        validateEmail: function(email) {
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return re.test(String(email).toLowerCase())
        },
        setInvalidField: function(element, previous, isPaying) {
            if (previous != 0 && previous) {
                this.$nextTick(() => {
                    element.classList.add('is-invalid')
                })
            } else if (isPaying) {
                this.$nextTick(() => {
                    element.classList.add('is-invalid')
                })
            }
        },
        setValidField: function(element, previous, isPaying) {
            if (previous != 0 && previous || isPaying) {
                this.$nextTick(() => {
                    element.classList.add('is-valid')
                })
            }
        },
        pay: function() {
            let submit = this.$refs.submit
            let isValid = this.checkFields(true)
            this.$nextTick(() => {
                if (this.hasErrors == false) {
                    this.verifyHuman().then(response => {
                        this.$emit('completed')
                    }).catch(err => {
                        console.error('errore', err);
                    })
                } else {
                    console.log('has errors');
                }
            })
        }
    },
    created: function() {
        this.$watch('formValues', this.checkFields,  {deep: true})
    },
    mounted: function() {
        if (this.$env.debug) {
            this.setDebug()
        }
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';

.checkout-panel {
    padding-top: $spacer * 5;
    opacity: 0;
    display: none;
}

.recaptcha {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: $spacer * 2;
    margin-bottom: $spacer * 2;
}
</style>
