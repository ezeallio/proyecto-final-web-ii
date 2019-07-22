<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 7/6/2019
 * Time: 17:39
 */

class   BuscarController extends Controller
{
    function buscarProductoPorNombre($json)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $nombres = $producto->getNombresMejoresProductosPorFrase(json_decode(json_encode($json))->producto);

        $resultados = [];

        foreach ($nombres as $nombre) {
            $searchResponseDto = new SearchResponseDto();

            $searchResponseDto->name = $nombre;

            $resultados[] = $searchResponseDto;
        }

        echo json_encode($resultados);
    }

    function productos($param)
    {
        $d["title"] = Constantes::BUSQUEDATITLE;

        $producto = new Producto();

        $d["palabra"] = str_replace("-", " ", base64_decode(urldecode($param[0])));
        $d["cantidadProductos"] = $producto->getCantProductosActivosDeOtrosUsuariosPorNombre($d["palabra"]);

        $this->set($d);
        $this->render(Constantes::BUSQUEDAVIEW);
    }

    function getPublicaciones($data)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $paginationDataSourceDto = new PaginationDataSourceDto();

        $estadistica = new Estadistica();

        $paginationDataSourceDto->items = [];

        $productos = $producto->getListaProdutosActivosDeOtrosUsuariosPorNombre(urldecode(base64_decode($data[0])), $data["pageNumber"], $data["pageSize"]);

        $estadistica->insertarProductosBuscados($productos);

        $estadistica->insertarCategoriasBuscadas($productos);

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
}