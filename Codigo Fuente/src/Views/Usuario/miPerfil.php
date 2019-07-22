<div class="container mt-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12">

            <!-- User profile -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xl-5 col-sm-5">
                                <h2>Mi Perfil <i class="fa fa-user  ml-2"></i></h2>
                            </div>
                            <div class="col-xl-7 col-sm-5">
                                <a href="<?php echo getBaseAddress() . 'Usuario/misFacturaciones' ?>" class="btn btn-primary float-right"><i class="fas fa-money-check mr-2"></i>Mis Facturaciones</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- User info -->
            <div class="panel panel-default mt-3">
                <div class="panel-heading">
                    <h4 class="panel-title">Informacion del Usuario</h4>
                </div>
                <div class="panel-body">
                    <table class="table profile__table text-right">
                        <tbody>
                        <tr>
                            <th class="text-left"><strong>Nombre</strong></th>
                            <td><?php echo $usuario["Nombre"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Apellidos</strong></th>
                            <td><?php echo $usuario["Apellido"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Genero</strong></th>
                            <td>
                                <?php
                                if ($usuario["GeneroId"] = 1){
                                    echo "Masculino";
                                }
                                else if ($usuario["GeneroId"] = 2){
                                    echo "Femenino";
                                }
                                else{
                                    echo "Otro";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Fecha de Nacimiento</strong></th>
                            <td><?php echo $usuario["FechaNacimiento"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>CUIT</strong></th>
                            <td><?php echo $usuario["CUIT"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Provincia</strong></th>
                            <td><?php echo ucfirst(strtolower($provincia->getNombre())) ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Partido</strong></th>
                            <td><?php echo ucfirst(strtolower($partido->getNombre())) ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Localidad</strong></th>
                            <td><?php echo ucfirst(strtolower($localidad->getNombre())) ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Calle</strong></th>
                            <td><?php echo $direccion->getCalle() ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Altura</strong></th>
                            <td><?php echo $direccion->getAltura() ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Community -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Comunidad</h4>
                </div>
                <div class="panel-body">
                    <table class="table profile__table text-right">
                        <tbody>
                        <tr>
                            <th class="text-left"><strong>Nombre de Usuario</strong></th>
                            <td><?php echo $usuario["Username"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>E-Mail</strong></th>
                            <td><?php echo $usuario["Email"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Telefono Fijo</strong></th>
                            <td><?php echo $usuario["TelefonoFijo"] ?></td>
                        </tr>
                        <tr>
                            <th class="text-left"><strong>Celular</strong></th>
                            <td><?php echo $usuario["TelefonoCelular"] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

    </div>
</div>