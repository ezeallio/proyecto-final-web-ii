<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 15:41
 */

class Partido extends Model
{
    private $id;
    private $provinciaId;
    private $provincia;
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
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    /**
     * @param mixed $provinciaId
     */
    public function setProvinciaId($provinciaId)
    {
        $this->provinciaId = $provinciaId;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
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

    public function getPartidosByProvinciaId($provinciaId)
    {
        $partidos = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "ProvinciaId = " . $provinciaId);

        foreach ($rows as $row) {
            $partido = new Partido();
            $partido->db->disconnect();

            $partido->setId($row['Id']);
            $partido->setNombre(ucwords(strtolower($row['Nombre'])));
            $partido->setProvinciaId($row['ProvinciaId']);

            $partidos[] = $partido;
        }

        return $partidos;
    }

    public function getById($id)
    {
        $row = $this->selectByPk($id);

        if($row)
        {
            $this->setId($row["Id"]);
            $this->setNombre($row["Nombre"]);
            $this->setProvinciaId($row["ProvinciaId"]);
        }

        return $row;
    }

    public function existePartidoDBById()
    {
        $row = $this->selectByPk($this->getId());

        if($row)
        {
            $this->setNombre($row["Nombre"]);
            $this->setProvinciaId($row["ProvinciaId"]);
        }

        return $row;
    }
}