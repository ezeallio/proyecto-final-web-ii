<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <?php $sessionManejada = unserialize($_SESSION["sessionAdmin"]) ?>

    <a href="<?php echo getBaseAddress() . "DashBoard/inicio" ?>" class="navbar-brand mr-1">
        <img class="img-fluid" id="logo" src="<?php echo getBaseAddress() . "Webroot/img/dashboard/logoDashboard.png" ?>">
    </a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-2x fa-bars"></i>
    </button>

    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar Usuario.." aria-label="Search" aria-describedby="basic-addon2" id="inputUsuarioBuscado" name="usuarioBuscado" required="">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="buscarUsuario">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
        </div>
        <div id="errorUsuarioBuscado" class="errorDashboard"><i class="fas fa-exclamation-triangle"></i> Ingrese un username valido</div>

    </div>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-2x fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Usuario: <?php echo $sessionManejada->getUserName() ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Actividades</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Session</a>
            </div>
        </li>
    </ul>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesion <i class="fas fa-sign-out-alt"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-question-circle"></i> ¿Estas seguro que deseas cerrar sesion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancelar</button>
                    <form action="<?php echo getBaseAddress() . "DashBoard/cerrarSession" ?>" method="post">
                        <button type="submit" class="btn btn-primary">Cerrar Sesion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</nav>

<script src="<?php echo getBaseAddress() . "Webroot/js/shared/dashboard/headerDashboard.js"; ?>"></script>