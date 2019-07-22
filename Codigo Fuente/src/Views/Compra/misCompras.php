<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/compra/misCompras.css" ?>">

<div class="container mt-3">

    <div class="panel-heading">
        <div class="panel-title pt-3">
            <div class="row">
                <div class="col-xl-5 col-sm-5">
                    <h2>Mis Compras <i class="fa fa-cash-register ml-2"></i></h2>
                </div>
            </div>
        </div>
    </div>

    <div id="divProductosContainer" class="d-flex flex-column justify-content-center align-items-center">
        <?php
        if (!$compras) {
            echo '<h5 class="text-center text-black-50">No tienes compras realizadas</h5>';
        }
        ?>
    </div>

    <?php

        $i = 0;

        foreach($compras as $compra)
        {
            $compraId = $compra->getId();
            $fechaCompra = date("Y-m-d", strtotime($compra->getFechaCompra()));

            echo "<div class='justify-content-center'>
    
                    <div class='col-lg-12 mt-4'>
    
                        <div class='row user-row bg-light w-100 rounded'>
    
                            <div class='col-11 col-md-5 col-lg-7 pt-1'>
                                <strong>Nº de Compra: $compraId</strong><br>
                                <span class='text-muted'>Fecha de Compra: $fechaCompra</span>
                            </div>
    
                            <div class='col-1 col-sm-1 col-md-1 col-lg-5 dropdown-user' data-for='.$compraId'>
                                <i class='fas fa-chevron-down float-right mr-3'></i>
                            </div>
    
                        </div>";
                        
                        while($i < count($comprasProductos) && $compraId == $comprasProductos[$i]->compraId)
                        {
                            $ruta = getBaseAddress() . "Webroot/img/productos/" . $comprasProductos[$i]->nombreImagenPrincipal;
                            $nombreProducto = $comprasProductos[$i]->nombreProducto;
                            $nombreVendedor = $usuarios[$i]->nombre . " " . $usuarios[$i]->apellido;
                            $email = $usuarios[$i]->email;
                            $telefono = $usuarios[$i]->telefono;
                            $cantidad = $comprasProductos[$i]->cantidad;
                            $precio = $comprasProductos[$i]->precioUnitario * $cantidad;
                            $metodo = $comprasProductos[$i]->tipoMetodoEntrega;
                            $detalleEntrega = $comprasProductos[$i]->detalleEntrega;
                            

                            echo "<div class='row my-5 user-infos $compraId'>
                                        <div class='col-md-6 h-100'>
                                            <img src='$ruta'
                                                alt='' class='img-fluid img-rounded shadow w-100 h-100'>
                                        </div>
                                        <div class='col-md-3 ml-md-3 details'>
                                            <blockquote>
                                                <h5>$nombreProducto</h5>
                                                <small><cite title='Source Title'>$nombreVendedor<i
                                                                class='icon-map-marker'></i></cite></small>
                                            </blockquote>
                                            <p>Email: $email</p>
                                            <p>Telefono: $telefono</p>
                                            <p>Metodo: $metodo</p>
                                            <p>Cantidad: $cantidad</p>
                                            <p>Total: $$precio.00</p>";
                                            if($detalleEntrega != "En espera")
                                                echo "<p>Detalle Entrega: $detalleEntrega</p>";
                                        echo "</div>
                            </div>";

                            $i++;
                        }
                   
                echo "</div>
    
                </div>";
        }

    ?>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/compra/misCompras.js" ?>"></script>