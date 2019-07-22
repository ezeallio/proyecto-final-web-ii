<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo getBaseAddress(). "DashBoard/inicio"?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Facturaciones para el usuario <?php echo $palabraBuscada ?></li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-header">
                <i class="fas fa-table"></i>
                Facturaciones de mes <?php echo date("m") ?>
            </div>

            <div class="card-body">

                <?php
                        if (!$registroCompras) {
                            echo '<h5 class="text-center text-black-50">El usuario no posee compras a facturar </h5>';
                        }
                        else{
                            echo "<div class='table-responsive'>
                                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                
                
                                        <thead>
                                        <tr class='text-center'>
                                            <th>Nº de Compra</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Total de compra</th>
                                            <th>Total a facturar</th>
                                        </tr>
                                        </thead>
                
                                        <tbody>";

                                        $totalFacturacion = 0;
                                        foreach ($registroCompras as $registroCompra){

                                                $total = ($registroCompra->getPrecioUnitario()*$registroCompra->getCantidad());
                                                $totalFacturacion += (($total*4)/100);
                                                $totalFacturacionPorCompra = (($total*4)/100);

                                                echo '<tr class="text-center">
                                                        <td>' . $registroCompra->getId() . '</td>                                    
                                                        <td>' . $registroCompra->getNombreProducto() . '</td>                                        
                                                        <td>' . $registroCompra->getCantidad() . '</td>
                                                        <td>' .  date("Y-m-d", strtotime($registroCompra->getCompra()->getFechaCompra())). '</td>
                                                        <td>$ ' . $total . '</td>
                                                        <td>$ ' . $totalFacturacionPorCompra . '</td>
                                                    </tr>';
                                        }
                

                         echo'         </tbody>
                
                                    </table>
                
                                    <form method="post" action="'. getBaseAddress() . "DashBoard/generarFacturacion" . '">
                                        <input type="hidden" id="inputVendedorId" name="vendedorId" value="' . $registroCompras[0]->getVendedorId() . '">
                                        <input type="hidden" id="inputTotalFacturacion" name="totalFacturacion" value="'. $totalFacturacion . '">
                                        <input type="hidden" id="inputPalabraBuscada" name="palabraBuscada" value="'.  $palabraBuscada . '">
                                        <button class="btn btn-primary float-right mr-5"><i class="fas fa-money-check mr-2"></i>Generar Facturacion</button>
                                    </form>
                
                                </div>';
                        }
                ?>

            </div>
            <div class="card-footer small text-muted"></div>
        </div>


    </div>
