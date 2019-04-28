import Home from './views/Home.vue'
import HomePage from './views/HomePage.vue'
import ScuolaMocajo from './views/ScuolaMocajo.vue'
import Storia from './views/Storia.vue'
import ViniPagina from './views/ViniPagina.vue'
import Contact from './views/Contact.vue'
import Vini from './views/Vini.vue'
import Negozi from './views/Negozi.vue'
import Ordini from './views/Ordini.vue'
import OrdineSingolo from './views/OrdineSingolo.vue'
import Cities from './views/Cities.vue'
import Corrieri from './views/Corrieri.vue'
import Settings from './views/Settings.vue'
import Privacy from './views/Privacy.vue'
import Error from '../views/Error.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/homepage',
        name: 'homepage',
        component: HomePage,
    },
    {
        path: '/scuola-mocajo',
        name: 'scuola-mocajo',
        component: ScuolaMocajo,
    },
    {
        path: '/storia',
        name: 'storia',
        component: Storia,
    },
    {
        path: '/vini',
        name: 'vini',
        component: ViniPagina,
    },
    {
        path: '/contatti',
        name: 'contatti',
        component: Contact,
    },
    {
        path: '/prodotti',
        name: 'prodotti',
        component: Vini,
    },
    {
        path: '/negozi',
        name: 'negozi',
        component: Negozi,
    },
    {
        path: '/cities',
        name: 'cities',
        component: Cities,
    },
    {
        path: '/ordini',
        name: 'ordini',
        component: Ordini,
    },
    {
        path: '/ordine/:id',
        name: 'ordine',
        component: OrdineSingolo,
    },
    {
        path: '/corrieri',
        name: 'corrieri',
        component: Corrieri,
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings,
    },
    {
        path: '/privacy',
        name: 'privacy',
        component: Privacy,
    },
    {
        path: '/404',
        name: 'error',
        component: Error,
    },
]

export default routes
