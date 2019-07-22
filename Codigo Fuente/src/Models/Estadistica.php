<?php


class Estadistica extends Model
{
    private $id;
    private $Nombre;
    private $cantidad;
    private $tipoEstadistica;
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getTipoEstadistica()
    {
        return $this->tipoEstadistica;
    }

    /**
     * @param mixed $tipoEstadistica
     */
    public function setTipoEstadistica($tipoEstadistica)
    {
        $this->tipoEstadistica = $tipoEstadistica;
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
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function insertarProductosBuscados($productos){
        foreach ($productos as $producto){
            $nombre = $producto->getNombre();
            $row = $this->pageRows(0, 1, "Nombre = '$nombre' AND TipoEstadistica = 1");

            if(!$row){

                $array = [
                    "Nombre" => $nombre,
                    "Cantidad" => 1,
                    "TipoEstadistica" => 1
                ];
                $this->insert($array);

            }else{
                $row[0]["Cantidad"] = $row[0]["Cantidad"] + 1;

                if (!$this->update($row[0])) {
                    $row = null;
                    break;
                }
            }
        }
    }

    public function insertarCategoriasBuscadas($productos){

        foreach ($productos as $producto){
            $categoria = new Categoria();
            $categoria->traerCategoria($producto->getCategoriaId());
            $nombreCategoria = $categoria->getNombre();
            $row = $this->pageRows(0, 1, "Nombre = '$nombreCategoria' AND TipoEstadistica = 2");
            if(!$row){
                $array = [
                    "Nombre" => $nombreCategoria,
                    "Cantidad" => 1,
                    "TipoEstadistica" => 2
                ];
                $this->insert($array);
            }else{
                $row[0]["Cantidad"] = $row[0]["Cantidad"] + 1;

                if (!$this->update($row[0])) {
                    $row = null;
                    break;
                }
            }
        }
    }

    public function insertarProductoMasVendidos($nombreProducto, $cantidadVendida){
        $row = $this->pageRows(0, 1, "Nombre = '$nombreProducto' AND TipoEstadistica = 4");

        if(!$row){
            $array = [
                "Nombre" => $nombreProducto,
                "Cantidad" => $cantidadVendida,
                "TipoEstadistica" => 4
            ];
            $this->insert($array);
        }else{
            $row[0]["Cantidad"] += $cantidadVendida;

            if (!$this->update($row[0])) {
                $row = null;
            }
        }
    }

    public function traerEstadisticas($cantidad, $tipoEstadistica){
        $rows = $this->pageRows(0, $cantidad, "TipoEstadistica = '$tipoEstadistica' ORDER by Cantidad DESC");
        $estadisticas = array();
        foreach ($rows as $row) {
            $estadistica = new Estadistica();
            $estadistica->setNombre($row["Nombre"]);
            $estadistica->setCantidad($row["Cantidad"]);
            $estadisticas[] = $estadistica;
        }

        return $estadisticas;
    }

    public function insertarMontosAcumulados($nombreProducto, $montoAcumulado){
        $row = $this->pageRows(0, 1, "Nombre = '$nombreProducto' AND TipoEstadistica = 3");

        if(!$row){
            $array = [
                "Nombre" => $nombreProducto,
                "Cantidad" => $montoAcumulado,
                "TipoEstadistica" => 3
            ];
            $this->insert($array);
        }else{
            $row[0]["Cantidad"] += $montoAcumulado;

            if (!$this->update($row[0])) {
                $row = null;
            }
        }
    }
}