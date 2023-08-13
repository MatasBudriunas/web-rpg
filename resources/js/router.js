// import { createRouter, createWebHistory } from 'vue-router';
// import AuthForm from './AuthForm.vue';
// import Dashboard from './Dashboard.vue';
//
// const routes = [
//     { path: '/', redirect: '/dashboard' },
//     { path: '/auth', component: AuthForm },
//     { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
// ];
//
// const router = createRouter({
//     history: createWebHistory(),
//     routes
// });
//
// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         const isAuthenticated = !!localStorage.getItem('auth-token');
//         if (!isAuthenticated) {
//             next('/auth');
//         } else {
//             next();
//         }
//     } else {
//         next();
//     }
// });
//
// export default router;
