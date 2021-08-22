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
    />
</template>

<script>
import TableCustom from '../components/Table.vue'

import Client from '../models/Client'
import CanalMarketing from '../models/CanalMarketing'

const client = new Client()
const canal_marketing = new CanalMarketing()

export const props = {};

export default {
    props,
    data() {
        return {
            fetchingData: false,
            list: [],
        }
    },
    components:{
        TableCustom,
    },
    methods: {
        getClients(){
            this.fetchingData = true

            client.findAll()
            .then(snap => { 
                this.fetchingData = false
                this.validate = true

                const { data } = snap?.data;
                const { list } = data;

                console.log('{ list }',{ list })
                
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
}
</script>
