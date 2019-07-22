<?php
    $cantidad = 0;
    if(isset($_SESSION["carrito"])){
        $cantidad = count($_SESSION["carrito"]);
    }
?>
<!-- Header -->

<header class="cebecera trans_300" id="layoutHeader">

    <!-- Top Navigation -->

    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_nav_left">Bienvenidos Usuarios a ShopLine</div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="top_nav_right">
                        <ul class="top_nav_menu">

                            <!-- Barra con Inicico de Sesion -->

                            <li class="account w-25">
                                <?php

                                $sessionManejada = isset($_SESSION["session"]) ? unserialize($_SESSION["session"]) : null;

                                if (!$sessionManejada) {
                                    echo "<a href='#'>
                                            Cuenta <i class='ml-1 fa fa-angle-down'></i>
                                        </a>
                                        <ul class='account_selection'>
                                            <li><a href='" . getBaseAddress() . 'Seguridad/login' . "'><i class='fas fa-sign-in-alt mr-1'></i>Iniciar Sesion</a></li>
                                            <li><a href='" . getBaseAddress() . 'Seguridad/registrar' . "'><i class='fas fa-edit mr-1'></i></i>Registrarse</a></li>
                                        </ul>";
                                } else {
                                    echo "
                                        <a href='#'>
                                           <i class='fas fa-user mr-1'></i> " . $sessionManejada->getUserName() . "<i class='ml-1 fa fa-angle-down'></i>
                                        </a>
                                        <ul class='account_selection'>
                                            <li><a href='".getBaseAddress(). "Usuario/miPerfil" ."'><i class='far fa-id-badge mr-1'></i></i>Mi Perfil</a></li>
                                            <li><a href='#exampleModal' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-sign-in-alt mr-1'></i>Cerrar Sesion</a></li>
                                        </ul>
                                    ";
                                }

                                ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de navegacion -->

    <div class="main_nav_container">
        <div class="container pb-4">
            <div class="d-flex">
                <div class="col-3 mt-3">
                    <div class="logo_container">
                        <a href="<?php echo getBaseAddress() ?>">
                            <img class="img-fluid" id="logo"
                                 src="<?php echo getBaseAddress() . "Webroot/img/home/logo.png" ?>">
                        </a>
                        <div id="logoResponsiveDiv">
                            <a href="<?php echo getBaseAddress() ?>">
                                <img class="img-fluid" id="logoResponsive"
                                     src="<?php echo getBaseAddress() . "Webroot/img/home/logoResponsive3.png" ?>">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col mt-4">
                    <div class="input-group">
                        <input type="text" id="inputBuscar" class="form-control"
                               placeholder="Buscar...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="btnBuscar" type="button"><i
                                        class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-2 col-lg-4 mt-4">

                    <ul class="navbar_menu mt-2" id="elementosNavegacion">
                        <li class="mr-2"><a href="<?php echo getBaseAddress() . 'Compra/misCompras'; ?>">Compras<i class='fas fa-cash-register ml-1' aria-hidden="true"></i></a></li>
                        <li class="mr-2"><a href="<?php echo getBaseAddress() . 'Productos/misProductos'; ?>">Ventas<i class='fas fa-piggy-bank  ml-1' aria-hidden="true"></i></a></li>
                        <li class="mr-2"><a href="<?php echo getBaseAddress() . 'Carrito/mostrar'; ?>" id="carrito"><div class="contenedorCarrito">Carrito<i class="fa fa-shopping-cart ml-1 mr-2" aria-hidden="true"></i></a><span id="checkout_items" class="checkout_items"><?php echo $cantidad?></span></div></li>
                    </ul>

                    <div class="hamburger_container mt-1 mr-3">
                        <i class="fa fa-2x fa-bars" aria-hidden="true"></i>
                    </div>
                </div>

            </div>

        </div>
    </div>

</header>

<!-- Menu en Hamburguesa -->

<div class="fs_menu_overlay"></div>
<div class="hamburger_menu">
    <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="hamburger_menu_content text-right">
        <ul class="menu_top_nav">
            <li class="menu_item has-children">
                <?php

                if (!$sessionManejada) {
                    echo "<a href='#'>
                             Mi Cuenta <i class='ml-1 fa fa-angle-down'></i>
                          </a>
                          <ul class='menu_selection'>
                              <li><a href='" . getBaseAddress() . 'Seguridad/login' . "'><i class='fas fa-sign-in-alt mr-1'></i>Iniciar Sesion</a></li>
                              <li><a href='" . getBaseAddress() . 'Seguridad/registrar' . "'><i class='fas fa-registered mr-1'></i>Registrarse</a></li>
                          </ul>";
                } else {
                    echo "
                         <a href='#'>
                            <i class='fas fa-user mr-1'></i> " . $sessionManejada->getUserName() . "<i class='ml-1 fa fa-angle-down'></i>
                         </a>
                         <ul class='menu_selection'>
                            <li><a href='#'><i class='far fa-id-badge mr-1'></i></i>Mi Perfil</a></li>
                            <li><a href='#'><i class='fas fa-cash-register mr-1'></i></i></i>Compras</a></li>
                            <li><a href='" . getBaseAddress() . 'Productos/misProductos' . "'><i class='fas fa-piggy-bank mr-1'></i></i></i>Ventas</a></li>
                            <li><a href='#exampleModal' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-sign-in-alt mr-1'></i>Cerrar Sesion</a></li>
                         </ul>";
                }

                ?>
            </li>

            <li class="menu_item"><a href="<?php echo getBaseAddress() ?>"><i class="fas fa-home mr-1"></i>Inicio</a></li>
            <li class="menu_item"><a href="<?php echo getBaseAddress() . 'Carrito/mostrar' ?>" id="carrito"><div class="contenedorCarrito"><i class="fas fa-shopping-cart mr-1" aria-hidden="true"></i><span id="contadorCarritoHamburguesa" class="checkout_items"><?php echo $cantidad ?></span></div>Carrito</a></li>
        </ul>
    </div>
</div>

