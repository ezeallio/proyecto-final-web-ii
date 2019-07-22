<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/paginationjs/dist/pagination.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/misProductos.css" ?>">

<script>
    const cantidadProductos = "<?php echo $cantidadProductos; ?>";
</script>
<div class="container mt-3">

    <div class="panel-heading">
        <div class="panel-title pt-3">
            <div class="row">
                <div class="col-xl-5 col-sm-5">
                    <h2>Mis Ventas<i class="fa fa-piggy-bank ml-2"></i></h2>
                </div>
                <div class="col-xl-7 col-sm-5">
                    <a href="<?php echo getBaseAddress() . 'Productos/agregarProducto' ?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-1"></i> Agregar un Producto</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column mx-auto justify-content-center mt-3">
        <div id="divProductosContainer" class="d-flex flex-column justify-content-center align-items-center">
            <?php
            if (!$cantidadProductos) {
                echo '<h5 class="text-center text-black-50">No tiene productos en venta</h5>';
            }
            ?>
        </div>

        <div id="paginador" class="d-flex mx-auto justify-content-center align-items-center mt-4"></div>
    </div>





    <div class="modal" id="eliminarModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Estas seguro de eliminar este producto?</p>
                </div>

                <div class="modal-footer">
                    <form action="<?php echo getBaseAddress() . "Productos/eliminar" ?>" method="post" id="confirmarEliminar">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
    
</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/paginationjs/dist/pagination.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/misProductos.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/eliminarProducto.js"; ?>"></script>
