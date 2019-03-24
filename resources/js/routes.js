const routes = [
    {
        path: '/',
        redirect: '/it',
        initialParams: {
            id: 1,
        },
    },
    {
        path: '/404',
        name: 'error',
        initialParams: {
            id: 2,
        },
        component: require('./views/Error.vue').default,
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
                component: require('./views/Home.vue').default,
                initialParams: {
                    id: 3,
                },
            },
            {
                path: '',
                name: 'home_en',
                component: require('./views/Home.vue').default,
                initialParams: {
                    id: 4,
                },
            },
            {
                path: 'scuolamocajo',
                name: 'scuola',
                component: require('./views/Scuola.vue').default,
            },
            {
                path: 'scuolamocajo',
                name: 'scuola_en',
                component: require('./views/Scuola.vue').default,
                initialParams: {
                    id: 5,
                },
            },
            {
                path: 'storia',
                name: 'storia',
                component: require('./views/Storia.vue').default,
                initialParams: {
                    id: 6,
                },
            },
            {
                path: 'history',
                name: 'storia_en',
                component: require('./views/Storia.vue').default,
                initialParams: {
                    id: 7,
                },
            },
            {
                path: 'vini',
                name: 'vini',
                component: require('./views/Vini.vue').default,
                initialParams: {
                    id: 8,
                },
            },
            {
                path: 'wines',
                name: 'vini_en',
                component: require('./views/Vini.vue').default,
                initialParams: {
                    id: 9,
                },
            },
            {
                path: 'contatti',
                name: 'contatti',
                component: require('./views/Contact.vue').default,
                initialParams: {
                    id: 10,
                },
            },
            {
                path: 'contacts',
                name: 'contatti_en',
                component: require('./views/Contact.vue').default,
                initialParams: {
                    id: 11,
                },
            },
            {
                path: 'carrello',
                name: 'cart',
                component: require('./views/Cart.vue').default,
                initialParams: {
                    id: 12,
                },
            },
            {
                path: 'cart',
                name: 'cart_en',
                component: require('./views/Cart.vue').default,
                initialParams: {
                    id: 13,
                },
            },
            {
                path: 'privacy',
                name: 'privacy',
                component: require('./views/Privacy.vue').default,
                initialParams: {
                    id: 14,
                },
            },
            {
                path: '*',
                name: 'children-error',
                component: require('./views/Error.vue').default,
                initialParams: {
                    id: 15,
                },
            },
        ]
    },
]

export default routes
