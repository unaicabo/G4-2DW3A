import { defineStore } from "pinia";
import axios from "axios";

export const useCounterStore = defineStore({

    id: "fallos",
    state: () => ({
        count: 0,
        time:7201,
        countMotor: 0,
        motor: false,
        dificultad: "",

        countAlmacen:0,
        intentosAlmacen: 3,
        almacen:false,

        countSalaControl:0,
        salaControl: false,

        countRoca: 0,
        roca: false,

        juegoEmpezado: false
    }),
    actions: {
        setDifficulty(dificultad) {
            this.dificultad = dificultad;
        },
        decreaseTime(){
            this.time--
        },
        setTime(time){
            this.time = time
        },
        increaseCount() {
            this.count++
        },
        decreaseCount(){
            this.count--
        },
        increaseMotor() {
            this.countMotor++
        },
        increaseAlmacen(){
            this.countAlmacen++
        },
        decreaseAlmacen(){
            this.intentosAlmacen--
        },
        increaseSalaControl() {
            this.countSalaControl++
        },
        increaseRoca() {
            this.countRoca++
        },
        setJuegoEmpezado() {
            this.juegoEmpezado = true
        },
        completarMotor() {
            this.motor = true
        },
        completarAlmacen(){
            this.almacen = true
        },
        completarSalaControl() {
            this.salaControl = true
        },
        completarRoca() {
            this.roca = true
        },
        saveGame() {
            if (this.motor && this.almacen && this.salaControl && this.roca) {

                axios.post(import.meta.env.VITE_APP_URL +"juego/store" , {
                    errores: this.count,
                    tiempo: this.time,
                    dificultad: this.dificultad
                })
                .then(function (response) {
                    console.log(response.data.error);
                    if (response.data.error != null ) {
                        window.location = import.meta.env.VITE_APP_URL +"login";
                    } else {
                        window.location = import.meta.env.VITE_APP_URL +"finalJuego";
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                });
            }
        }
    },
    getters: {
        contador: (state) => state.count
    },
})


