<template>
    <div class="flex justify-between"
    >
        <div class="p-3">
            <i :class="statusIcon"></i>
        </div>
        <div class="p-3">
            {{ pizza.type }}
        </div>
        <div class="p-3">
            {{ pizza.size }}
        </div>
        <div class="p-3">
            <button v-if="pizza.status !== 'Delivered'"
                    class="bg-lime-500 px-3 py-1 rounded"
                    @click="updateStatus(nextStep.action)"
            >{{ nextStep.label }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "PizzaRow",

    props: {
        pizza: {
            type: Object,
            required: true
        }
    },
    computed: {
        statusIcon () {
            switch (this.pizza.status) {
                case 'Pending':
                    return 'fa-solid fa-clock';
                    break;
                case 'Started':
                    return 'fa-solid fa-utensils';
                    break;
                case 'In the oven':
                    return 'fa-solid fa-fire';
                    break;
                case 'Ready':
                    return 'fa-solid fa-check';
                    break;
                case 'Delivered':
                    return 'fa-solid fa-truck';
                    break;
                default:
                    return 'fa-solid fa-clock';
            }
        },
        nextStep () {
            switch (this.pizza.status) {
                case 'Pending':
                    return {label: 'Start', action: 'started'};
                    break;
                case 'Started':
                    return {label: 'In the oven', action: 'in-oven'};
                    break;
                case 'In the oven':
                    return {label: 'Ready', action: 'ready'};
                    break;
                case 'Ready':
                    return {label: 'Delivered', action: 'delivered'};
                    break;
                default:
                    return {label: 'Start', action: 'started'};
            }
        }
    },
    methods: {
        updateStatus (action) {
            axios.post('/api/pizzas/' + this.pizza.id + '/' + action)
                .then(response => {
                    this.$emit('updated')
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
