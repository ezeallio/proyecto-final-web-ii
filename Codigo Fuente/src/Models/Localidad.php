<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 15:44
 */

class Localidad extends Model
{
    private $id;
    private $partidoId;
    private $partido;
    private $nombre;

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
    public function getPartidoId()
    {
        return $this->partidoId;
    }

    /**
     * @param mixed $partidoId
     */
    public function setPartidoId($partidoId)
    {
        $this->partidoId = $partidoId;
    }

    /**
     * @return mixed
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * @param mixed $partido
     */
    public function setPartido($partido)
    {
        $this->partido = $partido;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getLocalidadesByPartidoId($partidoId)
    {
        $localidades = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "PartidoId = " . $partidoId);

        foreach ($rows as $row) {
            $localidad = new Localidad();
            $localidad->db->disconnect();

            $localidad->setId($row['Id']);
            $localidad->setNombre(ucwords(strtolower($row['Nombre'])));
            $localidad->setPartidoId($row['PartidoId']);

            $localidades[] = $localidad;
        }

        return $localidades;
    }

    public function getById($id)
    {
        $row = $this->selectByPk($id);

        if($row)
        {
            $this->setId($row["Id"]);
            $this->setNombre($row["Nombre"]);
            $this->setPartidoId($row["PartidoId"]);
        }

        return $row;
    }

    public function existeLocalidadDBById()
    {
        $row = $this->selectByPk($this->getId());

        if($row)
        {
            $this->setNombre($row["Nombre"]);
            $this->setPartidoId($row["PartidoId"]);
        }

        return $row;
    }
}