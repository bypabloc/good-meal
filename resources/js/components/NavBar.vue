<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav-custom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            
            <a class="navbar-brand" href="/"><img src="icon.png" alt="GoodMeal"></a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0" v-if="logged">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <div class="d-flex justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/admin">Lista de subcripciones</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" @click="logout">Cerrar sesión</a>
                            </div>
                        </li>
                    </div>
                </ul>
            </form>
            <form class="form-inline my-2 my-lg-0" v-else>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/login">Iniciar sesión</a>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
</template>

<script>
export const props = {};

import User from '../models/User'

const user = new User()

export default {
    props,
    data() {
        return {
            logged: true,
        }
    },
    methods: {
        logout(){

            user.logout()
            .then(snap => { 
                this.logged = false;
                localStorage.removeItem('logged')
                window.location.href = "/";
            })
            .catch(err => {
                if(err?.response){
                    const { response } = err
                    const { data, status } = response

                    console.log('{ response }',{ response })
                    console.log('{ data, status }',{ data, status })

                    switch (status) {
                        case 422:
                            const { errors, message } = data

                            this.$swal({
                                icon: 'error',
                                title: message,
                                html: this.ObjectErrorsToString(errors),
                                willClose: () =>{
                                },
                            });

                            break;
                    
                        default:
                            this.$swal({
                                icon: 'error',
                                title: 'Error no controlado',
                                willClose: () =>{
                                },
                            });

                            break;
                    }
                }
            });
        },
    },
    mounted() {
        this.logged = localStorage.getItem('logged') || false 
    },
}
</script>

<style scoped>
.nav-custom{
    height: 12vh;
}
</style>