const routes = [
    {
        path: '/',
        name: 'home',
        component: require('./views/Home.vue')
    },
    {
        path: '/scuola-mocajo',
        name: 'scuola',
        component: require('./views/Scuola.vue')
    },
    {
        path: '/la-nostra-storia',
        name: 'storia',
        component: require('./views/Storia.vue')
    },
    {
        path: '/i-nostri-vini',
        name: 'vini',
        component: require('./views/Vini.vue')
    },
    {
        path: '/contatti',
        name: 'contatti',
        component: require('./views/Contact.vue')
    },
    {
        path: '/carrello',
        name: 'cart',
        component: require('./views/Cart.vue')
    },
]

export default routes
