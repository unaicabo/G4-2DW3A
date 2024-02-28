<script>
export default {
    name: 'Flecha_Top',
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
        <img :src="arrow_img" alt="arrow" class="absolute top-0 rotate-[270deg] w-10 sm:w-16 lg:w-20 mt-8">
    </a> -->
    <router-link :to=arrow_route>
        <img :src="arrow_img" alt="arrow" class="absolute top-0 rotate-[270deg] w-10 sm:w-16 lg:w-20 mt-8">
    </router-link>

</template>
