<template>
    <modal
        ref="modal"
        :custom="{
            bg: {
                'header': 'primary',
            },
            size: 'full',
        }"
    >
        <template v-slot:title>
            <h5 class="modal-title font-weight-bold">Información</h5>
        </template>
        <template v-slot:body>
            <form>
                <div class="form-group">
                    <label for="formGroupExampleInput">Indicanos tu correo para enviarte notificaciones que te ayudarán a mantenerte informado</label>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Correo" aria-label="Correo" aria-describedby="button-addon2" v-model="email">
                        <div class="input-group-append">
                            <button-custom
                                @clic="checkEmail"
                                :classesNames="{
                                    btn: 'outLineSecondary',
                                }" 
                                text="Susbrirse" 
                                icon="" 
                                :loading="fetchingData" 
                                :disabled="fetchingData" 
                            />
                        </div>
                    </div>
                </div>
            </form>
            {{ email }}
        </template>
    </modal>
</template>

<script>

import Modal from '../components/Modal.vue'
import ButtonCustom from '../components/Button.vue'

import ObjectErrorsToString from '../functions/ObjectErrorsToString'

export const props = {};

export default {
    props,
    data() {
        return {
            fetchingData: false,
            email: null,
        }
    },
    components:{
        Modal,
        ButtonCustom,
    },
    methods: {
        checkEmail(){
            this.fetchingData = true

            axios.post(
                `subcribirse/check_email`,
                {
                    email: this.email,
                },
            )
            .then(snap => { 
                console.log('snap',snap)

                // const  { data }  = snap?.data;
                // const  { validate }  = data;
                // console.log('validate',validate)
            })
            .catch(err => {
                console.log('err',err)
                if(err?.response){
                    const { response } = err
                    console.log('response',response)

                    const { data, status } = response
                    console.log('data',data)

                    switch (status) {
                        case 422:
                            const { errors, message } = data

                            this.$swal({
                                icon: 'error',
                                title: message,
                                html: ObjectErrorsToString(errors),
                            });

                            break;
                    
                        default:
                            alert('Error no controlado');

                            break;
                    }
                }
            })
            .finally(()=>{
                this.fetchingData = false
            });
        },
        open() {
            this.$refs.modal.open({
                backdrop: 'static',
                keyboard: false, 
            });
        },
    },
}
</script>
