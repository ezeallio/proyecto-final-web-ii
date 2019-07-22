<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 29/6/2019
 * Time: 19:43
 */

class Review extends Model
{
    private $id;
    private $calificacion;
    private $detalle;
    private $productoId;
    private $producto;
    private $usuarioId;
    private $usuario;
    private $fechaAlta;

    /**
     * @return mixed
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * @param mixed $fechaAlta
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param mixed $usuarioId
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * @param mixed $productoId
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
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

    public function realizoUsuarioReview()
    {
        return $this->pageRows(0, 1, "ProductoId = " . $this->getProductoId() . " AND UsuarioId = " . $this->getUsuarioId()) ? true : false;
    }

    public function ingresarReview()
    {
        $this->setFechaAlta(date("Y-m-d"));

        $array = [
            "Detalle" => $this->getDetalle(),
            "Calificacion" => $this->getCalificacion(),
            "ProductoId" => $this->getProductoId(),
            "UsuarioId" => $this->getUsuarioId(),
            "FechaAlta" => $this->getFechaAlta()
        ];
        $id = $this->insert($array);

        if($id) {
            $this->setId($id);
        }

        return $id;
    }

    public function getCantReviewsEnPublicacion()
    {
        return $this->total('ProductoId = ' . $this->getProductoId());
    }

    public function getReviewsWithPaginatorByProductoId($pageNumber, $pageSize)
    {
        $rows = $this->pageRows(($pageNumber - 1) * $pageSize, $pageSize, "ProductoId = " . $this->getProductoId());

        $reviews = [];
        foreach ($rows as $row) {
            $review = new Review();
            $usuario = new Usuario();

            $review->db->disconnect();

            if(!$usuario->traerUsuario($row["UsuarioId"])) {
                throw new UsuarioNoEncontradoException("No se ha encontrado el usuario con id " . $row["UsuarioId"], CodigoError::UsuarioNoEncontrado);
            }

            $usuario->db->disconnect();

            $review->setId($row["Id"]);
            $review->setProductoId($row["ProductoId"]);
            $review->setFechaAlta($row["FechaAlta"]);
            $review->setDetalle($row["Detalle"]);
            $review->setCalificacion($row["Calificacion"]);
            $review->setUsuarioId($row["UsuarioId"]);
            $review->setUsuario($usuario);

            $reviews[] = $review;
        }

        return $reviews;
    }

    public function getSumaCalificacionesByProductoId($productoId)
    {
        $rows = $this->pageRows('', '', 'ProductoId = ' . $productoId, [0 => 'Calificacion']);

        $sum = 0;

        foreach ($rows as $row) {
            $sum += $row["Calificacion"];
        }

        return $sum;
    }

    public function getCantReviewsByProductoId($productoId)
    {
        return $this->total('ProductoId = ' . $productoId);
    }
}