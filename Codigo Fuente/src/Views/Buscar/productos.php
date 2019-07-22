<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/paginationjs/dist/pagination.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscar.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscarResponsive.css"; ?>">

<script>
    const palabra = "<?php echo $palabra ?>";
    const cantidadProductos = "<?php echo $cantidadProductos ?>";
    var carrito = <?php echo isset($_SESSION["carrito"]) ? json_encode($_SESSION["carrito"]) : json_encode(null); ?>;
</script>

<div class="container product_section_container mt-4">
    <div class="row">
        <div class="col product_section">

            <!-- Main Content -->

            <div class="d-flex flex-column mx-auto justify-content-center">

                <h3 class="pb-3" style="border-bottom: solid 1px">Busquedas por: "<?php echo $palabra ?>"</h3>

                <!-- Products -->

                <div id="divProductosContainer" class="d-flex flex-column justify-content-center align-items-center">

                    <?php
                    if (!$cantidadProductos) {
                        echo '<h5 class="text-center text-black-50">No se ha encontrado ninguna coincidencia con su búsqueda</h5>';
                    }
                    ?>

                </div>

                <!-- Paginator -->
                <div id="paginador" class="d-flex mx-auto justify-content-center align-items-center"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/paginationjs/dist/pagination.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/buscar/buscar.js"; ?>"></script>