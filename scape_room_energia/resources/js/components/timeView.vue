<script>
import { mapStores } from 'pinia'
import { useCounterStore } from '../stores/contadorFallos';
export default {
    name: 'Time',
    props: {
        tiempoRestante: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            horas: 0,
            minutos: 0,
            segundos: 0,
        }
    },
    methods: {
        calcularTiempo() {
            this.segundos--;
            if (this.segundos < 0) {
                this.segundos = 59;
                this.minutos--;
                if (this.minutos < 0) {
                    this.minutos = 59;
                    this.horas--;
                    if (this.horas < 0) {
                        // alert("Se acabó el tiempo")
                        window.location.href = import.meta.env.VITE_APP_URL +"JuegoPerdido";
                    }
                }
            }
        },
        timePass() {
            this.calcularTiempo()
            this.$emit('decrease')
            setTimeout(this.timePass, 1000)
        },
        setTimeDificulty() {
            //execute this function while the dificulty is empty string
            if (this.fallosStore.dificultad == "") {
                setTimeout(this.setTimeDificulty, 500);
            } else {
                switch (this.fallosStore.dificultad) {
                    case 'F':
                        this.fallosStore.setTime(7201)
                        this.horas = 2
                        this.minutos = 0
                        this.segundos = 1
                        break;
                    case 'N':
                        this.fallosStore.setTime(3601)
                        this.horas = 1
                        this.minutos = 0
                        this.segundos = 1
                        break;
                    case 'D':
                        this.fallosStore.setTime(1801)
                        this.horas = 0
                        this.minutos = 30
                        this.segundos = 1
                        break;
                    case 'H':
                        this.fallosStore.setTime(61)
                        this.horas = 0
                        this.minutos = 1
                        this.segundos = 1
                        break;
                    default:
                        break;
                }
                this.timePass()
            }
        }
    },
    mounted() {
        // this.timePass()
        this.setTimeDificulty()
    },
    computed: {
        ...mapStores(useCounterStore),
    },

};
</script>

<style>
.aldrich-regular {
    font-family: "Aldrich", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 2rem;
}
</style>

<template>
    <div>
        <h1 class="m-2 absolute top-1 right-2 text-red-500  text-sm sm:text-2xl md:text-4xl bg-black rounded-md p-2">
            0{{ this.horas }} : <span v-if="this.minutos < 10">0</span>{{ this.minutos }} : <span
                v-if="this.segundos < 10">0</span>{{ this.segundos }}
        </h1>

    </div>
</template>


