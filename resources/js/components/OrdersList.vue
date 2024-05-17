<template>
    <div>

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
