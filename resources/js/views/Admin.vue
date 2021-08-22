<template>
    <nav-bar-admin/>
    
    <div class="container p-3 my-3 border">
        <list-clients/>
    </div>
    
</template>

<script>
import NavBarAdmin from '../components/NavBarAdmin'
import ListClients from './ListClients'

export default {
    components: {
        NavBarAdmin,
        ListClients,
    },
    methods: {
        info(){
            this.$refs['modal_show'].open();
        },
    },
    mounted() {
        
    },
}
</script>
