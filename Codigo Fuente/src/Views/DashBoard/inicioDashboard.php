<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo getBaseAddress(). "DashBoard/inicio"?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Inicio</li>
        </ol>

        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col=12 mt-3">
                        <div class="jumbotron ">
                            <h1 class="display-4">Bienvenido a <img class="img-fluid" id="logoResponsive"
                                                                    src="<?php echo getBaseAddress() . "Webroot/img/home/logoSeguridad.png" ?>"></h1>
                            <p class="lead">Bienvenido Administrador al Dashboard de ShopLine, aqui podras administrar el desempeño y funcionamiento del sistema  </p>
                            <hr class="my-4">
                            <p>Busca a todos los usuarios registrados en ShopLine</p>
                            <p class="lead">
                                <button class="btn btn-primary btn-lg" id="btnFocusEnBuscar">Encontrar usuario</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ultimos Baneados</h5>
                                <p class="card-text">Vea los ultimos usuarios baneados</p>
                                <a href="<?php echo getBaseAddress() . "DashBoard/ultimosBaneados" ?>" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Estadisticas</h5>
                                <p class="card-text">Ver todas las estadisticas del flujo de Shopline</p>
                                <a href="<?php echo getBaseAddress() . "DashBoard/estadisticas" ?>"  class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>

<script>
    $( "#btnFocusEnBuscar" ).click(function() {
        $( "#inputUsuarioBuscado" ).focus();
    });
</script>


