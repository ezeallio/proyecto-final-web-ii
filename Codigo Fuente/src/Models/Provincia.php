<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 15:36
 */

class Provincia extends Model
{
    private $id;
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

    public function getAllProvincias()
    {
        $provincias = array();

        $rows = $this->pageRows(0, PHP_INT_MAX);

        foreach ($rows as $row) {
            $provincia = new Provincia();
            $provincia->db->disconnect();
            $provincia->setId($row['Id']);
            $provincia->setNombre(ucwords(strtolower($row['Nombre'])));
            $provincias[] = $provincia;
        }

        return $provincias;
    }

    public function getById($id)
    {
        $row = $this->selectByPk($id);

        if($row)
        {
            $this->setId($row["Id"]);
            $this->setNombre($row["Nombre"]);
        }

        return $row;
    }

    public function existeProvinciaDBById()
    {
        $row = $this->selectByPk($this->getId());

        if($row)
            $this->setNombre($row["Nombre"]);

        return $row;
    }
}