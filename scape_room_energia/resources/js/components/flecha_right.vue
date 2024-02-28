<script>
export default {
    name: 'Flecha_Right',
    props: {
        arrow_route: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            arrow_img: import.meta.env.VITE_APP_URL +"img/arrows.png"
        };
    },
};
</script>

<template>
    <!-- <a :href=arrow_route>
        <img :src="arrow_img" alt="arrow" class="absolute right-10 bottom-1/2 w-10 sm:w-16 lg:w-20">
    </a> -->
    <router-link :to=arrow_route>
        <img :src="arrow_img" alt="arrow" class="absolute right-10 bottom-1/2 w-10 sm:w-16 lg:w-20">
    </router-link>
</template>
