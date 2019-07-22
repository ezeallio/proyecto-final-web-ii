<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/basic.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">

<div class="container col-xl-7 col-sm-5 mt-3">

    <h2>Agregar Producto <i class="fas fa-1x fa-plus mr-1"></i></h2>

    <form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto bg-white text-left"
          enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control"
                   placeholder="Ej: Bicicleta">
            <div id="errorNombreProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" placeholder="Ej: 1300" id="inputPrecioProducto"
                   class="form-control">
            <div id="errorPrecioProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputCantidadProducto">Cantidad</label>
            <input type="number" name="cantidadProducto" placeholder="Ej: 5" id="inputCantidadProducto"
                   class="form-control">
            <div id="errorCantidadProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control">
                <option value="0" disabled selected>Categoria</option>

                <?php
                foreach ($categorias as $categoria)
                    echo "<option value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
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
                foreach ($estados as $estado)
                    echo "<option value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
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
                foreach ($metodos as $metodo)
                    echo "<option value='" . $metodo->getId() . "'>" . $metodo->getTipo() . "</option>";
                ?>

            </select>
            <div id="errorMetodoProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group d-none" id="divDetalleEntregaProducto">
            <label for="inputDetalleEntregaProducto">Punto de Entrega</label>
            <input type="text" name="detalleEntregaProducto" id="inputDetalleEntregaProducto" class="form-control"
                   placeholder="Ej: Angel Acuña 1557">
            <div id="errorDetalleEntregaProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group mb-5">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" placeholder="¿Que vendes?" id="textareaDescripcionProducto"
                      name="descripcionProducto"></textarea>
            <small class="form-text text-muted float-left">Opcional</small>
            <div class="mt-2 float-right"><span id='caracteres'>0</span>/200<span></div>
            <div id="errorDescripcionProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group mb-4">
            <label for="divImagenesProducto">Imagenes</label>
            <div id="dzUpload" class="dropzone mt-2"></div>
            <div id="errorImagenesProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregarEditar" id="btnAgregarEditar" class="btn btn-primary">Agregar</button>
        </div>

    </form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAMProducto.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/altaProducto.js"; ?>"></script>