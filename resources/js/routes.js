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
]

export default routes
