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
    }
]

export default routes
