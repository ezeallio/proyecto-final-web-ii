<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo getBaseAddress(). "DashBoard/inicio"?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ultimos baneados</li>
        </ol>

        <?php

        if (!$baneados){
            echo '<h5 class="text-center text-black-50">No hay usuarios baneados recientemente</h5>';
        }
        else {
            foreach ($baneados as $baneado){
                echo ' <div class="panel panel-default mt-3 border">
                <table class="table table-hover mb-0">
                    <tr>
                        <td>
                            <input type="hidden" id="inputUsuarioId" value="'. $baneado->getId() .'">
                            <span><strong>Username:</strong> ' . $baneado->getUsername() . '</span><br>
                            <span><strong>Facha de Baneo:</strong> ' . $baneado->getFechaBaneo() . '</span><br>                              
                        </td>    
                    </tr>
                </table>
            </div>';

            }
        }

        ?>

    </div>
