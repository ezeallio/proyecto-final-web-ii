<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title pt-3">
                <div class="row">
                    <div class="col-xl-5 col-sm-5">
                        <h2>Mis Facturaciones <i class="fas fa-money-check ml-2"></i></h2>
                    </div>
                </div>
            </div>
        </div>

        <ul class="list-group mt-3">

            <div id="divProductosContainer" class="d-flex flex-column justify-content-center align-items-center">
                <?php
                if (!$facturaciones) {
                    echo '<h5 class="text-center text-black-50">No tienes facturaciones </h5>';
                }
                ?>
            </div>

            <?php

            foreach ($facturaciones as $facturacion) {

                echo '<li class="list-group-item rounded mt-3">
                                <div class="row toggle" id="dropdown-detail-1" onclick="cambiarDireccionFlecha(this)" data-toggle="' . $facturacion->getId() . '">
                                <div class="col-7 col-lg-7 col-xs-12">
                                    Numero de Facturacion: ' . $facturacion->getId() . '
                                </div>
                                <div class="col-5 col-sm-1 col-md-1 col-lg-5 dropdown-user">
                                    <i class="fas fa-chevron-down float-right"></i>
                                </div>
                            </div>
                            <div id="' . $facturacion->getId() . '" class="factu-info ' . $facturacion->getId() . ' "> 
                            <hr></hr>                              
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <strong>Mes:</strong> ' . $facturacion->getMes() . '<br>     
                                            <strong>Año:</strong> ' . $facturacion->getAnio() . '<br>     
                                            <strong>Total:</strong> $' . $facturacion->getTotal() . '<br>                                       
                                        </div>                                                                         
                                    </div>
                                </div>
                            </div>
                            </li>';

            }

            ?>
        </ul>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/usuario/misFacturaciones.js"; ?>"></script>
