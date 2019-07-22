<?php

class Facturacion extends Model
{
    private $id;
    private $mes;
    private $anio;
    private $usuarioId;
    private $usuario;
    private $total;

    /**
     * @return mixed
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * @param mixed $anio
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
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
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * @param mixed $mes
     */
    public function setMes($mes)
    {
        $this->mes = $mes;
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
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function insertarFacturacion()
    {
        $array = [
            "UsuarioId" => $this->getUsuarioId(),
            "Mes" => date("m"),
            "Anio" => date("Y"),
            "Total" => $this->getTotal(),
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function insertarFacturacionMensuales()
    {
        $array = [
            "UsuarioId" => $this->getUsuarioId(),
            "Mes" => date("m"),
            "Anio" => date("Y"),
            "Total" => $this->getTotal(),

        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function traerListaDeFacturaciones ($pk){

        $facturaciones = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "UsuarioId = $pk ");

        foreach($rows as $row)
        {
            $facturacion = new Facturacion();
            $facturacion->db->disconnect();
            $facturacion->setId($row["Id"]);
            $facturacion->setTotal($row["Total"]);
            $facturacion->setMes($row["Mes"]);
            $facturacion->setAnio($row["Anio"]);
            $facturaciones[] = $facturacion;
        }

        return $facturaciones;

    }
}