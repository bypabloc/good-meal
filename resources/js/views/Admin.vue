<template>
    <nav-bar/>
    
    <div class="container p-3 my-3 border">
        <list-clients/>
    </div>
    
</template>

<script>
import NavBar from '../components/NavBar'
import ListClients from './ListClients'

export default {
    components: {
        NavBar,
        ListClients,
    },
    methods: {
        info(){
            this.$refs['modal_show'].open();
        },
    },
    created() {
        localStorage.setItem('logged',true)
    },
}
</script>
