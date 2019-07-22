<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 6/6/2019
 * Time: 17:42
 */

class Estado extends Model
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

    public function getAllEstados()
    {
        $rows = $this->pageRows(0, PHP_INT_MAX);

        $estados = [];

        foreach ($rows as $row) {
            $estado = new Estado();
            $estado->db->disconnect();

            $estado->setId($row["Id"]);
            $estado->setNombre($row["Nombre"]);

            $estados[] = $estado;
        }

        return $estados;
    }

    public function getById($estadoId)
    {
        $row = $this->selectByPk((int) $estadoId);

        if($row) {
            $this->setId($row["Id"]);
            $this->setNombre($row["Nombre"]);
        }

        return $row;
    }
}