<template>
    <nav-bar/>
    
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p>This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Descarga nuestra app</a>
            </p>
        </div>
    </div>
</template>

<script>
import NavBar from '../components/NavBar'

export default {
    components: {
        NavBar,
    },
    mounted() {
        
        $(".jumbotron").css({ height: $(window).height() + "px" });

        $(window).on("resize", function() {
            $(".jumbotron").css({ height: $(window).height() + "px" });
        });

    },
}
</script>
