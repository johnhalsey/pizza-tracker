<template>
    <div>
        <div v-for="(order, index) in orders"
             :key="'order-' + order.id"
             class="border rounded p-6 mb-6 shadow">
            <div class="flex justify-between w-full">
                <div>
                    <h2 class="font-semibold">#{{ order.order_number }}</h2>
                    {{ order.pizzas.length }} Pizzas in order
                    <div>
                        <span :class="statusColour(order.status)"
                              class="text-white px-3 py-1">{{ order.status }}</span>
                    </div>
                </div>
                <div>
                    <pizza-row v-for="(pizza, index) in order.pizzas"
                               :key="'pizza-' + pizza.id"
                               :pizza="pizza"
                               @updated="fetchOrders"
                    >
                    </pizza-row>
                </div>
            </div>


        </div>
    </div>
</template>

<script>

import axios from 'axios';
import PizzaRow from "./PizzaRow.vue"

export default {
    name: "OrdersList",

    components: {
        PizzaRow
    },

    data () {
        return {
            orders: []
        }
    },

    computed:{

    },

    mounted () {
        this.fetchOrders();
    },

    methods: {
        fetchOrders () {
            axios.get('/api/orders')
                .then(response => {
                    this.orders = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        statusColour (status) {
            switch (status) {
                case 'Pending':
                    return 'bg-yellow-500';
                    break;
                case 'Started':
                    return 'bg-blue-500';
                case 'Ready':
                    return 'bg-green-500';
                    break;
                case 'Complete':
                    return 'bg-purple-500';
                    break;
                default:
                    return 'bg-gray-500';
            }
        }
    }
}
</script>

<style scoped>

</style>
