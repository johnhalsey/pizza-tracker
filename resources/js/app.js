import './bootstrap';
import { createApp } from 'vue';
import OrdersList from './components/OrdersList.vue';

createApp({})
    .component('orders-list', OrdersList)
    .mount('#app');
