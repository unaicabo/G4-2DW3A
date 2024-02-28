<script>
export default {
    name: 'Modal',
    props: {
        fallos: {
            type: Number,
            required: true,
        },
        fallosAlmacen: {
            type: Number,
            required: true,
        },
        intentos: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            mensaje: '',
            contador: 0,
            caracteresPermitidos: /^[A-Za-z]+$/,
            letrasValidas: ['P','A','N','E','L'],
            letrasRestantes: ['P','A','N','E','L'],
            conjuntoRespuestas: ['','','','',''],
            img_route_I: import.meta.env.VITE_APP_URL +"img/Almacen_I.jpg",
            img_route_A: import.meta.env.VITE_APP_URL +"img/Almacen_A.jpg",
            img_route_Z: import.meta.env.VITE_APP_URL +"img/Almacen_Z.jpg",
            img_route_M: import.meta.env.VITE_APP_URL +"img/Almacen_M.jpg",
            img_route_U: import.meta.env.VITE_APP_URL +"img/Almacen_U.webp",
            img_route_L: import.meta.env.VITE_APP_URL +"img/Almacen_L.jpg",
            img_route_E: import.meta.env.VITE_APP_URL +"img/Almacen_E.jpg",
            img_route_O: import.meta.env.VITE_APP_URL +"img/Almacen_O.jpg",
            img_route_R: import.meta.env.VITE_APP_URL +"img/Almacen_R.webp",
            img_route_S: import.meta.env.VITE_APP_URL +"img/Almacen_S.jpg",
            img_route_P: import.meta.env.VITE_APP_URL +"img/Almacen_P.jpg",
            show: false,
        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        comprobar() {

            for(var i=0;i<5;i++){

                //variable para almacenar cada respuesta
                var respuesta = this.conjuntoRespuestas[i].toUpperCase();

                //Buscamos si la letra introducida es valida, es decir, está dentro del array de letras validas
                if(this.letrasValidas.includes(respuesta)){
                    //Usamos el document.getElementById ya que nos ahorramos generar 15 variables y 35 lineas de codigo (no es broma)
                    if(this.letrasValidas[i]===respuesta){
                        //Si la letra es valida y está en esa posición es correcta se pone verde
                        document.getElementById(i).style.border= "3px solid rgb(64, 211, 6)"
                        var image =document.getElementById(respuesta)
                        if(image){
                            image.classList.add("right")
                        }
                        //Se elimina la letra del array de letras restantes
                        this.letrasRestantes[i] = ""
                    }else{
                        //Si la letra es correcta pero no está en su posicion primero se pone amarilla
                        document.getElementById(i).style.border= "3px solid rgb(197, 211, 6)"
                        var image =document.getElementById(respuesta)
                        if(image){
                            image.classList.add("right")
                        }
                        /**
                         * Buscamos si ha escrito esa misma letra en otra posicion, me explico:
                         *
                         * En un wordle normal, si la palabra correcta es "causa", y se introduce la palabra "salsa", la primera "s" no
                         * se pondrá amarilla aunque sea válida pero no este en su posicion, ya que la palabra "salsa" contiene una segunda
                         * "s" que SI está en la posicion correcta. Si ha introducido la misma letra varias veces, tenemos que marcar solo una vez
                         * la letra como amarilla, o si una de ellas está en la posicion correcta solo se marcará la verde.
                         *
                         * Por eso debemos comprobar si el usuario ha introducido esa misma letra en otra parte de la palabra.
                         */

                        //Si se ha sacado ya la letra en su posicion se pone en rojo directamente
                        if(!this.letrasRestantes.includes(respuesta)){
                            //si la posicion de la letra aun no ha sido encontrada se marca la casilla en amarillo
                            document.getElementById(i).style.border= "3px solid red"
                        }else{
                            //Si no, buscamos la última letra y la ponemos en amarilla
                            for(var j=i+1;j<5;j++){
                                //empezamos en la posicion i ya que buscamos a partir de esta letra
                                if(respuesta===this.conjuntoRespuestas[j].toUpperCase()){
                                //si hay otra letra igual se le pone a ésta el color rojo
                                document.getElementById(i).style.border= "3px solid red"
                                //y a la siguiente la pone en amarillo
                                document.getElementById(j).style.border= "3px solid rgb(197, 211, 6)"
                                break;
                                }
                            }
                        }

                    }
                }else{
                    //Si la letra no es valida se pone rojo
                    document.getElementById(i).style.border= "3px solid red"
                    // Y si existe una foto para esa letra se desactiva
                    var image =document.getElementById(respuesta)
                    if(image){
                        image.classList.add("wrong")
                    }
                }
            }

            //Recorremos el array de las letras restantes para comprobar si nos queda alguna por sacar
            this.contador=0;
            for(var i=0;i<5;i++){
                if(this.letrasRestantes[i]!==""){
                    //En caso de que quede alguna letra en el array añadimos uno al contador
                    this.contador++;
                }
            }

            //Si no queda ninguna letra sin sacar, es decir, el contador de letras restantes es 0
            if(this.contador===0){
                //se saca un mensaje
                this.mensaje = "Felicidades, has acertado todas las letras"

                //audio de respuesta correcta
                let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Correct-Answer-sound-effect.mp3");
                snd.play();

                //Marco el almacen como completado
                this.$emit('completar')

                //Y se cierra el modal
                setTimeout(() => {
                    this.close()
                }, 2000);
            }else{
                //Si no, en caso de tener intentos restantes resta uno
                if(this.intentos>0){
                    this.$emit('decreaseAlmacen')
                }else{
                    //Y en caso de no tenerlos se suma un fallo
                    this.$emit('incrementarAlmacen')
                    this.$emit('incrementar')
                }

                //audio de respuesta incorrecta
                let snd = new Audio(import.meta.env.VITE_APP_URL +"audio/Incorrect-Answer-sound-effect.mp3");
                snd.play();
            }

        },
        focus(event){
            //consigo los elementos
            var element = document.getElementById(event.target.id)
            var previousElement = document.getElementById(Number(element.id)-1)
            var nextElement = document.getElementById(Number(element.id)+1)

            if(event.keyCode===37 && previousElement!==null){
                //Si se ha pulsado la flecha izquierda y siempre y cuando exista un elemento previo, se le hace focus
                previousElement.focus()
            }else if(event.keyCode===39 && nextElement!==null){
                //Si se ha pulsado la flecha derecha y siempre y cuando exista un elemento posterior, se le hace focus
                nextElement.focus()
            }else if(event.keyCode===13){
                //Pulsar enter sería el equivalente a darle a comprobar
                this.comprobar();
            }else if(event.target.value!=="" && event.keyCode>=65 && event.keyCode<=90){
                //Siempre y cuando exista un elemento posterior, se le hace focus
                this.conjuntoRespuestas[element.id]=event.key
                if(nextElement!==null){
                    nextElement.focus()
                }
            }
        },
        control(event){

            if(!this.caracteresPermitidos.test(event.key)){
                event.preventDefault();
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
                        <h1 class="flex justify-center items-baseline text-4xl text-lime-600">
                            Paneles fotovoltaicos
                        </h1>
                    </slot>
                    <button type="button" class="text-2xl font-bold text-gray-500 " @click="close" aria-label="Close modal">
                        X
                    </button>
                </header>

                <section class="modal-body" id="modalDescription">
                    <slot name="body">
                        <p class=" ">
                            Los paneles fotovoltaicos de la instalación
                            del centro han sufrido daños y es necesario
                            reinstalar todo el sistema.

                            Por ello, tendremos que saber cuales son
                            los elementos que necesitamos y donde
                            colocarlos en orden.
                        </p><br>
                        <section class="flex flex-wrap justify-center">
                            <div id="I" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_I" class="size-full"><span class="absolute">I</span></div>
                            <div id="E" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_A" class="size-full"><span class="absolute">E</span></div>
                            <div id="Z" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_Z" class="size-full"><span class="absolute">Z</span></div>
                            <div id="M" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_M" class="size-full"><span class="absolute">M</span></div>
                            <div id="L" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_R" class="size-full"><span class="absolute">L</span></div>
                            <div id="U" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_U" class="size-full"><span class="absolute">U</span></div>
                            <div id="N" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_L" class="size-full"><span class="absolute">N</span></div>
                            <div id="S" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_E" class="size-full"><span class="absolute">S</span></div>
                            <div id="A" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_O" class="size-full"><span class="absolute">A</span></div>
                            <div id="P" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_S" class="size-full"><span class="absolute">P</span></div>
                            <div id="S" class="m-3 xl:w-20 xl:h-20 md:w-18 md:h-18 w-10 h-10 font-bold text-5xl text-white flex justify-center items-center"  style="-webkit-text-stroke-width: 0.1px;-webkit-text-stroke-color: black;"><img :src="img_route_P" class="size-full"><span class="absolute">S</span></div>
                        </section>

                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl w-1/2">Solución:</h1>

                            <button type="button" class="mr-3" @mouseover="how_to_play_show" @mouseleave="how_to_play_hide">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 50 50" fill="none">
                                    <path d="M25 2C12.3093 2 2 12.3093 2 25C2 37.6907 12.3093 48 25 48C37.6907 48 48 37.6907 48 25C48 12.3093 37.6907 2 25 2ZM25 4C36.6098 4 46 13.3902 46 25C46 36.6098 36.6098 46 25 46C13.3902 46 4 36.6098 4 25C4 13.3902 13.3902 4 25 4ZM25 11C24.2044 11 23.4413 11.3161 22.8787 11.8787C22.3161 12.4413 22 13.2044 22 14C22 14.7956 22.3161 15.5587 22.8787 16.1213C23.4413 16.6839 24.2044 17 25 17C25.7956 17 26.5587 16.6839 27.1213 16.1213C27.6839 15.5587 28 14.7956 28 14C28 13.2044 27.6839 12.4413 27.1213 11.8787C26.5587 11.3161 25.7956 11 25 11ZM21 21V23H22H23V36H22H21V38H22H23H27H28H29V36H28H27V21H26H22H21Z" fill="black"/>
                                </svg>
                            </button>
                            <div class="bottom-36 right-2 sm:bottom-32 sm:right-16 absolute inline-block text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-2xl w-80"
                            :class="{'display':show, 'hidden':!show}">
                                <div class="p-3 space-y-2">
                                    <h1 class="font-semibold text-lime-600 text-lg">Como jugar:</h1>
                                    <p class="font-medium text-base"> Cuando se pulse el botón de comprobar la respuesta, los cuadrados cambiarán de color dependiendo de los siguientos factores:
                                            <p class="mt-2">- Si la letra está en la palabra y en la posicion adecuada pasará a ser <span class="text-green-500">verde</span>.</p>
                                            <p class="mt-2">- Si la letra está en la palabra pero NO en su posición se pondrá <span class="text-yellow-500">amarillo</span>.</p>
                                            <p class="mt-2">- En caso de que la letra NO esté en la palabra, el cuadrado pasará a ser <span class="text-red-500">rojo</span> y la foto de dicha letra se oscurecerá.</p>
                                            <p class="mt-2">Tienes 3 intentos para sacar la palabra, despues, por cada intento se te sumará uno al contador de fallos.</p>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="flex justify-center">

                            <div>
                                <input id="0" class="md:w-10 md:h-10 md:text-base w-8 h-8 m-2 text-xs" v-model="conjuntoRespuestas[0]" @keyup="focus" @keypress="control"
                                    maxlength="1" />
                                <input id="1" class="md:w-10 md:h-10 md:text-base w-8 h-8 m-2 text-xs" v-model="conjuntoRespuestas[1]" @keyup="focus" @keypress="control"
                                    maxlength="1" />
                                <input id="2" class="md:w-10 md:h-10 md:text-base w-8 h-8 m-2 text-xs" v-model="conjuntoRespuestas[2]" @keyup="focus" @keypress="control"
                                    maxlength="1" />
                                <input id="3" class="md:w-10 md:h-10 md:text-base w-8 h-8 m-2 text-xs" v-model="conjuntoRespuestas[3]" @keyup="focus" @keypress="control"
                                    maxlength="1" />
                                <input id="4" class="md:w-10 md:h-10 md:text-base w-8 h-8 m-2 text-xs" v-model="conjuntoRespuestas[4]" @keyup="focus" @keypress="control"
                                    maxlength="1" />
                            </div>

                        </div>
                        <div class="flex justify-center">
                            {{ mensaje }}
                        </div>
                    </slot>

                </section>

                <footer class="modal-footer">
                    <slot name="footer">
                        <div class="float-left absolute">
                            <p class="md-text-base text-sm">Intentos: {{ intentos }}</p>
                            <p class="md-text-base text-sm">Fallos: {{ fallosAlmacen }}</p>
                        </div>
                        <div class="flex justify-center">
                            <button
                                class="flex w-1/3 sm:w-1/5 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500"
                                @click="comprobar()">Comprobar</button>
                        </div>
                    </slot>

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

.wrong{
    filter: brightness(50%) !important;
}

.right{
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
