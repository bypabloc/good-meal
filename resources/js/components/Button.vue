<template>
    <button 
        @click="clic" 
        :disabled="disabled" 
        type="button" 
        :class="[
            'btn '+( btn[classesNames?.btn] || btn[404] ),
        ]"
    >   
        <div v-if="!loading">
            <i :class="icon"></i>
            {{ text }}
        </div>
        <div v-else class="d-flex justify-content-center align-items-center">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span v-if="text">
                &nbsp;Cargando...
            </span>
        </div>
    </button>
</template>

<script>

export default {
    name: 'Button',
    emits: ['clic'],
    data() {
        return {
            btn: {
                primary: 'btn-primary',
                secondary: 'btn-secondary',
                outLineSecondary: 'btn-outline-secondary',
                success: 'btn-success',
                danger: 'btn-danger',
                warning: 'btn-warning',
                info: 'btn-info',
                default: 'btn-default',
                404: 'btn-default',
            },
        }
    },
    props: {
        text: { 
            type: String,
            default: '',
        },
        icon: { 
            type: String,
            default: 'fas fa-sync-alt',
        },
        classesNames: { 
            type: Object,
            default: {
                btn: 'default',
            },
        },
        loading: { 
            type: Boolean,
            default: false,
        },
        disabled: { 
            type: Boolean,
            default: true,
        },
    },
    methods: {
        clic() {
            this.$emit('clic');
        },
    },
}
</script>
