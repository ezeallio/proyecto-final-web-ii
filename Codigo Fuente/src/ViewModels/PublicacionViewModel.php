<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 15/6/2019
 * Time: 22:10
 */

class PublicacionViewModel
{
    public $producto;
    public $imagen;

    /**
     * PublicacionViewModel constructor.
     * @param $producto
     * @param $imagen
     */
    public function __construct($producto, $imagen)
    {
        $this->producto = $producto;
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}