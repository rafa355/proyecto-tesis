<template>
    <nav class="navbar  navbar-fixed-top appland_navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link class="navbar-brand scroll" :to="{name:'home'}">
                    <div class="logo">
                        <h2 class="logo">OA</h2>
                    </div>
                </router-link>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <router-link :to="{name:'home'}">
                            Inicio
                        </router-link>
                    </li>
                    <!-- <li>
                        <router-link :to="{name:'profile'}">
                            Perfil
                        </router-link>
                    </li> -->
                    <li v-if="isLoggedIn">
                        <router-link :to="{name:'search'}">
                            Buscador
                        </router-link>
                    </li>
                    <li v-if="!isLoggedIn">
                        <router-link :to="{name:'register'}">
                            Registrarse
                        </router-link>
                    </li>
                    <li v-if="!isLoggedIn">
                        <router-link :to="{name:'login'}">
                            Identificarse
                        </router-link>
                    </li>
                    <li v-if="isLoggedIn">
                        <router-link :to="{ name: 'logout' }">Desconectarse</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>

    export default {
        data() {
            return {
            }
        },
        mounted() {

        },
        computed: {
            isLoggedIn() {
                return this.$store.state.isLoggedIn
            }
        }
    }

</script>

<style>
.logo {
    color: white;
    margin: -5px;
}
</style>