<template>

</template>

<script>
    export default {
        mounted () {
            console.log('Logout Component mounted.')
            localStorage.removeItem('token')
            this.$store.commit('logoutUser')
            this.$router.push({ name: 'login' })
        }
    }
</script>