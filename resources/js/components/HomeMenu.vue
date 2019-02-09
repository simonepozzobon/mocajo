<template lang="html">
    <div class="home-menu-container" ref="container">
        <ul class="list-unstyled">
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Scuola Mocajo" :to="{ path: '/scuola-mocajo' }" exact-active-class="active">
                    Scuola Mocajo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Storia" :to="{ path: '/la-nostra-storia' }" exact-active-class="active">
                    Storia
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="I Nostri Vini" :to="{ path: '/i-nostri-vini' }" exact-active-class="active">
                    I Nostri Vini
                </router-link>
            </li>
            <li class="nav-item">
                <router-link tag="a" class="nav-link" data-hover="Contatti" :to="{ path: '/contatti' }" exact-active-class="active">
                    Contatti
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'HomeMenu'
}
</script>

<style lang="scss">
@import '~styles/shared';

.home-menu-container {
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
        	-webkit-transition: color 0.3s;
        	-moz-transition: color 0.3s;
        	transition: color 0.3s;
        }

        .nav-link::before,
        .nav-link::after {
        	position: absolute;
        	width: 100%;
        	left: 0;
        	top: 50%;
        	height: 1px;
        	margin-top: -1px;
        	background: rgba($white, 0.5);
        	content: '';
        	z-index: -1;
        	-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
        	transition: transform 0.3s, opacity 0.3s;
        	pointer-events: none;
        }

        .nav-link::before {
        	transform: translateY(-20px);
        }

        .nav-link::after {
        	transform: translateY(20px);
        }

        .nav-link:hover,
        .nav-link:focus {
        	color: #fff;
        }

        .nav-link:hover::before,
        .nav-link:hover::after,
        .nav-link:focus::before,
        .nav-link:focus::after {
        	opacity: 0.7;
        }

        .nav-link:hover::before,
        .nav-link:focus::before {
        	transform: rotate(45deg);
        }

        .nav-link:hover::after,
        .nav-link:focus::after {
        	transform: rotate(-45deg);
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
