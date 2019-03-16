const routes = [
    {
        path: '/',
        redirect: '/it',
    },
    {
        path: '/:lang',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: '',
                name: 'home',
                component: require('./views/Home.vue'),
            },
            {
                path: 'scuolamocajo',
                name: 'scuola',
                component: require('./views/Scuola.vue'),
            },
            {
                path: 'storia',
                alias: 'history',
                name: 'storia',
                component: require('./views/Storia.vue'),
            },
            {
                path: 'vini',
                alias: 'wines',
                name: 'vini',
                component: require('./views/Vini.vue'),
            },
            {
                path: 'contatti',
                alias: 'contacts',
                name: 'contatti',
                component: require('./views/Contact.vue'),
            },
            {
                path: 'carrello',
                alias: 'cart',
                name: 'cart',
                component: require('./views/Cart.vue'),
            },
            {
                path: 'privacy',
                name: 'privacy',
                component: require('./views/Privacy.vue'),
            }
        ]
    },
    // {
    //     path: '/',
    //     name: 'home',
    //     component: require('./views/Home.vue')
    // },
    // {
    //     path: '/scuolamocajo',
    //     name: 'scuola',
    //     component: require('./views/Scuola.vue')
    // },
    // {
    //     path: '/storia',
    //     name: 'storia',
    //     component: require('./views/Storia.vue')
    // },
    // {
    //     path: '/vini',
    //     name: 'vini',
    //     component: require('./views/Vini.vue')
    // },
    // {
    //     path: '/contatti',
    //     name: 'contatti',
    //     component: require('./views/Contact.vue')
    // },
    // {
    //     path: '/carrello',
    //     name: 'cart',
    //     component: require('./views/Cart.vue')
    // },
    // {
    //     path: '/privacy',
    //     name: 'privacy',
    //     component: require('./views/Privacy.vue')
    // }
]

export default routes
