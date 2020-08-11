export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('./pages/Home.vue'),
        }
    ],
}
