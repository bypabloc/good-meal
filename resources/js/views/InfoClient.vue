<template>
    <modal
        ref="modal"
        :custom="{
            bg: {
                'header': 'primary',
            },
            size: 'full',
        }"
        @close="reset"
    >
        <template v-slot:title>
            <h5 class="modal-title font-weight-bold">Información</h5>
        </template>
        <template v-slot:body>
            <form>
                <div
                    v-if="
                        (!validate)
                        &&
                        (!exist)
                    "
                >
                    <div class="form-group">
                        <label for="formGroupExampleInput">Indicanos tu correo para enviarte notificaciones que te ayudarán a mantenerte informado</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Correo" 
                                aria-label="Correo" 
                                aria-describedby="button-addon2" 
                                v-model="form.email"
                            >
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
                </div>

                <div
                    v-if="
                        (validate)
                        &&
                        (!exist)
                    "
                >
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <label for="formGroupExampleInput">{{ form.email }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombres</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.names"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.number"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">¿Donde te enteraste de nosotros?</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="form-control" v-model="form.canal_marketing">
                                    <option v-for="option in canal_marketing" :value="option.id" :key="option.id">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
                        <div class="col-sm-10">
                            <input
                                type="date"
                                class="form-control"
                                v-model="form.birth_date"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Ubicación</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.location"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">¿Quieres decirnos algo mas?</label>
                        <div class="col-sm-10">
                            <textarea
                                class="form-control"
                                v-model="form.observation"
                            >
                            </textarea>
                        </div>
                    </div>
                </div>

                <div
                    v-if="
                        (validate)
                        &&
                        (exist)
                    "
                >
                    <div class="form-group">
                        <label for="formGroupExampleInput">¡Genial!</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <a class="btn btn-primary btn-lg" href="https://play.google.com/store/apps/details?id=com.goodmealspa.goodmeal&hl=es_419&gl=US" role="button" target="_blank">Descarga nuestra app</a>
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template 
            v-slot:actions
            v-if="
                (validate)
                &&
                (!exist)
            "
        >
            <button-custom
                @clic="newClient"
                :classesNames="{
                    btn: 'primary',
                }" 
                text="Unirse" 
                icon="" 
                :loading="fetchingData" 
                :disabled="fetchingData" 
            />
        </template>
    </modal>
</template>

<script>

import Modal from '../components/Modal.vue'
import ButtonCustom from '../components/Button.vue'

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
            form: client,
            canal_marketing: canal_marketing.findAll(),
            exist: false,
            validate: false,
        }
    },
    components:{
        Modal,
        ButtonCustom,
    },
    methods: {
        checkEmail(){
            this.fetchingData = true

            client.checkEmail()
            .then(snap => { 
                console.log('snap',snap)
                
                this.fetchingData = false
                this.validate = true

                const { data } = snap?.data;
                const { exist } = data;
                console.log('exist',exist)

                this.exist = exist
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
        newClient(){
            this.fetchingData = true

            client.save()
            .then(snap => { 
                console.log('snap',snap)
                
                this.fetchingData = false
                this.validate = true

                const { data } = snap?.data;
                const { exist } = data;

                this.exist = exist
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
        reset(){
            client.clear();
            this.form = client
            this.exist = false;
            this.validate = false;
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
