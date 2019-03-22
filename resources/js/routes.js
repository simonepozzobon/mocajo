const routes = [
    {
        path: '/',
        redirect: '/it',
    },
    {
        path: '/404',
        name: 'error',
        component: require('./views/Error.vue'),
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
                path: '',
                name: 'home_en',
                component: require('./views/Home.vue'),
            },
            {
                path: 'scuolamocajo',
                name: 'scuola',
                component: require('./views/Scuola.vue'),
            },
            {
                path: 'scuolamocajo',
                name: 'scuola_en',
                component: require('./views/Scuola.vue'),
            },
            {
                path: 'storia',
                name: 'storia',
                component: require('./views/Storia.vue'),
            },
            {
                path: 'history',
                name: 'storia_en',
                component: require('./views/Storia.vue'),
            },
            {
                path: 'vini',
                name: 'vini',
                component: require('./views/Vini.vue'),
            },
            {
                path: 'wines',
                name: 'vini_en',
                component: require('./views/Vini.vue'),
            },
            {
                path: 'contatti',
                name: 'contatti',
                component: require('./views/Contact.vue'),
            },
            {
                path: 'contacts',
                name: 'contatti_en',
                component: require('./views/Contact.vue'),
            },
            {
                path: 'carrello',
                name: 'cart',
                component: require('./views/Cart.vue'),
            },
            {
                path: 'cart',
                name: 'cart_en',
                component: require('./views/Cart.vue'),
            },
            {
                path: 'privacy',
                name: 'privacy',
                component: require('./views/Privacy.vue'),
            },
            {
                path: '*',
                name: 'children-error',
                component: require('./views/Error.vue'),
            },
        ]
    },
]

export default routes
