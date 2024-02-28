<template>
   <div class="bg-cover bg-center h-screen flex justify-center">
        <img :src="img_route" alt="index" class="size-full pointer-events-none">

        <img :src="img_brillo" @click="showModal" class="absolute top-1/2 end-1/4 ml-5 size-8 sm:size-12 lg:size-20 cursor-pointer">

        <Flecha_Left arrow_route="../roca" />
        <Flecha_Right arrow_route="../" />

        <Modal v-show="isModalVisible" @close="closeModal" @decreaseAlmacen="fallosStore.decreaseAlmacen" @incrementarAlmacen="fallosStore.increaseAlmacen" @incrementar="fallosStore.increaseCount" :fallos="fallosStore.count" @completar="fallosStore.completarAlmacen" :fallosAlmacen="fallosStore.countAlmacen" :intentos="fallosStore.intentosAlmacen"/>

    </div>
</template>

<script>
import Flecha_Right from './components/flecha_right.vue';
import Flecha_Left from './components/flecha_left.vue';
import Modal from './components/modalAlmacen.vue';
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';

    export default {
        name: "almacen",
        components: {
            Modal,
            Flecha_Right,
            Flecha_Left,
        },
        data() {
            return {
                img_route: import.meta.env.VITE_APP_URL +"img/almacen.png",
                img_brillo: import.meta.env.VITE_APP_URL +"img/brillicoDefinitivo.png",
                isModalVisible: false,
            };
        },
        computed: {
            ...mapStores(useCounterStore),
        },
        methods: {
            showModal() {
                if(!this.fallosStore.almacen){
                    this.isModalVisible = true;
                }else{
                    alert("¡Ya has completado esta prueba!")
                }

            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
    }
</script>
