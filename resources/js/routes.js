import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

Vue.use(VueRouter);

import LoginComponent from './components/LoginComponent';
import DashboardComponent from './components/DashboardComponent';

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/app',
        name: 'app',
        component: DashboardComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/logout',
        name: 'logout'
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' });
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'app' });
        return
    }

    next()
});

export default router