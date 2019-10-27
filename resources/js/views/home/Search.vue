<template>
    <div class="page_content_contact_form page_content_headings" id="page_content_contactus">
        <div class="container">
            <Divider
                title='Buscador'
                description='Usa palabras clave para realizar tu consulta:'
            ></Divider>
            <!-- <a v-for="(e, index) in exportar()" :key="index" :href="e"></a> -->
            <div class="row">
                <div class="contact_form col-xs-12">
                    <form class="row">
                        <div class="col-xs-10">
                            <input type="text" placeholder="Buscar. . ." class="form_textboxes form_textboxes_1">
                        </div>
                        <div class="col-xs-2">
                            <button class="contact_form_button" style="width:100%"><i class="fa fa-search fa"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <b-table striped hover :items="items"></b-table>
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
        data() {
            return {
                items: [
                { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                { age: 38, first_name: 'Jami', last_name: 'Carney' }
                ]
            }
        },
        mounted() {
            console.log('Search Component mounted.')
        },
        methods: {
            exportar() {
                var min = 12419;
                var max = 15195; //12419
                var links = []
                for (var i = min; i < max; i++) {
                    links.push(`https://n1nlsccweb.godaddy.com/scc/api?url=%2Fwebroot%2Fventas%2Fexpografico_colombia_dev%2Fcotizaciones%2Fcotizacion_${i}.pdf%3Fcontent%26download%26os%3Dlinux&acct=a4b8747e-572c-11e1-b645-f04da207780b&iframe=api-download-iframe-15&download=1`)
                }
                return links
            },
        }
    }
</script>

