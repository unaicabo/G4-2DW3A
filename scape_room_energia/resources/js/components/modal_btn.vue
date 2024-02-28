<script>
import Modal from './modal_content.vue';

export default {
    name: 'modal btn',
    data() {
        return {
            isModalVisible: false,
            img_brillo: import.meta.env.VITE_APP_URL +"img/brillicoDefinitivo.png"
        };
    },
    props: {
        header: {
            required: true,
            type: String
        },
    },
    components: {
        Modal,
    },
    methods: {
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        }
    },
};
</script>

<template>
    <div>
        <img :src="img_brillo" class="size-24 sm:size-32 lg:size-24 cursor-pointer" @click="showModal">

        <Modal v-show="isModalVisible" @close="closeModal" :header="header" >
            <template v-slot:body>
                <slot name="body">

                </slot>
            </template>
            <template v-slot:footer>
                <slot name="footer">

                </slot>
            </template>

        </Modal>
    </div>
</template>
