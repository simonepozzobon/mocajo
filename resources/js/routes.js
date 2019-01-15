const routes = [
    {
        path: '/',
        name: 'home',
        component: require('./views/Home.vue')
    },
    {
        path: '/about',
        name: 'about',
        component: require('./views/About.vue')
    },
    {
        path: '/vini',
        name: 'vini',
        component: require('./views/Vini.vue')
    },
    {
        path: '/carrello',
        name: 'cart',
        component: require('./views/Cart.vue')
    },
]

export default routes
