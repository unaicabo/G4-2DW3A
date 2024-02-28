<template>
    <div>
        <Time @decrease="fallosStore.decreaseTime" :tiempoRestante="fallosStore.time"></Time>
        <router-view></router-view>
    </div>

</template>

<script>
import { mapStores } from 'pinia'
import { useCounterStore } from './stores/contadorFallos';
import Time from './components/timeView.vue';

    // const userStore = useCounterStore();

    export default {
        name: "App",
        components:{
            Time
        },
        data() {
            return {
                message: "Hello World",
            };
        },
        mounted() {
            this.fallosStore.setDifficulty(document.getElementById("dificultad").value);
            this.$router.push({ path: "/" });
        },
        computed: {
            ...mapStores(useCounterStore),
        }
    }
</script>
