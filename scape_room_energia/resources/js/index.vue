<script>
import Flecha_Right from './components/flecha_right.vue';
import Flecha_Left from './components/flecha_left.vue';
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css";

export default {
    name: "index",
    components: {
        Flecha_Right,
        Flecha_Left,
    },
    data() {
        return {
            img_route: import.meta.env.VITE_APP_URL +"img/index_juego.png",
            img_route_small: import.meta.env.VITE_APP_URL +"img/index_juego_small.png",
        }
    },
    computed: {
        ...mapStores(useCounterStore),
    },
    methods: {
        showInstructions() {
            if (!this.fallosStore.motor) {
                Toastify({
                    text: "¡Debes arreglar el aerogenerador, lo encontraras tras la sala de control!",
                    duration: -1,
                    close: true,
                    gravity: "top",
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    duration: 10000
                }).showToast();
            }

            if (!this.fallosStore.roca) {
                Toastify({
                    text: "¡Debes arreglar los paneles solares, los encontraras en el almacen!",
                    duration: -1,
                    close: true,
                    gravity: "top",
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    duration: 10000
                }).showToast();
            }

            if (!this.fallosStore.juegoEmpezado) {
                Toastify({
                    text: "¡Nos estamos quedando sin tiempo! ¡Debemos encontrar la solución a la crisis energética!",
                    duration: -1,
                    close: true,
                    gravity: "top",
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                }).showToast();
                this.fallosStore.juegoEmpezado = true;
            }

        }
    },
    mounted() {
        this.showInstructions();
    }
};
</script>

<template>
    <div class="bg-cover bg-center h-screen flex justify-center">
        <img :src="img_route_small" alt="roca_fondo_1" class="sm:hidden pointer-events-none w-full" @load="fallosStore.decreaseTime">
        <img :src="img_route" alt="roca_fondo_2" class="hidden sm:block pointer-events-none w-full">

        <Flecha_Left arrow_route="./almacen"/>
        <Flecha_Right arrow_route="./salaControl" />

    </div>
</template>
