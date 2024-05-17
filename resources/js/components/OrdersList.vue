<template>
    <div>
        <div v-for="(order, index) in orders"
             :key="'order-' + order.id"
             class="border rounded p-6 mb-6 shadow">
            <h2 class="font-semibold">#{{order.order_number}}</h2>
            {{ order.pizzas.length}} Pizzas in order

        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    name: "OrdersList",

    data() {
        return {
            orders: []
        }
    },

    mounted() {
        this.fetchOrders();
    },

    methods: {
        fetchOrders() {
            axios.get('/api/orders')
                .then(response => {
                    this.orders = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
