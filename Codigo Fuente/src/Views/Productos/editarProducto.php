<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/basic.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">
<script>
    const pathAccionProducto = "<?php echo getBaseAddress()."Productos/eliminarImagen";?>"
</script>
<div class="container my-5 w-75">
    <h2>Editar Producto <i class='fas fa-1x fa-edit'></i></h2>

    <form action="<?php echo getBaseAddress() . "Productos/editar" ?>" method="post" class="mx-auto bg-white text-left"
          enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" value="<?php echo $producto->getNombre() ?>"
                   id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta">
            <div id="errorNombreProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" value="<?php echo $producto->getPrecio() ?>"
                   placeholder="Ej: 1300" id="inputPrecioProducto" class="form-control">
            <div id="errorPrecioProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputCantidadProducto">Cantidad</label>
            <input type="number" name="cantidadProducto" value="<?php echo $producto->getCantidad() ?>"
                placeholder="Ej: 5" id="inputCantidadProducto" class="form-control">
            <div id="errorCantidadProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control">
                <option value="0" disabled>Categoria</option>

                <?php
                foreach ($categorias as $categoria) {
                    if ($producto->getCategoriaId() == $categoria->getId())
                        echo "<option selected value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
                    else
                        echo "<option value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
                }
                ?>

            </select>
            <div id="errorCategoriaProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectEstadoProducto">Estado</label>
            <select name="estadoProducto" id="selectEstadoProducto" class="form-control">
                <option value="0" disabled selected>Estado</option>

                <?php
                foreach ($estados as $estado) {
                    if ($producto->getEstadoId() == $estado->getId())
                        echo "<option selected value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
                    else
                        echo "<option value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
                }
                ?>

            </select>
            <div id="errorEstadoProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectMetodoProducto">Metodo de Entrea</label>
            <select name="metodoProducto" id="selectMetodoProducto" class="form-control">
                <option value="0" disabled selected>Metodo</option>

                <?php
                foreach ($metodos as $metodo) {

                    if ($producto->getMetodoId() == $metodo->getId())
                        echo "<option selected value='" . $metodo->getId() . "'>" . $metodo->getTipo() . "</option>";
                    else
                        echo "<option value='" . $metodo->getId() . "'>" . $metodo->getTipo() . "</option>";
                }
                ?>

            </select>
            <div id="errorMetodoProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group d-none" id="divDetalleEntregaProducto">
            <label for="inputDetalleEntregaProducto">Punto de Entrega</label>
            <input type="text" name="detalleEntregaProducto" value="<?php echo $producto->getDetalleEntrega() ?>"
                   id="inputDetalleEntregaProducto" class="form-control" placeholder="Ej: Angel Acuña 1557">
            <div id="errorDetalleEntregaProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto"
                      name="descripcionProducto"> <?php echo $producto->getDescripcion() ?> </textarea>
            <small class="form-text text-muted float-left">Opcional</small>
            <div class="mt-2 float-right"><span id='caracteres'>0</span>/200<span></div>
            <div id="errorDescripcionProducto" class="error"><i
                        class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group mt-5">
            <label for="divImagenesProducto">Imagenes</label>
            <div id="dzUpload" class="dropzone mt-2"></div>
            <div id="errorImagenesProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group my-3">
            <label for="divImagenesPrecargadasProducto">Imagenes Precargadas</label>
            <div id="precargarImagenes" class="row">
                <?php

                echo "<input type='hidden' id='totalPrecarga' value='". count($imagenes) ."'>";

                foreach ($imagenes as $imagen){
                    $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen->getNombre();

                    $idImagen = $imagen->getId();
                    echo "<div class='card col-md-4 mt-4'>
                              <img src='$rutaImg' alt='' data-image='$rutaImg' style='' class='col h-75'>
                              <button type='button' class='close col botonEliminar border-top' aria-label='Close'>
                                <span aria-hidden='true' class='text-danger' onclick='eliminar($idImagen)' id='$idImagen'><i class='fas fa-times'></i></span>
                              </button>
                          </div>";
                }
                ?>
            </div>
        </div>

        <input type="hidden" id="idProducto" name="idProducto" value="<?php echo $producto->getId() ?>"/>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregarEditar" id="btnAgregarEditar" class="btn btn-primary">Guardar cambios</button>
        </div>

    </form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAMProducto.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/editarProducto.js"; ?>"></script>