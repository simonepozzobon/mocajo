const routes = [
    {
        path: '/',
        name: 'home',
        component: require('./views/Home.vue')
    },
    {
        path: '/homepage',
        name: 'homepage',
        component: require('./views/HomePage.vue')
    },
    {
        path: '/scuola-mocajo',
        name: 'scuolamocajo',
        component: require('./views/ScuolaMocajo.vue')
    },
    {
        path: '/storia',
        name: 'storia',
        component: require('./views/Storia.vue')
    },
    {
        path: '/vini',
        name: 'vini',
        component: require('./views/ViniPagina.vue')
    },
    {
        path: '/contatti',
        name: 'contatti',
        component: require('./views/Contact.vue')
    },
    {
        path: '/prodotti',
        name: 'prodotti',
        component: require('./views/Vini.vue')
    },
    {
        path: '/negozi',
        name: 'negozi',
        component: require('./views/Negozi.vue')
    },
    {
        path: '/cities',
        name: 'cities',
        component: require('./views/Cities.vue')
    },
    {
        path: '/corrieri',
        name: 'corrieri',
        component: require('./views/Corrieri.vue')
    },
    {
        path: '/settings',
        name: 'settings',
        component: require('./views/Settings.vue')
    },
    {
        path: '/privacy',
        name: 'privacy',
        component: require('./views/Privacy.vue')
    },
]

export default routes
