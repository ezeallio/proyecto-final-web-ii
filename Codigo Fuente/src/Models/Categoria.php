<?php

class Categoria extends Model
{
    private $id;
    private $nombre;

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

    public function traerListaCategorias()
    {
        $categorias = array();

        $rows = $this->pageRows(0, PHP_INT_MAX);

        foreach($rows as $row)
        {
            $categoria = new Categoria();
            $categoria->setId($row["Id"]);
            $categoria->setNombre($row["Nombre"]);
            $categorias[] = $categoria;
        }

        return $categorias;
    }

    public function traerCategoria($pk)
    {
        $categoria = $this->selectByPk($pk);

        $this->setNombre($categoria["Nombre"]);

    }

    public function existeCategoriaDB()
    {
        return $this->selectByPk($this->getId());
    }
}

?>