<script>
import Flecha_Left from './components/flecha_left.vue';
import Flecha_Top from './components/flecha_top.vue';

export default {
    name: "aerogenerador",
    components: {
        Flecha_Left,
        Flecha_Top,
    },
    data() {
        return {
            img_route: import.meta.env.VITE_APP_URL +"img/aerogenerador.png",
            img_route_small: import.meta.env.VITE_APP_URL +"img/aerogenerador_small.png",
            isModalVisible: false,
        };
    },
    methods: {
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        }
    },
};
</script>

<template>
    <div class="bg-cover bg-center h-screen flex justify-center mt-16">
        <img :src="img_route_small" alt="index" class="w-full sm:hidden pointer-events-none">
        <img :src="img_route" alt="index" class="w-full hidden sm:block pointer-events-none">
        <Flecha_Left arrow_route="./salaControl" />
        <div class="absolute top-8 mt-16">
            <Flecha_Top class="block w-20 mt-8" arrow_route="./motor" />
        </div>
    </div>
</template>
