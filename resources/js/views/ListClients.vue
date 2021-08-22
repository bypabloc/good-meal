<template>
    asd
</template>

<script>

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
    },
    methods: {
        getClients(){
            this.fetchingData = true

            client.findAll()
            .then(snap => { 
                console.log('snap',snap)
                
                this.fetchingData = false
                this.validate = true

                const { data } = snap?.data;
                console.log('{ data }',{ data })
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
