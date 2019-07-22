<?php

class ProductosController extends Controller
{

    function misProductos()
    {

        $producto = new Producto();

        $d["cantidadProductos"] = $producto->getCantProductosActivosPropios();

        $d["title"] = Constantes::PRODUTOSTITLE;
        $this->set($d);
        $this->render(Constantes::PRODUCTOSVIEW);
    }

    function agregarProducto()
    {
        $d['title'] = Constantes::AGREGARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();
        $metodo = new Metodo();

        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();
        $d["metodos"] = $metodo->getAllMetodos();

        $this->set($d);
        $this->render(Constantes::ALTAPRODUCTO);
    }

    function alta($publicacion)
    {
        $producto = new Producto();

        $producto->setFechaAlta(date("Y-m-d H:i:s"));
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setCantidad($publicacion["cantidadProducto"]);
        $producto->setEstadoId($publicacion["estadoProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);

        $producto->setUsuarioId(unserialize($_SESSION["session"])->getId());

        $producto->setDescripcion($publicacion["descripcionProducto"]);
        $producto->setMetodoId($publicacion["metodoProducto"]);

       if ($publicacion["metodoProducto"] == 1 ){
            $producto->setDetalleEntrega($publicacion["detalleEntregaProducto"]);
        }
        else{
            $producto->setDetalleEntrega("En Espera");
        }

        if (!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);

        if (!$producto->insertarProducto())
            throw new SQLInsertException("Error al insertar el producto", CodigoError::ErrorInsertSQL);

        $imagen = new Imagen();

        if (!is_dir(ROOT . "Webroot/img/productos")) {
            mkdir(ROOT . "Webroot/img/productos", 0777, true);
        }

        if (isset($_FILES["file"]["name"])) {

            $total = count($_FILES["file"]["name"]);

            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["file"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = TokenHelper::getToken() . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["file"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
                $imagen->setProductoId($producto->getId());
                $imagen->insertarImagen();
            }
        } else {
            throw new ImagenNoInsertadaException("No se ha ingresado ninguna imagen para el producto", CodigoError::ImagenNoInsertada);
        }

        echo json_encode(true);
    }

    function editarProducto($publicacion)
    {
        $d['title'] = Constantes::EDITARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();
        $metodo = new Metodo();
        $producto = new Producto();
        $imagen = new Imagen();

        $producto->traerProducto($publicacion[0]);
        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();
        $d["metodos"] = $metodo->getAllMetodos();

        $d["producto"] = $producto;


        $d["imagenes"] = $imagen->traerListaImagenes($publicacion[0]);

        $this->set($d);
        $this->render(Constantes::EDITARPRODUCTO);
    }

    function editar($publicacion)
    {
        $sesion = unserialize($_SESSION["session"]);

        $producto = new Producto();
        $producto->setId($publicacion["idProducto"]);
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setEstadoId($publicacion["estadoProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);
        $producto->setDescripcion($publicacion["descripcionProducto"]);
        $producto->setCantidad($publicacion["cantidadProducto"]);
        $producto->setMetodoId($publicacion["metodoProducto"]);
        $producto->setUsuarioId($sesion->getId());

        if ($publicacion["metodoProducto"] == 1 ){
            $producto->setDetalleEntrega($publicacion["detalleEntregaProducto"]);
        }
        else{
            $producto->setDetalleEntrega("En Espera");
        }

        if (!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);
        
        if (!$producto->actualizarProducto())
            throw new SQLUpdateException("Error al realizar la actualizacion del producto", CodigoError::ErrorUpdateSQL);

        if (isset($_FILES["file"]["name"])) {

            $imagen = new Imagen();

            $total = count($_FILES["file"]["name"]);

            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["file"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = TokenHelper::getToken() . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["file"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
                $imagen->setProductoId($producto->getId());
                $imagen->insertarImagen();
            }

        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function eliminarImagen($json)
    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($json['data']));
        $imagen = new Imagen();
        $idImagen = $data->idImagen;
        
        $imagen->traerImagen($idImagen);

        unlink(ROOT . "Webroot/img/productos/" . $imagen->getNombre());

        if(!$imagen->eliminarImagen($idImagen)){
            echo json_encode(false);
        }
        echo json_encode($idImagen);
    }

    function eliminar($publicacion)
    {
        $imagen = new Imagen();
        $producto = new Producto();
        
        $imagenes = $imagen->traerListaImagenes($publicacion["idProducto"]);
            
        unset($imagenes[0]);

        foreach($imagenes as $img)
            unlink(ROOT . "Webroot/img/productos/" . $img->getNombre());

        if(!$imagen->eliminarImagenesProducto($publicacion["idProducto"])) {
            throw new EliminacionMasivaImagenException("Ocurrió un error al eliminar las imágenes del producto con id " . $publicacion["idProducto"], CodigoError::EliminacionMasivaImagen);
        }

        if(!$producto->eliminarProducto($publicacion["idProducto"])) {
            throw new EliminarProductoException("Ocurrió un error al eliminar el producto con id " . $publicacion["idProducto"], CodigoError::EliminarProducto);
        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function publicacion($publicacion)
    {
        $d["title"] = Constantes::PUBLICACIONTITLE;

        $producto = new Producto();
        $productoRelacionado = new Producto();
        $categoria = new Categoria();
        $usuario = new Usuario();
        $geolocalizacion = new Geolocalizacion();

        $producto->traerProducto($publicacion[0]);
        $categoria->traerCategoria($producto->getCategoriaId());
        $usuario->traerUsuario($producto->getUsuarioId());

        $geolocalizacion->getGeolocalizacionById($usuario->getGeolocalizacionId());

        $imagen = new Imagen();

        $imagenes = $imagen->traerListaImagenes($producto->getId());

        $condicion = "";
        $categoriaId = $producto->getCategoriaId();
        $idProducto = $producto->getId();

        $d["usuarioComproEsteProducto"] = false;

        $registroCompra = new RegistroCompra();
        $review = new Review();

        $review->setProductoId($idProducto);

        if(isset($_SESSION["session"])){
            $idUsuario = unserialize($_SESSION["session"])->getId();
            $condicion = "UsuarioId <> $idUsuario AND FechaBaja IS NULL AND CategoriaId = $categoriaId AND Id <> $idProducto";

            $d["usuarioComproEsteProducto"] = $registroCompra->realizoUsuarioCompraProducto($idUsuario, $idProducto);

            $review->setUsuarioId($idUsuario);
            $d["usuarioRealizoReviewEsteProducto"] = $review->realizoUsuarioReview();
        }else{
            $condicion = "FechaBaja IS NULL AND CategoriaId = $categoriaId AND Id <> $idProducto";
        }


        $productosRelacionados = $productoRelacionado->traerProductosRelacionados($condicion);
        $imagenesProductosRelacionados = array();

        foreach ($productosRelacionados as $productoRelacionado){
            $imagenProductoRelacionado = new Imagen();
            $imagenProductoRelacionado->traerImagenPrincipal($productoRelacionado->getId());
            $imagenesProductosRelacionados[$productoRelacionado->getId()] = $imagenProductoRelacionado;
        }

        $comentario = new Comentario();
        
        $sumReviews = $cantReviews = 0;

        foreach ($producto->traerListaProductosByUsuarioId() as $p) {
            $sumReviews += $review->getSumaCalificacionesByProductoId($p->getId());
            $cantReviews += $review->getCantReviewsByProductoId($p->getId());
        }

        $d["cantidadReviews"] = $review->getCantReviewsEnPublicacion();
        $d["imagenes"] = $imagenes;
        $d["imagenesProductosRelacionados"] = $imagenesProductosRelacionados;
        $d["producto"] = $producto;
        $d["categoria"] = $categoria;
        $d["usuario"] = $usuario;
        $d["geolocalizacion"] = $geolocalizacion;
        $d["productosRelacionados"] = $productosRelacionados;
        $d["comentarios"] = $comentario->traerUltimosComentarios(0, $publicacion[0]);
        $d["totalComentarios"] = $comentario->contarComentarios($publicacion[0]);
        $d["nivelVendedor"] = !$cantReviews ? -1 : $sumReviews/$cantReviews;

        $this->set($d);
        $this->render(Constantes::PUBLICACIONVIEW);
    }

    function getPublicaciones($data)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $paginationDataSourceDto = new PaginationDataSourceDto();

        $paginationDataSourceDto->items = [];

        $productos = $producto->getListaProdutosActivosPropios($data["pageNumber"], $data["pageSize"]);

        $imagen = new Imagen();

        $publicaciones = [];

        foreach($productos as $p) {
            if(!$imagen->traerImagenPrincipal($p->getId()))
                throw new ImagenPrincipalNoEncontradaException("No se ha encontrado la Imagen Principal para el producto con Id " . $p->getId(), CodigoError::ImagenPrincipalNoEncontrada);

            $imagenDto = new ImagenDto();

            $imagenDto->id = $imagen->getId();
            $imagenDto->nombre = $imagen->getNombre();

            $productoDto = new ProductoDto();

            $productoDto->id = $p->getId();
            $productoDto->nombre = $p->getNombre();
            $productoDto->estadoId = $p->getEstadoId();
            $productoDto->metodoId = $p->getMetodoId();
            $productoDto->categoriaId = $p->getCategoriaId();
            $productoDto->precio = $p->getPrecio();
            $productoDto->fechaAlta = $p->getFechaAlta();
            $productoDto->cantidad = $p->getCantidad();

            $publicaciones[] = new PublicacionViewModel($productoDto, $imagenDto);
        }

        $paginationDataSourceDto->items = $publicaciones;

        echo json_encode($paginationDataSourceDto);
    }

    function guardarReview($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json["data"]);

        $review = new Review();
        $registroCompra = new RegistroCompra();

        $review->setProductoId($data->productoId);
        $review->setCalificacion($data->calificacion);
        $review->setDetalle($data->detalle);
        $review->setUsuarioId(unserialize($_SESSION["session"])->getId());

        if(!$registroCompra->realizoUsuarioCompraProducto($review->getUsuarioId(), $review->getProductoId())) {
            throw new UsuarioNuncaRealizoCompraException("Nunca ha realizado una compra de este producto anteriormente", CodigoError::UsuarioNuncaRealizoCompra);
        }

        if($review->realizoUsuarioReview()) {
            throw new ReviewRealizadaPreviamenteException("Ya ha realizado una review anteriormente en esta publicación", CodigoError::ReviewRealizadaPreviamente);
        }

        if(!$review->ingresarReview()) {
            throw new SQLInsertException("No se ha podido ingresar la review", CodigoError::ErrorInsertSQL);
        }

        $usuario = new Usuario();

        $usuario->traerUsuario($review->getUsuarioId());

        $reviewViewModel = new ReviewViewModel();

        $reviewViewModel->fechaAlta = $review->getFechaAlta();
        $reviewViewModel->calificacion = $review->getCalificacion();
        $reviewViewModel->detalleReview = $review->getDetalle();
        $reviewViewModel->nombreCompletoUsuario = $usuario->getNombre() . " " . $usuario->getApellido();

        echo json_encode($reviewViewModel);
    }

    function getReviews($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json["data"]);

        $review = new Review();

        $review->setProductoId($data->productoId);

        $reviews = $review->getReviewsWithPaginatorByProductoId($data->pageNumber, $data->pageSize);

        $reviewViewModels = [];

        foreach ($reviews as $r) {
            $reviewViewModel = new ReviewViewModel();

            $reviewViewModel->nombreCompletoUsuario = $r->getUsuario()->getNombre() . " " . $r->getUsuario()->getApellido();
            $reviewViewModel->detalleReview = $r->getDetalle();
            $reviewViewModel->calificacion = $r->getCalificacion();
            $reviewViewModel->fechaAlta = $r->getFechaAlta();

            $reviewViewModels[] = $reviewViewModel;
        }

        echo json_encode($reviewViewModels);
    }

    function realizarPregunta($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $comentario = New Comentario();

        $comentario->setUsuarioId(unserialize($_SESSION["session"])->getId());

        $comentario->setProductoId($data->productoId);

        $comentario->setPregunta($data->pregunta);

        $comentario->setFechaPregunta(date("Y-m-d"));

        $comentario->setUsuarioUsername(unserialize($_SESSION["session"])->getUserName());

        $comentario->insertarComentario();

        $comentarioDto = new ComentarioDto();

        $comentarioDto->id = $comentario->getId();

        $comentarioDto->pregunta = $data->pregunta;

        $comentarioDto->fechaPregunta = date("d/m/Y", strtotime($comentario->getFechaPregunta()));

        $comentarioDto->usuarioUsername = $comentario->getUsuarioUsername();

        echo json_encode($comentarioDto);
    }

    function realizarRespuesta($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $comentario = New Comentario();

        $comentario->setId($data->id);

        $comentario->setRespuesta($data->respuesta);
        
        $comentario->setFechaRespuesta(date("Y-m-d"));

        $comentario->insertarRespuesta();

        $comentarioDto = new ComentarioDto();

        $comentarioDto->id = $comentario->getId();

        $comentarioDto->respuesta = $comentario->getRespuesta();

        $comentarioDto->fechaRespuesta = date("d/m/Y", strtotime($comentario->getFechaRespuesta()));

        echo json_encode($comentarioDto);
    }

    function mostrarMas($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $comentario = New Comentario();

        $comentarios = $comentario->traerUltimosComentarios($data->inicio, $data->idProducto);

        $comentariosDto = [];

        foreach($comentarios as $coment)
        {
            $comentarioDto = new ComentarioDto();

            $comentarioDto->id = $coment->getId();
            $comentarioDto->pregunta = $coment->getPregunta();
            $comentarioDto->respuesta = $coment->getRespuesta();
            $comentarioDto->fechaPregunta = date("d/m/Y", strtotime($coment->getFechaPregunta()));
            $comentarioDto->fechaRespuesta = date("d/m/Y", strtotime($coment->getFechaRespuesta()));
            $comentarioDto->usuarioUsername = $coment->getUsuarioUsername();

            $comentariosDto[] = $comentarioDto;
        }

        echo json_encode($comentariosDto);
    }
}
