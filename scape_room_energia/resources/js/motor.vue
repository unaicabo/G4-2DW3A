<script>
import flecha_down from './components/flecha_down.vue';
import Modal from './components/modal_btn.vue';
import JSConfetti from 'js-confetti'
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';
const jsConfetti = new JSConfetti()

export default {
    name: "motor",
    components: {
        flecha_down,
        Modal,
    },
    data() {
        return {
            img_route: import.meta.env.VITE_APP_URL +"img/motor.png",
            img_route_small: import.meta.env.VITE_APP_URL +"img/motor_small.png",
            img_brujula: import.meta.env.VITE_APP_URL +"img/brujula.png",
            grados : "",
            input_border_red: false,
            input_border_green: false,
            // fallos: 0,
            modal_abrible: true,
            mostrar_mensaje: false,
        };
    },
    methods: {
        comprobar() {
            //si el juego aun no ha sido completado
            if (this.mostrar_mensaje == false) {

                //reiniciamos el estado del imput
                this.input_border_red = false;
                this.input_border_green = false;

                //quitamos el foco al elemento para perder el marco del focus
                document.activeElement.blur();

                //si la respuesta es correcta
                if (this.grados == 315) {

                    //estado del input correcto
                    this.input_border_green = true;
                    this.mostrar_mensaje = true;

                    //audio de respuesta correcta
                    let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Correct-Answer-sound-effect.mp3");
                    snd.play();
                    jsConfetti.addConfetti({
                        confettiColors: [
                            '#ff0000',
                            '#ffff00',
                            '#00ff00',
                            '#0000ff'
                        ],
                        confettiRadius: 10,
                        confettiNumber: 100,
                    })
                    this.fallosStore.completarMotor();
                    this.fallosStore.saveGame();

                } else {

                    //estado del input incorrecto
                    this.input_border_red = true;
                    //aumentamos el numero de fallos
                    this.fallosStore.increaseCount();
                    this.fallosStore.increaseMotor();

                    //audio de respuesta incorrecta
                    let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Incorrect-Answer-sound-effect.mp3");
                    snd.play();

                }
            }
        },
    },
    computed: {
        ...mapStores(useCounterStore),
    },
    mounted() {
        if (this.fallosStore.motor) {
            this.grados = 315;
        }
    },
};
</script>

<template>
    <div class="bg-cover bg-center h-screen flex justify-center">
        <img :src="img_route_small" alt="index" class="sm:hidden w-full pointer-events-none">
        <img :src="img_route" alt="index" class="hidden sm:block w-full pointer-events-none">
        <img src="https://64.media.tumblr.com/28fe099f90cc0e336665baf6dd1b6473/tumblr_nabl83XPqd1r4xsuho1_500.gif" alt="" class="w-full h-full pointer-events-none absolute opacity-40"
            :class="{'!opacity-0': fallosStore.motor}"
        >
        <flecha_down arrow_route="./aerogenerador" class="contents" />
        <Modal header="Orientar Gondola" class="absolute top-56">
            <template v-slot:body>
                <p class="text-center text-md md:text-xl"
                    :class="{'hidden': fallosStore.motor}"
                >
                    Los sistemas automáticos parecen
                    no funcionar y por tanto no consigues
                    orientar la góndola de forma automática,
                    por lo que hay que orientar manualmente el
                    aerogenerador a través de la pantalla
                    táctil que controla el sistema de giro
                    YAW, para obtener el mayor rendimiento
                    en la generación de energía.
                    <br><br>
                    <span class="font-bold">Pista:</span> Para calcular los grados hay que
                    tener en cuenta que el Norte es 0º y que
                    en este momento el viento sopla del
                    sur-oeste.
                </p>
                <br>
                <div class="w-full flex justify-center items-center">
                    <a :href="img_brujula" :class="{'hidden': fallosStore.motor}" target="_blank">
                        <img :src="img_brujula" alt="brujula" class="w-32 hover:scale-150 transform duration-200">
                    </a>
                </div>
                <h1
                    class="flex justify-center text-4xl items-center w-full text-center"
                    :class="{'hidden': !fallosStore.motor}"
                >
                    Aerogenerador arreglado correctamente
                </h1>
            </template>
            <template v-slot:footer>
                <div class="flex justify-center items-center">
                    <input type="number" v-model="grados"
                        @keyup.enter="comprobar"
                        max="360" min="0" step="1"
                        class="bg-gray-50 border-2 mr-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20 p-2.5"
                        :class="{'border-red-500': input_border_red, 'border-green-500': input_border_green, 'pointer-events-none': fallosStore.motor, 'border-green-500': fallosStore.motor}"
                    >
                    <button @click="comprobar"
                        class="flex w-1/3 sm:w-1/5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500"
                        :class="{'hidden': fallosStore.motor}"
                    >
                        Comporbar
                    </button>
                </div>
                <p class="float-right">
                    Fallos: {{ fallosStore.countMotor }}
                </p>
            </template>
        </Modal>
    </div>
</template>
