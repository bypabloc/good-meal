<template>
    <nav-bar/>
    
    <div class="jumbotron jumbotron-fluid jumbotron-custom">
        <div class="container container-custom">
            <h1 class="display-4">GoodMeal</h1>
            <p>
                Unete ahora y salva al planeta, el cambio empieza por ti.
                Con nuestra gran variedad de productos a bajo costo ahorrarás hasta un 66% en tus gastos de comida, 
            </p>
            <p class="lead btn-custom">
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
}
</script>

<style scoped>
*{
    box-sizing: border-box;
    margin: 0px;
    padding: 0px;
}
.jumbotron-custom{
    height: 88vh !important;
    margin-bottom: 0px;
    position: relative;
}
.container-custom{
    background-color: rgba(234, 92, 163, 0.651);
    border-radius: 5px;
    left: 3.5rem;
    padding: 1.5rem;
    position: absolute;
    top: 3.5rem; 
    width: 460px;
}
.container-custom p{
    margin-top: 15px;
    text-align: justify;
}
.container-custom .btn-custom a{
    background:white;
    border: 0px;
    border: 1px solid white;
    color:  rgba(234, 92, 163);
    font-weight: 600;
    margin-left: 50%;
    padding: 5px 10px;
    transform: translateX(-50%);
    transition: all 0.3s ease;
}
.container-custom .btn-custom a:hover{
    background-color:  rgba(234, 92, 163);
    color: white;
    font-weight: 600;
}
</style>