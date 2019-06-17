const IconsDefault = {
    props: {
        size: {
            type: String,
            default: '32px'
        },
        color: {
            type: String,
            default: '#000000'
        },
        useVariables: {
            type: Boolean,
            default: false,
        },
        hasPointer: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        colorClass: function() {
            if (this.useVariables) {
                let color = getComputedStyle(document.documentElement).getPropertyValue('--'+this.color)
                return color
            }
            return this.color
        },
        pointerClass: function() {
            if (this.hasPointer) {
                return 'ui-icon--pointer'
            }
        }
    },
}

export default IconsDefault
