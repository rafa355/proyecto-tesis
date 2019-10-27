<template>
    <div class="page_content_contact_form page_content_headings" id="page_content_contactus">
        <div class="container">
            <Divider
                title='Registrarse'
                description='Rellene los campos de registro a continuación y presione "Enviar":'
            ></Divider>
            <div class="row">
                <div class="contact_form">
                    <form id="myForm" @submit.prevent="submit">
                        <div class="col-md-6">
                            <input type="text" name="name" placeholder="Nombre" class="form_textboxes form_textboxes_1">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" placeholder="E-mail" class="form_textboxes form_textboxes_1">
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password" placeholder="Contraseña" class="form_textboxes form_textboxes_1">
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password-confirm" placeholder="Confirmación de Contraseña" class="form_textboxes form_textboxes_1">
                        </div>
                        <!-- <div class="col-xs-12">
                            <textarea placeholder="Leave a Message" class="form_textboxes form_textboxes_2"></textarea>
                        </div> -->
                        <button class="contact_form_button ">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Divider from "~/components/partials/Divider.vue";

    export default {
        components: {
            Divider,
        },
        mounted() {
            console.log('Register Component mounted.')
        },
        methods: {
            submit() {
                let myForm = document.getElementById("myForm");
                let formData = new FormData(myForm);
                axios
                .post("/api/auth/register", formData)
                .then(response => {
                    console.log(response.data);
                    console.log("¡Se ha registrado con éxito!");
                    this.$router.push({ name: 'login' })
                })
                .catch(error => {
                    // this.errors = error.response.data.errors;
                    // this.laravelErrors = true;
                });

            },
        }
    }
</script>
