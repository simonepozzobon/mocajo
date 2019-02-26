<template lang="html">
    <div class="custom-file">
        <input @change="filesChange($event.target.name, $event.target.files)" type="file" class="form-control-file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" ref="input">
        <div class="valid-feedback">
            {{ successMessage }}
        </div>
        <div class="invalid-feedback">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'FileInput',
    props: {
        format: {
            type: String,
            default: null,
        },
    },
    data: function() {
        return {
            errorMessage: null,
            successMessage: null,
        }
    },
    methods: {
        filesChange: function(fieldName, filesList) {
            let file = filesList[0]
            let name = file.name

            // prendo l'estensione dal nome del file
            let re = /(?:\.([^.]+))?$/
            let ext = re.exec(name)[1]

            if (ext == this.format) {
                // assegno il file alla variabile per il form
                this.$emit('file-loaded', file)

                // segno il file come corretto
                this.setValid('Formato file corretto, ora puoi salvare')
                return false
            }

            this.setInvalid('Formato del file sbagliato, solo '+this.format)
            return false
        },
        setInvalid: function(message) {
            this.errorMessage = message

            let el = this.$refs.input
            el.classList.remove('is-valid')
            el.classList.add('is-invalid')
        },
        setValid: function(message) {
            this.successMessage = message

            let el = this.$refs.input
            el.classList.remove('is-invalid')
            el.classList.add('is-valid')
        },
        clearFeeback: function() {
            let el = this.$refs.input
            el.classList.remove('is-invalid')
            el.classList.remove('is-valid')

            this.errorMessage = null
            this.successMessage = null
        },
    }
}
</script>

<style lang="css" scoped>
</style>
