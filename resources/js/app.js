import 'bootstrap/dist/css/bootstrap.css';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import AuthForm from './AuthForm.vue';
import Dashboard from './Dashboard.vue';
import store from './store.js';
import './axios-config';

const routes = [
    { path: '/', redirect: '/dashboard' }, // Redirect / to /dashboard
    { path: '/auth', component: AuthForm },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        const isAuthenticated = !!localStorage.getItem('auth-token');
        if (!isAuthenticated) {
            next('/auth');
        } else {
            next();
        }
    } else {
        next();
    }
});

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');
