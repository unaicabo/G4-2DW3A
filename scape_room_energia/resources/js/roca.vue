<template>
    <div class="bg-cover bg-center h-screen flex justify-center">

        <img :src="img_route" alt="index" class="sm:hidden pointer-events-none w-full">
        <img :src="img_route_small" alt="index" class="hidden sm:block pointer-events-none w-full">

        <Flecha_Right arrow_route="../almacen" />
        <Modal header="Códigos de la Roca" class="size-24 sm:size-32 lg:size-24
        absolute bottom-16 sm:bottom-8 left-0 sm:left-22 lg:left-32" v-if="fallosStore.almacen">
            <template v-slot:body>
                <h1 class="text-4xl text-center" :class="{'hidden':!this.fallosStore.roca}">
                    Has arreglado los paneles fotovoltaicos.
                </h1>
                <div :class="{'hidden':this.fallosStore.roca}">
                    <p class="text-center text-base sm:text-lg pb-4">
                        Ahora que tenemos todos los elementos
                        de la instalación, necesitamos buscar cuál
                        será la inclinación y la orientación
                        de los paneles.
                    </p>
                    <div class="grid grid-cols-3">
                        <!-- Girar Roca -->
                        <div>
                            <img :src="rocaImg" alt="roca" class="w-28 h-20 sm:w-36 sm:h-32 lg:w-48"
                            :style="base" :class="{'roca-0':anim_roca0, 'roca-180':anim_roca180}">
                            <button
                                class="sm:ml-6 lg:ml-8 sm:w-18 lg:w-24 rounded-md bg-gray-300 px-3 py-1.5 font-semibold
                                text-black hover:bg-gray-400" @click="girar">Girar Roca
                            </button>
                        </div>
                        <!-- Inputs de las letras -->
                        <div class="grid grid-cols-5" :class="{'display':rocaBack, 'hidden':rocaFront}">
                            <div>
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="A: 6">
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="F: 2">
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="K: 19">
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="O: 24">
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="T: 3">
                            </div>
                            <div>
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="B: 10">
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="G: 7">
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="L: 1">
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="P: 12">
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="U: 16">
                            </div>
                            <div>
                                <input class="roca-letras ml-11 lg:ml-16" type="text" disabled placeholder="C: 4">
                                <input class="roca-letras ml-11 lg:ml-16" type="text" disabled placeholder="H: 8">
                                <input class="roca-letras ml-11 lg:ml-16" type="text" disabled placeholder="M: 17">
                                <input class="roca-letras ml-11 lg:ml-16" type="text" disabled placeholder="Q: 14">
                                <input class="roca-letras ml-11 lg:ml-16" type="text" disabled placeholder="V: 23">
                            </div>
                            <div>
                                <input class="roca-letras ml-16 lg:ml-20" type="text" disabled placeholder="D: 5">
                                <input class="roca-letras ml-16 lg:ml-20" type="text" disabled placeholder="I: 9">
                                <input class="roca-letras ml-16 lg:ml-20" type="text" disabled placeholder="N: 18">
                                <input class="roca-letras ml-16 lg:ml-20" type="text" disabled placeholder="R: 21">
                                <input class="roca-letras ml-16 lg:ml-20" type="text" disabled placeholder="W: 13">
                            </div>
                            <div>
                                <input class="roca-letras ml-20 lg:ml-24" type="text" disabled placeholder="E: 11">
                                <input class="roca-letras ml-20 lg:ml-24" type="text" disabled placeholder="J: 15">
                                <input class="roca-letras ml-20 lg:ml-24" type="text" disabled placeholder="Ñ: 26">
                                <input class="roca-letras ml-20 lg:ml-24" type="text" disabled placeholder="S: 25">
                                <input class="roca-letras ml-20 lg:ml-24" type="text" disabled placeholder="X: 22">
                            </div>
                                <input class="roca-letras ml-1 lg:ml-8" type="text" disabled placeholder="Y: 0">
                                <input class="roca-letras ml-6 lg:ml-12" type="text" disabled placeholder="Z: 20">
                        </div>
                        <!-- Inputs de los símbolos -->
                        <div class="grid grid-cols-2" :class="{'display':rocaFront, 'hidden':rocaBack}">
                            <div>
                                <input class="roca-symbols ml-4 lg:ml-6" type="text" disabled placeholder="λ: μ.У">
                                <input class="roca-symbols ml-4 lg:ml-6" type="text" disabled placeholder="〆: α.⦽">
                                <input class="roca-symbols ml-4 lg:ml-6" type="text" disabled placeholder="Φ: α.β">
                                <input class="roca-symbols ml-4 lg:ml-6" type="text" disabled placeholder="↭: 〄.〷">
                            </div>
                            <div>
                                <input class="roca-symbols ml-10 lg:ml-16" type="text" disabled placeholder="Թ: Ւ.ը">
                                <input class="roca-symbols ml-10 lg:ml-16" type="text" disabled placeholder="Ω: r.の">
                                <input class="roca-symbols ml-10 lg:ml-16" type="text" disabled placeholder="၉: μ.β">
                                <input class="roca-symbols ml-10 lg:ml-16" type="text" disabled placeholder="@: ә.የ">
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template v-slot:footer>
                <div :class="{'hidden':fallosStore.roca}">
                    <!-- Botón de Información -->
                    <div class="flex justify-end">
                        <button type="button" class="mr-2 mb-4 sm:float-right sm:absolute"
                        @mouseover="how_to_play_show" @mouseleave="how_to_play_hide">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 50 50" fill="none">
                                <path d="M25 2C12.3093 2 2 12.3093 2 25C2 37.6907 12.3093 48 25 48C37.6907 48 48 37.6907 48 25C48 12.3093 37.6907 2 25 2ZM25 4C36.6098 4 46 13.3902 46 25C46 36.6098 36.6098 46 25 46C13.3902 46 4 36.6098 4 25C4 13.3902 13.3902 4 25 4ZM25 11C24.2044 11 23.4413 11.3161 22.8787 11.8787C22.3161 12.4413 22 13.2044 22 14C22 14.7956 22.3161 15.5587 22.8787 16.1213C23.4413 16.6839 24.2044 17 25 17C25.7956 17 26.5587 16.6839 27.1213 16.1213C27.6839 15.5587 28 14.7956 28 14C28 13.2044 27.6839 12.4413 27.1213 11.8787C26.5587 11.3161 25.7956 11 25 11ZM21 21V23H22H23V36H22H21V38H22H23H27H28H29V36H28H27V21H26H22H21Z" fill="black"/>
                            </svg>
                        </button>
                        <div class="absolute inline-block text-sm text-gray-500 duration-300 bg-white border border-gray-200 rounded-lg shadow-2xl w-64 sm:w-80"
                        :class="{'display':show, 'hidden':!show, 'bottom-52 sm:bottom-44':!pista, 'bottom-64 sm:bottom-56':pista}">
                            <div class="p-3 space-y-2">
                                <h1 class="font-semibold text-lime-600 text-lg">Como jugar:</h1>
                                <p class="mt-2 font-medium text-base">
                                    - Para saber cuáles serán estos dos datos,
                                    debemos de saber el símbolo de la latitud.
                                </p>
                                <p class="mt-2 font-medium text-base">
                                    - Detrás de la roca, tenemos unos números asociados a cada símbolo,
                                    una vez sepamos cuál es nuestro símbolo, debemos de saber qué significan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Menu de solución -->
                    <div class="flex justify-center pb-2">
                        <p class="px-2 text-sm sm:text-base">Orientación:</p>
                        <input type="number" v-model="resp1" max="999" min="0"
                        class="w-32 h-6 sm:h-8 border-none bg-[#C2E28C] focus:bg-green-100" @keyup.enter="comprobar"
                        :class="{'bg-red-500': resp1Wrong, 'focus:bg-red-100': resp1Wrong}">
                    </div>
                    <div class="flex justify-center pb-2">
                        <p class="px-2 text-sm sm:text-base">Inclinación:</p>
                        <input type="number" v-model="resp2" max="999" min="0"
                        class="w-32 h-6 sm:h-8 border-none bg-[#C2E28C] focus:bg-green-100" @keyup.enter="comprobar"
                        :class="{'bg-red-500': resp2Wrong, 'focus:bg-red-100': resp2Wrong}">
                    </div>
                    <div class="flex justify-center mt-2">
                        <button
                            class="w-1/3 sm:w-1/5 rounded-md bg-lime-500 px-3 py-1.5 font-semibold
                            text-white hover:bg-lime-600" @click="comprobar">Comprobar
                        </button>
                    </div>
                </div>
                <!-- Fallos -->
                <p class="float-right">
                    Fallos: {{ fallosStore.countRoca }}
                </p>
                <!-- Pista -->
                <div>
                    <button class="text-white mb-3 me-4 bg-lime-700 hover:bg-lime-800 font-semibold rounded-lg text-sm sm:text-base px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                    :class="{'hidden': !pista}" type="button" @click="hint">
                        Pista
                    </button>
                    <div class="bottom-6 absolute inline-block text-sm text-gray-500 duration-300 bg-white border border-gray-200 rounded-lg shadow-2xl w-40 sm:w-56 lg:w-72"
                    :class="{'display':show_hint, 'hidden':!show_hint}">
                        <div class="p-3 space-y-2">
                            <h3 class="bg-white border-b font-semibold text-gray-900 text-base">Pista</h3>
                            <p class="mt-2 font-medium text-base">
                                El valor es la suma de las letras que forman la palabra del los símbolos.
                            </p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>

            </template>
        </Modal>

        <img :src="img_brillo" class="size-24 sm:size-32 lg:size-24
        absolute bottom-16 sm:bottom-8 left-0 sm:left-22 lg:left-32 cursor-pointer"  @click="missing" v-else>

    </div>
</template>

<style>
/* La roca gira de 180deg a 0deg */
.roca-0 {
    animation-name: roca-0;
    animation-duration: 3s;
}

@keyframes roca-0 {
    from {
        transform: rotateY(180deg)
    }
    to {
        transform: rotateY(0deg)
    }
}
/* La roca gira de 0deg a 180deg */
.roca-180 {
    animation-name: roca-180;
    animation-duration: 3s;
}

@keyframes roca-180 {
    from {
        transform: rotateY(0deg)
    }
    to {
        transform: rotateY(180deg)
    }
}
</style>

<script>
import Flecha_Right from './components/flecha_right.vue';
import Modal from './components/modal_btn.vue';
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';

import JSConfetti from 'js-confetti'
const jsConfetti = new JSConfetti()

    export default {
        name: "roca",
        components: {
            Flecha_Right,
            Modal
        },
        data() {
            return {
                img_route: import.meta.env.VITE_APP_URL +'img/roca_movil.png',
                img_route_small: import.meta.env.VITE_APP_URL +'img/roca_ordenador.png',
                img_brillo: import.meta.env.VITE_APP_URL +'img/brillicoDefinitivo.png',
                rocaImg: import.meta.env.VITE_APP_URL +'img/roca.png',

                anim_roca0: false,
                anim_roca180: false,

                base: '',
                roca0: 'transform: rotateY(180deg)',
                roca180: 'transform: rotateY(0deg)',

                rocaFront: true,
                rocaBack: false,

                resp1: '',
                resp2: '',
                resp1Wrong: false,
                resp2Wrong: false,

                pista: false,

                show: false,
                show_hint: false,
            };
        },
        computed: {
            ...mapStores(useCounterStore),
        },
        methods: {
            girar() {
                // si la imagen de la roca esta de frente
                // la gira 180 grados
                if (this.base == '' || this.base == this.roca180) {
                    this.base = this.roca0
                    this.anim_roca0 = false
                    this.anim_roca180 = true
                    // si no
                    // la vuelve a la posición inicial
                } else {
                    this.base = this.roca180
                    this.anim_roca0 = true
                    this.anim_roca180 = false
                }

                // Para que cambien los Inputs de los símbolos y las letras al girar la roca
                this.rocaFront = !this.rocaFront
                this.rocaBack = !this.rocaBack
            },
            comprobar() {
                // si la Orientación no es '15'
                // te cambia el color del input
                if (this.resp1 != 15) {
                    this.resp1Wrong = true
                } else {
                    this.resp1Wrong = false
                }

                // si la Inclinación no es '30'
                // te cambia el color del input
                if (this.resp2 != 30) {
                    this.resp2Wrong = true
                } else {
                    this.resp2Wrong = false
                }

                // si la Orientación y la Inclinación es correcta
                // se esconden los Inputs y te pone un audio y un mensaje de que has superado la prueba
                if (this.resp1 == 15 && this.resp2 == 30) {
                    this.fallosStore.completarRoca()
                    this.fallosStore.saveGame();
                    let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Correct-Answer-sound-effect.mp3");
                    snd.play();
                    // Confeti
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
                    // si no
                    // se suma un fallo y te pone un audio de que has fallado en la respuesta
                } else {
                    this.fallosStore.increaseRoca();
                    this.fallosStore.increaseCount();
                    let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Incorrect-Answer-sound-effect.mp3");
                    snd.play();
                }

                // si se hacen mas de 4 fallos
                // se mostrara una pista
                if (this.fallosStore.countRoca > 4) {
                    this.pista = true;
                } else {
                    this.pista = false;
                }
            },
            // Te muestra el menu de como jugar
            how_to_play_show() {
                this.show = true
            },
            // Te esconde el menu de como jugar
            how_to_play_hide() {
                this.show = false
            },
            // Te muestra el menu de la pista
            hint() {
                this.show_hint = !this.show_hint
            },
            // Si no has completado el almacén te saldrá este mensaje
            missing() {
                alert("Son necesarios los códigos del almacén")
            }
        }
    }
</script>
