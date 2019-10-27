<template>
    <div>
        <!-- Page Content Slider -->
        <Slider v-if="isLoggedIn" :btn="btnAuth"></Slider>
        <Slider v-else :btn="btnNotAuth"></Slider>
    </div>
</template>

<script>

    import Slider from "~/components/base/Slider.vue";

    export default {
        components: {
            Slider,
        },
        data() {
            return {
                btnNotAuth: [
                    {name: "Registrarse", to: "register"},
                    {name: "Identificarse", to: "login"},
                ],
                btnAuth: [
                    {name: "Buscador", to: "search"},
                ]
            }
        },
        mounted() {
            console.log('Home Component mounted.')
        },
        computed: {
            isLoggedIn() {
                return this.$store.state.isLoggedIn
            }
        }
    }
</script>