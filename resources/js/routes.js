const routes = [
    {
        path: '/',
        redirect: '/it',
    },
    {
        path: '/:lang',
        params: {
            id: 1
        },
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: '',
                name: 'home',
                params: {
                  id: 2,
                },
                component: require('./views/Home.vue'),
            },
            {
                path: 'scuolamocajo',
                name: 'scuola',
                params: {
                  id: 3,
                },
                component: require('./views/Scuola.vue'),
            },
            {
                path: 'storia',
                alias: 'history',
                name: 'storia',
                params: {
                  id: 4,
                },
                component: require('./views/Storia.vue'),
            },
            {
                path: 'vini',
                alias: 'wines',
                name: 'vini',
                params: {
                  id: 5,
                },
                component: require('./views/Vini.vue'),
            },
            {
                path: 'contatti',
                alias: 'contacts',
                name: 'contatti',
                params: {
                  id: 6,
                },
                component: require('./views/Contact.vue'),
            },
            {
                path: 'carrello',
                alias: 'cart',
                name: 'cart',
                params: {
                  id: 7,
                },
                component: require('./views/Cart.vue'),
            },
            {
                path: 'privacy',
                name: 'privacy',
                params: {
                  id: 8,
                },
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
