<?php

class Metodo extends Model
{

    private $id;
    private $tipo;

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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getAllMetodos()
    {
        $metodos = array();

        $rows = $this->pageRows(0, PHP_INT_MAX);

        foreach($rows as $row)
        {
            $metodo = new Metodo();
            $metodo->db->disconnect();
            $metodo->setId($row['Id']);
            $metodo->setTipo($row['Tipo']);
            $metodos[] = $metodo;
        }

        return $metodos;
    }

    public function traerMetodo($pk)
    {
        $metodo = $this->selectByPk($pk);

        if($metodo) {
            $this->setId($metodo["Id"]);
            $this->setTipo($metodo["Tipo"]);
        }

        return $metodo;
    }

}