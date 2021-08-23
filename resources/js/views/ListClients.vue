<template>
    <table-custom
        :columns="[
            {
                label: 'Nº',
                field: 'id',
            },
            {
                label: 'Email',
                field: 'email',
            },
            {
                label: 'Nombres',
                field: 'names',
            },
            {
                label: 'Número',
                field: 'number',
            },
            {
                label: 'Canal de marketing',
                field: 'canal_marketing',
            },
            {
                label: 'Fecha de Nacimiento',
                field: 'birth_date',
            },
            {
                label: 'Ubicación',
                field: 'location',
            },
            {
                label: 'Observación',
                field: 'observation',
            },
            {
                label: 'Fecha de registro',
                field: 'created_at',
            },
        ]"
        :list="list"
        :per_page="per_page"
        @update="getClients"
    />
</template>

<script>
import TableCustom from '../components/Table.vue'

import Client from '../models/Client'

const client = new Client()

export const props = {};

export default {
    props,
    data() {
        return {
            fetchingData: false,
            list: [],
            page: 1,
            per_page: 10,
        }
    },
    components:{
        TableCustom,
    },
    methods: {
        getClients(args = {}){
            this.fetchingData = true

            this.page = args?.page || this.page
            this.per_page = args?.per_page || this.per_page

            client.findAll({page: this.page, per_page: this.per_page, })
            .then(snap => { 
                this.fetchingData = false
                this.validate = true

                const { data } = snap?.data;
                const { list } = data;
                
                if(list) this.list = list
            })
            .catch(err => {
                if(err?.response){
                    const { response } = err
                    const { data, status } = response

                    switch (status) {
                        case 422:
                            const { errors, message } = data

                            this.$swal({
                                icon: 'error',
                                title: message,
                                html: this.ObjectErrorsToString(errors),
                                willClose: () =>{
                                    this.fetchingData = false
                                },
                            });

                            break;
                    
                        default:
                            this.$swal({
                                icon: 'error',
                                title: 'Error no controlado',
                                willClose: () =>{
                                    this.fetchingData = false
                                },
                            });

                            break;
                    }
                }
            });
        },
    },
    mounted() {
        this.getClients()
    },
    created(){
        const urlParams = new URLSearchParams(window.location.search);

        const page = urlParams.get('page');
        if(page){
            this.page = !isNaN(page) ? parseInt(page) : 5;
        }
        const per_page = urlParams.get('per_page');
        if(per_page){
            this.per_page = !isNaN(per_page) ? parseInt(per_page) : 5;
        }

    },
}
</script>
