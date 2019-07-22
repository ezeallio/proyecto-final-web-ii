<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 18/6/2019
 * Time: 19:17
 */

class CarritoController extends Controller
{
    function agregar($json)
    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($json['data']));
        $producto = new Producto();
        $producto->traerProducto($data->idProducto);

        if(!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }

        if(in_array($data->idProducto, $_SESSION["carrito"])=== true) {
            throw new ProductoDuplicadoCarritoException("El producto ya se encuentra en el carrito", CodigoError::ProductoDuplicadoEnCarrito);
        }

        if($producto->getCantidad() < 1){
            throw new CantidadProductoNegativaException("Se agoto el stock del producto seleccionado", CodigoError::CantidadProductoNegativa);
        }

        $_SESSION["carrito"][] = $data->idProducto;
        $cantidadProductosEnCarrito = count($_SESSION["carrito"]);
        $productoDto = new ProductoDto();
        $productoDto->id = $data->idProducto;
        $productoDto->cantidad = $cantidadProductosEnCarrito;
        echo json_encode($productoDto);
    }

    function mostrar()
    {
        $d["title"] = Constantes::CARRITOCOMPRASTITLE;
        $d["publicaciones"] = [];

        if(isset($_SESSION["carrito"])) {
            foreach ($_SESSION["carrito"] as $item) {
                $producto = new Producto();
                $imagen = new Imagen();
                $producto->traerProducto($item);
                $productoId = $producto->getId();
                if(!isset($productoId)){
                    throw new SQLGetException("Error al traer el producto", CodigoError::ErrorGetSql);
                }
                $imagen->traerImagenPrincipal($producto->getId());
                $imagenId = $imagen->getId();
                if(!isset($imagenId)){
                    throw new SQLGetException("Error al traer la imagen principal del producto", CodigoError::ErrorGetSql);
                }
                $d["publicaciones"][] = new PublicacionViewModel($producto, $imagen);
            }
        }
        $this->set($d);
        $this->render(Constantes::CARRITOCOMPRASVIEW);
    }

    function eliminarDelCarrito($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));
        
        if(array_search($data->idProducto, $_SESSION["carrito"]) === null){
            throw new ProductoInvalidoException("El producto a eliminar no se encuentra en el carrito", CodigoError::ProductoNoEncontrado);
        }

        array_splice($_SESSION["carrito"], array_search($data->idProducto, $_SESSION["carrito"]));

        echo json_encode($data->idProducto);
    }
}