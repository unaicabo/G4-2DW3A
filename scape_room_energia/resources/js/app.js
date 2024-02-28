import './bootstrap';
import 'flowbite';
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import { createRouter, createWebHistory } from 'vue-router'

import App from './App.vue'
import salaControl from './salaControl.vue'
import almacen from './almacen.vue'
import roca from './roca.vue'
import index from './index.vue'
import aerogenerador from './aerogenerador.vue'
import motor from './motor.vue'
import Alpine from 'alpinejs';
import { useCounterStore } from "./stores/contadorFallos";

// console.log(document.getElementById('dificultad').value);

const pinia = createPinia();

window.Alpine = Alpine;

Alpine.start();

const routes = [
    { path: '/', component: index },
    { path: '/salaControl', component: salaControl },
    { path: '/almacen', component: almacen },
    { path: '/roca', component: roca },
    { path: '/aerogenerador', component: aerogenerador },
    { path: '/motor', component: motor },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)

app.use(router)
app.use(pinia)

app.mount('#app')

const storeCounter = useCounterStore()
