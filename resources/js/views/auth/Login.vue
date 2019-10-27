<template>
    <div class="page_content_contact_form page_content_headings" id="page_content_contactus">
        <div class="container">
            <Divider
                title='Identificarse'
                description='Rellene los campos de inicio de sesión a continuación y presione "Ingresar":'
            ></Divider>
            <div class="row">
                <div class="contact_form">
                    <form id="myForm" @submit.prevent="submit">
                        <div class="col-md-4">
                            <input type="email" name="email" placeholder="E-mail" class="form_textboxes form_textboxes_1">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="password" placeholder="Contraseña" class="form_textboxes form_textboxes_1">
                        </div>
                        <button class="contact_form_button ">Ingresar</button>
                    </form>
                </div>
            </div>
            <br>
            <p>¿No tiene un cuenta?</p>
            <router-link :to="{name:'register'}">
                Registrarse
            </router-link>
        </div>
    </div>
</template>

<script>
    import Divider from "~/components/partials/Divider.vue";

    export default {
        components: {
            Divider,
        },
        data() {
            return {
                loginError: false,
            }
        },
        mounted() {
            console.log('Login Component mounted.')
        },
        methods: {
            submit() {
                let myForm = document.getElementById("myForm");
                let formData = new FormData(myForm);
                axios
                .post("/api/auth/login", formData)
                .then(response => {
                    console.log(response.data);
                    console.log("¡Ha iniciado sesión con éxito!");
                    this.$store.commit('loginUser')
                    localStorage.setItem('token', response.data.access_token)
                    this.$router.push({ name: 'search' })
                })
                .catch(error => {
                    // this.errors = error.response.data.errors;
                    // this.laravelErrors = true;
                    this.loginError = true
                });

            },

        }
    }
</script>
