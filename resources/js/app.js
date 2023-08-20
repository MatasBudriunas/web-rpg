import 'bootstrap/dist/css/bootstrap.css';
import {createApp} from 'vue';
import App from './App.vue';
import store from './store.js';
import './axios-config';
import router from './router.js';

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');
