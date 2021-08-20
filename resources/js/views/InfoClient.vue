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
            <h5 class="modal-title font-weight-bold">Ver</h5>
        </template>
        <template v-slot:body>
            
        </template>
    </modal>
</template>

<script>

import Modal from '../components/Modal'

export const props = {};

export default {
    props,
    data() {
        return {
            form: null,
        }
    },
    components:{
        Modal,
    },
    methods: {
        open() {
            this.$refs.modal.open({
                backdrop: 'static',
                keyboard: false, 
            });
        },
    },
}
</script>
