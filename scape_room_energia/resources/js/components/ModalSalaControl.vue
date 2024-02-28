<script>
export default {
    name: 'Modal',
    props: {
        fallos: {
            type: Number,
            required: true,
        },
        fallosSalaControl: {
            type: Number,
            required: true,
        },


    },
    data() {
        return {
            respuesta1: '',
            respuesta1Correcta: false,
            respuesta1Incorrecta: false,
            respuesta2: '',
            respuesta2Correcta: false,
            respuesta2Incorrecta: false,
            respuesta3: '',
            respuesta3Correcta: false,
            respuesta3Incorrecta: false,
            mensaje: '',
            // contador: '',
            aparecerPista: false,
            desaparecerPista: true,
            caracteresPermitidos: /^[A-Za-z]+$/,
            // solucion1: "",

            // solucion2: "",
            // solucion3: "",
            // correcto: "2px solid green",
            // incorrecto: "2px solid red",
            show_hint: false,
        }

    },
    methods: {
        close() {
            this.$emit('close');
        },
        completada() {
            this.$emit('completada');
            this.$emit('completarSalaControl');

        },
        // comprobar() {
        //     if (this.solucion1.toUpperCase() == "B") {
        //         //cambia el color del borde del input usando b-bind

        // this.respuesta1.style.border = "2px solid green";
        //         alert("Correcto");
        //     }
        //     else {
        //         this.solucion1 = this.incorrecto;
        //         alert("Incorrecto, la respuesta correcta es B");
        //     }
        //     if (this.solucion2.toUpperCase() == "C") {
        //         alert("Correcto");
        //     }
        //     else {
        //         alert("Incorrecto, la respuesta correcta es C");
        //     }
        //     if (this.solucion3.toUpperCase() == "P") {
        //         alert("Correcto");
        //     }
        //     else {
        //         alert("Incorrecto, la respuesta correcta es P");
        //     }

        // }
        // verificarRespuesta1() {
        //     this.respuesta1Correcta = this.respuesta1.toUpperCase() === 'B';

        // },
        // verificarRespuesta2() {
        //     this.respuesta2Correcta = this.respuesta2.toUpperCase() === 'C';

        // },
        // verificarRespuesta3() {
        //     this.respuesta3Correcta = this.respuesta3.toUpperCase() === 'P';

        // },
        incrementarFallo() {
            this.$emit('incrementar');
            this.$emit('incrementarSalaControl');

        },
        comprobar() {
            if (this.respuesta1.toUpperCase() === 'B') {
                this.respuesta1Incorrecta = false;
                this.respuesta1Correcta = true;
            } else {
                this.respuesta1Incorrecta = true;
                this.respuesta1Correcta = false;
            }
            if (this.respuesta2.toUpperCase() === 'C') {
                this.respuesta2Incorrecta = false;
                this.respuesta2Correcta = true;
            } else {
                this.respuesta2Incorrecta = true;
                this.respuesta2Correcta = false;
            }
            if (this.respuesta3.toUpperCase() === 'P') {
                this.respuesta3Incorrecta = false;
                this.respuesta3Correcta = true;
            } else {
                this.respuesta3Incorrecta = true;
                this.respuesta3Correcta = false;
            }

            if (this.respuesta1Correcta && this.respuesta2Correcta && this.respuesta3Correcta) {
                this.mensaje = "Felicidades, has acertado las 3";
                this.completada();

                //audio de respuesta correcta
                let snd = new Audio(import.meta.env.VITE_APP_URL + "public/audio/Correct-Answer-sound-effect.mp3");
                snd.play();

                setTimeout(() => {
                    this.close()
                }, 2000);

            }
            else {
                // this.contador++
                this.incrementarFallo()
                let snd = new Audio(import.meta.env.VITE_APP_URL + "public/audio/Incorrect-Answer-sound-effect.mp3");
                snd.play();

            }

            if (this.fallosSalaControl > 3) {
                this.aparecerPista = true;
                this.desaparecerPista = false
            } else {
                this.aparecerPista = false;
                this.desaparecerPista = true
            }
            // comprobar() {
            //     if (this.respuesta1.toUpperCase() == 'B' && this.respuesta2.toUpperCase() == 'C' && this.respuesta3.toUpperCase() == 'P') {
            //         //     // alert("felicidades");

            //         this.mensaje = "Felicidades, has acertado las 3";

            //         //     // this.respuesta2Correcta == true;
            //         //     // this.respuesta3Correcta == true;



            //         setTimeout(() => {
            //             this.close()
            //         }, 2000);


            //     }
            // else {
            //     // alert("no lo has hecho bien");
            //     this.mensaje = "No te preocupes, sigue intentandolo."
            //     this.contador++
            //     // this.respuesta1Incorrecta = this.respuesta1 !== '' && this.respuesta1Correcta;
            //     // this.respuesta2Incorrecta = this.respuesta2 !== '' && this.respuesta2Correcta;
            //     // this.respuesta3Incorrecta = this.respuesta3 !== '' && this.respuesta3Correcta;


            // }





        },
        focus(event) {
            //consigo los elementos
            var element = document.getElementById(event.target.id)
            var previousElement = document.getElementById(Number(element.id) - 1)
            var nextElement = document.getElementById(Number(element.id) + 1)

            if (event.keyCode === 37 && previousElement !== null) {
                //Si se ha pulsado la flecha izquierda y siempre y cuando exista un elemento previo, se le hace focus
                previousElement.focus()
            } else if (event.keyCode === 39 && nextElement !== null) {
                //Si se ha pulsado la flecha derecha y siempre y cuando exista un elemento posterior, se le hace focus
                nextElement.focus()
            } else if (event.keyCode === 13) {
                //Pulsar enter sería el equivalente a darle a comprobar
                this.comprobar();
            } else if (this.caracteresPermitidos.test(event.key) && event.target.value !== "" && nextElement !== null && event.keyCode !== 9 && event.keyCode !== 16) {
                //Siempre y cuando exista un elemento posterior, se le hace focus
                nextElement.focus()
            }
        },
        control(event) {

            if (!this.caracteresPermitidos.test(event.key)) {
                event.preventDefault();
            }

        },
        // Te muestra el menu de la pista
        hint() {
            this.show_hint = !this.show_hint
        },


    },
};
</script>

<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="relative transform rounded-lg bg-white text-left shadow-2xl transition-all sm:my-8 w-full m-10 md:w-1/2 lg:w-1/2"
                role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
                <header class="modal-header" id="modalTitle">
                    <slot name="header">
                        <h1 class="flex justify-center text-4xl text-lime-600">
                            Prueba 3
                        </h1>
                    </slot>
                    <button type="button" class="text-2xl font-bold text-gray-500 " @click="close" aria-label="Close modal">
                        X
                    </button>
                </header>

                <section class="modal-body" id="modalDescription">
                    <slot name="body">
                        <p class="flex justify-self-center text-xl ">
                            Debido al ataque los sistemas de bloqueo del aerogenerador que tiene el centro se han activado y
                            por eso no podemos aprovechar la energía que produce. Lo primero que necesitamos es
                            desbloquearlo y para ello, tendremos que encontrar el código de 3 letras que activa el
                            desbloqueo.
                            El código está formado por las iniciales de las 3 partes que forman el rotor de un
                            aerogenerador.
                        </p><br>
                        <h1 class="text-2xl">Solución:</h1><br>

                        <div class="flex justify-center">

                            <!-- <input class="w-10 m-2" type="text" v-model="solucion1"
                                v-bind:style="{ border:[correcto,incorrecto] }"
                                maxlength="1">


                            <input class="w-10 m-2" type="text" v-model="solucion2"
                                v-bind:style="{ border: solucion2.toUpperCase() === 'C' ? '2px solid green' : '2px solid red' }"
                                maxlength="1">


                            <input class="w-10 m-2" type="text" v-model="solucion3"
                                v-bind:style="{ border: solucion3.toUpperCase() === 'P' ? '2px solid green' : '2px solid red' }"
                                maxlength="1"> -->

                            <form class="form-control">
                                <input id="0" class="w-10 m-2 focus:outline-none focus:outline-width-0" v-model="respuesta1"
                                    :class="{ 'border-green': respuesta1Correcta, 'border-red': respuesta1Incorrecta }"
                                    maxlength="1" @keyup="focus" @keypress="control" />
                                <input id="1" class="w-10 m-2 focus:outline-none " v-model="respuesta2"
                                    :class="{ 'border-green': respuesta2Correcta, 'border-red': respuesta2Incorrecta }"
                                    maxlength="1" @keyup="focus" @keypress="control" />
                                <input id="2" class="w-10 m-2 focus:outline-none " v-model="respuesta3"
                                    :class="{ 'border-green': respuesta3Correcta, 'border-red': respuesta3Incorrecta }"
                                    maxlength="1" @keyup="focus" @keypress="control" />
                            </form>

                            <!--
                            <input v-bind="solucion1" v-model="solucion1" class="w-10 m-2" type="text" id="inputSolucion1"
                                maxlength="1">
                            <input v-model="solucion2" class="w-10 m-2" type="text" id="solucion2" maxlength="1">
                            <input v-model="solucion3" class="w-10 m-2" type="text" id="solucion3" maxlength="1"> -->


                        </div>
                        <div class="flex justify-center">
                            {{ mensaje }}
                        </div>
                    </slot>
                </section>

                <footer class="modal-footer">
                    <slot name="footer">
                        <div class="flex justify-center">
                            <button
                                class="flex w-1/3 sm:w-1/5 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500"
                                @click="comprobar()">Comprobar</button>
                        </div>
                    </slot>
                    <div>
                        <h4>Fallos: {{ this.fallosSalaControl }} </h4>

                        <button :class="{ 'display': aparecerPista, 'hidden': desaparecerPista }"
                            class="text-white mb-3 me-4 bg-lime-700 hover:bg-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                            type="button" @click="hint">Pista</button>
                        <div data-popover id="popover-bottom" role="tooltip"
                            :class="{ 'display': show_hint, 'hidden': !show_hint }"
                            class="bottom-6 absolute inline-block w-64 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="px-3 py-2 bg-white border-b text-gray-900 rounded-t-lg">
                                <h3 class="font-semibold text-gray-900">Pista</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p> Esta en orden alfabetico</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </transition>
</template>

<style>
.border-green {
    border: 3px solid rgb(64, 211, 6);
}

.border-red {
    border: 3px solid red;
}

.border-yellow {
    border: 3px solid rgb(197, 211, 6);
}

.wrong {
    filter: brightness(50%) !important;
}

.right {
    border: 3px solid rgb(64, 211, 6);
}

.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #4AAE9B;
    justify-content: space-between;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}

.btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
}

.modal-fade-enter,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity .5s ease;
}
</style>
