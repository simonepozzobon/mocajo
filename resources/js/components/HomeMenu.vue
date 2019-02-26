<template lang="html">
    <div class="home-menu-container" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Scuola Mocajo" :to="{ path: '/scuolamocajo' }" exact-active-class="active">
                    {{ this.menu.scuola }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Storia" :to="{ path: '/storia' }" exact-active-class="active">
                    {{ this.menu.storia }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="I Nostri Vini" :to="{ path: '/vini' }" exact-active-class="active">
                    {{ this.menu.vini }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Contatti" :to="{ path: '/contatti' }" exact-active-class="active">
                    {{ this.menu.contatti }}
                </router-link>
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
        }
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
