<?php

class Imagen extends Model
{
    private $id;
    private $nombre;
    private $productoId;
    private $producto;
    private $fechaBaja;

    /**
     * @return mixed
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * @param mixed $fechaBaja
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getProductoId()
    {
        return $this->productoId;
    }

    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    public function insertarImagen()
    {
        $array = [
            "Nombre" => $this->getNombre(),
            "ProductoId" => $this->getProductoId(),
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function traerListaImagenes($pk)
    {
        $imagenes = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "ProductoId = $pk AND FechaBaja IS NULL");

        foreach($rows as $row)
        {
            $imagen = new Imagen();
            $imagen->db->disconnect();
            $imagen->setId($row["Id"]);
            $imagen->setNombre($row["Nombre"]);
            $imagen->setProductoId($row["ProductoId"]);
            $imagenes[] = $imagen;
        }

        return $imagenes;
    }

    public function cambiarImagen($pk)
    {
        $imagen = $this->selectByPk($pk);

        $imagen["Nombre"] = $this->getNombre();

        return $this->update($imagen);
    }

    public function eliminarImagen($idImagen)
    {
        $imagen = $this->selectByPk($idImagen);
        $imagen["FechaBaja"] = date("Y-m-d H:i:s");
        return $this->update($imagen);
    }

    public function traerImagenPrincipal($productoId)
    {
        $row = $this->pageRows(0, 1, "ProductoId = $productoId AND FechaBaja IS NULL");

        if($row) {
            $this->setId($row[0]["Id"]);
            $this->setNombre($row[0]["Nombre"]);
            $this->setProductoId($row[0]["ProductoId"]);
        }

        return $row;
    }

    public function traerImagenCompra($productoId)
    {
        $row = $this->pageRows(0, 1, "ProductoId = $productoId");

        if($row) {
            $this->setId($row[0]["Id"]);
            $this->setNombre($row[0]["Nombre"]);
            $this->setProductoId($row[0]["ProductoId"]);
        }

        return $row;
    }

    public function traerImagen($id)
    {
        $row = $this->selectByPk($id);

        if($row) {
            $this->setId($row["Id"]);
            $this->setNombre($row["Nombre"]);
            $this->setProductoId($row["ProductoId"]);
        }

        return $row;
    }

    public function eliminarImagenesProducto($idProducto)
    {
        $rows = $this->pageRows(0, 4, "ProductoId = $idProducto AND FechaBaja IS NULL");

        if($rows) {
            foreach($rows as $row) {
                $row["FechaBaja"] = date("Y-m-d H:i:s");

                if(!$this->update($row)) {
                    $rows = null;
                    break;
                }
            }
        }

        return $rows;
    }
}

?>