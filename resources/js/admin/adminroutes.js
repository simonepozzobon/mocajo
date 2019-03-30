const routes = [
    {
        path: '/',
        name: 'home',
        component: require('./views/Home.vue').default,
    },
    {
        path: '/homepage',
        name: 'homepage',
        component: require('./views/HomePage.vue').default,
    },
    {
        path: '/scuola-mocajo',
        name: 'scuolamocajo',
        component: require('./views/ScuolaMocajo.vue').default,
    },
    {
        path: '/storia',
        name: 'storia',
        component: require('./views/Storia.vue').default,
    },
    {
        path: '/vini',
        name: 'vini',
        component: require('./views/ViniPagina.vue').default,
    },
    {
        path: '/contatti',
        name: 'contatti',
        component: require('./views/Contact.vue').default,
    },
    {
        path: '/prodotti',
        name: 'prodotti',
        component: require('./views/Vini.vue').default,
    },
    {
        path: '/negozi',
        name: 'negozi',
        component: require('./views/Negozi.vue').default,
    },
    {
        path: '/cities',
        name: 'cities',
        component: require('./views/Cities.vue').default,
    },
    {
        path: '/corrieri',
        name: 'corrieri',
        component: require('./views/Corrieri.vue').default,
    },
    {
        path: '/settings',
        name: 'settings',
        component: require('./views/Settings.vue').default,
    },
    {
        path: '/privacy',
        name: 'privacy',
        component: require('./views/Privacy.vue').default,
    },
    {
        path: '/404',
        name: 'error',
        component: require('./views/Error.vue').default,
    },
]

export default routes
