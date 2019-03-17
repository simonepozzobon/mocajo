<template lang="html">
    <div class="home-menu-container" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <a href="#" class="nav-link" data-hover="Scuola Mocajo" @click="goTo($event, 'scuola')">
                    {{ this.menu.scuola }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-hover="Storia" @click="goTo($event, 'storia')">
                    {{ this.menu.storia }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-hover="I Nostri Vini" @click="goTo($event, 'vini')">
                    {{ this.menu.vini }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-hover="Contatti" @click="goTo($event, 'contatti')">
                    {{ this.menu.contatti }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'HomeMenu',
    watch: {
        '$root.options': function(options) {
            this.setOptions(options.menu)
        }
    },
    data: function() {
        return {
            menu: {
                scuola: null,
                storia: null,
                vini: null,
                contatti: null,
            }
        }
    },
    methods: {
        setOptions: function(section) {
            this.menu = section
        },
        goTo: function(event, name) {
            event.preventDefault()
            this.$router.push({name: name, params: {lang: this.$root.locale}})
        },
    },
    mounted: function() {
        if (this.$root.options) {
            this.setOptions(this.$root.options.menu)
        }

    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.home-menu-container {
    @include media-breakpoint-down('xs') {
        display: none;
    }

    .nav-link {
    	position: relative;
    	display: inline-block;
    	margin: 15px 25px;
    	outline: none;
    	text-decoration: none;
    	letter-spacing: 1px;
    	text-shadow: 0 0 1px rgba(255,255,255,0.3);
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: $white;
    }

    .nav-link:hover,
    .nav-link:focus {
    	outline: none;
    }

    ul {
    	position: relative;
    	z-index: 1;

        .nav-link {
        	padding: 0 5px;
        	transition: color 0.3s;

            &::before,
            &::after {
                position: absolute;
            	width: 100px;  // cambiare qui per dimensioni fissa
            	left: 50%;
            	top: 50%;
            	height: 1px;
            	margin-top: -1px;
            	background: rgba($white, 0);
            	content: '';
            	z-index: -1;
            	transition: $transition-base;
            	pointer-events: none;
            }

            &::before {
                transform: translate(-50%, -20px);
            }

            &::after {
                transform: translate(-50%, 20px);
            }

            &:hover, &:focus {
                color: $white;
                transition: $transition-base;

                &::before,
                &::after {
                    background-color: rgba($white, 0.5);
                }

                &::before {
                    transform: translate(-50%, 0px) rotate(45deg);
                }

                &::after {
                    transform: translate(-50%, 0px) rotate(-45deg);
                }
            }
        }

        li {
            display: inline-block;

            .nav-link {
                &:hover {
                    color: $primary;
                }
            }
        }
    }
}
</style>
