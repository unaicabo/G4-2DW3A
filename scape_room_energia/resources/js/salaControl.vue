
<template>
    <div id="salaControl" class="bg-cover bg-center h-screen flex justify-center">
        <img :src="img_route" alt="sala_control" class="w-full pointer-events-none">
        <img :src="img_brillo" @click="showModal" class="absolute top-1/2 ml-8 size-8 sm:size-12 lg:size-20 cursor-pointer">
        <Flecha_Left arrow_route="./" />
        <!-- {{ this.fallosStore.count }} -->
        <div :class="{ 'hidden': ! fallosStore.salaControl }">
            <Flecha_Right arrow_route="./aerogenerador" />
        </div>
        <Modal v-show="isModalVisible" @close="closeModal" @completada="change_completed" @incrementar="fallosStore.increaseCount" :fallos="fallosStore.count" @incrementarSalaControl="fallosStore.increaseSalaControl" :fallosSalaControl="fallosStore.countSalaControl" @completarSalaControl="fallosStore.completarSalaControl"  />
    </div>
</template>

<script>
import Modal from './components/ModalSalaControl.vue';
import Flecha_Right from './components/flecha_right.vue';
import Flecha_Left from './components/flecha_left.vue';
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';

export default {
    name: 'SalaControl',
    components: {
        Modal,
        Flecha_Right,
        Flecha_Left,

    },

    data() {
        return {
            isModalVisible: false,
            title: "Prueba 3",
            descripcion: "Debido al ataque los sistemas de bloqueo del aerogenerador que tiene el centro se han activado y por eso no podemos aprovechar la energía que produce. Lo primero que necesitamos es  desbloquearlo y para ello, tendremos que encontrar el código de 3 letras que activa el desbloqueo. Pista: El código está formado por las iniciales de las 3 partes que forman el rotor de un aerogenerador(en orden alfabetico)",
            img_route: import.meta.env.VITE_APP_URL +"img/salaControl.png",
            img_brillo: import.meta.env.VITE_APP_URL +"img/brillicoDefinitivo.png",
            completada: false,

        };
    },
    computed: {
        ...mapStores(useCounterStore),
    },
    methods: {

        showModal() {
            if (!this.fallosStore.salaControl) {
                this.isModalVisible = true;
            } else {
                alert("Ya has realizado la prueba");
            }
        },
        closeModal() {
            this.isModalVisible = false;
        },
        change_completed() {
            this.completada = true;
        }
    }
};
</script>
