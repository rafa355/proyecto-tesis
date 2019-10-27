<template>
    <div data-spy="scroll" data-target=".navbar" data-offset="50">
        <!-- Page Loader -->
        <Loader></Loader>

        <!-- Page Content -->

        <!-- Navigation -->
        <Navigation></Navigation>

        <router-view></router-view>

    </div>
</template>

<script>
    import store from '~/store'

    import Navigation from "~/components/base/Navigation.vue";
    import Loader from "~/components/base/Loader.vue";

    export default {
        components: {
            Navigation,
            Loader,
        },
        mounted() {
            console.log('App Component mounted.')
        },
        created() {

            if(localStorage.token) {
                axios.get('/api/user', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                },
                ).then(response => {
                    this.$store.commit('loginUser')
                }).catch(error => {
                    if (error.response.status === 401 || error.response.status === 403) {
                        this.$store.commit('logoutUser')
                        localStorage.setItem('token', '')
                        this.$router.push({name: 'login'})
                    }

                });
            }

        },

    }
</script>
