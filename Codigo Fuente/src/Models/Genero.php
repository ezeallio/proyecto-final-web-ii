<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 13:13
 */

class Genero extends Model
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

    public function getAllGeneros()
    {
        $generos = array();

        $rows = $this->pageRows(0, PHP_INT_MAX);

        foreach($rows as $row)
        {
            $genero = new Genero();
            $genero->db->disconnect();
            $genero->setId($row['Id']);
            $genero->setNombre($row['Nombre']);
            $generos[] = $genero;
        }

        return $generos;
    }
}