<template>
    <nav-bar/>
    
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p>This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button" @click="info">Descarga nuestra app</a>
            </p>
        </div>
    </div>

    <info-client
        ref="modal_show"
    />

</template>

<script>
import NavBar from '../components/NavBar'
import InfoClient from './InfoClient'

export default {
    components: {
        NavBar,
        InfoClient,
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
