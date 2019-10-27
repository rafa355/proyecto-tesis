const routes = [
    { path: '/', name: 'home', component: require('~/views/home/Home.vue').default },
    { path: '/login', name: 'login', component: require('~/views/auth/Login.vue').default },
    { path: '/register', name: 'register', component: require('~/views/auth/Register.vue').default },
    { path: '/logout', name: 'logout', component: require('~/views/auth/Logout.vue').default, meta: { requiresAuth: true } },
    { path: '/search', name: 'search', component: require('~/views/home/Search.vue').default, meta: { requiresAuth: true } },
]

export default routes