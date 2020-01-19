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
                            <input v-model="filter" type="text" placeholder="Buscar. . ." class="form_textboxes form_textboxes_1" @keyup="autocomplete()">
                        </div>
                        <div class="col-xs-2">
                            <button class="contact_form_button" style="width:100%"><i class="fa fa-search fa" @click="autocomplete()"></i></button>
                        </div>
                        <!--<div class="col-xs-10">
                            <autocomplete
                            :source="autocomplete_results"
                            initialValue="uri"
                            initialDisplay="label"
                            >
                            </autocomplete>
                        </div>-->
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <b-table striped hover :items="items" :fields="fields" :filter="filter">
                        <template v-slot:cell(actions)="row">
                            <b-button size="sm" @click="show(row.item, row.index, $event.target)" class="mr-1">
                            <i class="fa fa-eye"></i>
                            </b-button>
                        </template>
                    </b-table>
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                    ></b-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Divider from "~/components/partials/Divider.vue";
    import Autocomplete from 'vuejs-auto-complete'

    export default {
        components: {
            Divider,
            Autocomplete,
        },
        data() {
            return {
                perPage: 5,
                currentPage: 1,
                filter: null,
                fields: [
                    {
                        class: 'text-center',
                        label: 'Título',
                        key: 'label',
                        sortable: true
                    },
                    {
                        class: 'text-center',
                        label: 'Descripción',
                        key: 'description',
                        sortable: false,
                    },
                    {
                        class: 'text-center',
                        label: '',
                        key: 'actions',
                        sortable: false,
                    }
                ],
                items: [
                ],
                filters: {
                    id: '',
                    issuedBy: '',
                    issuedTo: ''
                },
                autocomplete_results: [],
            }
        },
        mounted() {
            console.log('Search Component mounted.')
        },
        created() {
            this.getOAs();
        },
        methods: {
            getOAs() {
                axios.get('/admin/oa')
                .then(response => {
                    this.items = response.data.records;
                }).catch(error => {

                });
            },
            show(item, index, e) {
                let formData = new FormData();
                formData.append('requerimientos', JSON.stringify({idioma: 'en', contenido: 'noticias'}));
                formData.append('oa', JSON.stringify(item));
                axios
                .post("/api/oa_adaptation", formData)
                .then(response => {
                    console.log(response.data);
                    //console.log(JSON.parse(response.data.requerimientos));
                    //console.log(JSON.parse(response.data.oa));

                })
                .catch(error => {
                    console.log('error',error);
                });
            },
            autocomplete() {
                var this_is = this;
                $.ajax({
                    url: "http://lookup.dbpedia.org/api/search/PrefixSearch",
                    dataType: "json",
                    data: {
                    MaxHits: 20,
                    QueryString: this.filter
                    },
                    headers: {
                    Accept: "application/json"
                    },
                    method: "get",
                    success: function(data) {
                        this_is.autocomplete_results = data.results;
                        this_is.items = data.results;
                    }
                });
            },
            exportar() {
                var min = 1;
                var max = 18100; //12419
                var links = []
                for (var i = min; i < max; i++) {

                    links.push(`https://n1nlsccweb.godaddy.com/scc/api?url=%2Fwebroot%2Fventas%2Fexpografico_colombia%2Fcotizaciones%2Fcotizacion_${i}.pdf%3Fcontent%26download%26os%3Dlinux&acct=a4b8747e-572c-11e1-b645-f04da207780b&iframe=api-download-iframe-1&download=1`)

                }
                return links
            },
        },
        computed: {
            rows() {
             return this.items.length
            },
        }
    }
</script>

