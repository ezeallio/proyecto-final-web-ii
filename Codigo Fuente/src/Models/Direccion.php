<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 13:56
 */

class Direccion extends Model
{
    private $id;
    private $calle;
    private $altura;
    private $piso;
    private $departamento;
    private $provinciaId;
    private $provincia;
    private $partidoId;
    private $partido;
    private $localidadId;
    private $localidad;

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
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return mixed
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @param mixed $altura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
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
    public function getLocalidadId()
    {
        return $this->localidadId;
    }

    /**
     * @param mixed $localidadId
     */
    public function setLocalidadId($localidadId)
    {
        $this->localidadId = $localidadId;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param mixed $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    public function traerDireccion($pk)
    {
       $direccion = $this->selectByPk($pk);

       $this->setCalle($direccion["Calle"]);
       $this->setAltura($direccion["Altura"]);
       $this->setLocalidadId($direccion["LocalidadId"]);
    }

    public function validarDireccion()
    {
        $this->setProvincia(new Provincia());
        $this->provincia->setId($this->getProvinciaId());

        $this->setPartido(new Partido());
        $this->partido->setId($this->getPartidoId());

        $this->setLocalidad(new Localidad());
        $this->localidad->setId($this->getLocalidadId());

        $validacion = $this->provincia->existeProvinciaDBById()
        && $this->partido->existePartidoDBById()
        && $this->localidad->existeLocalidadDBById()
        && $this->provincia->getId() == $this->partido->getProvinciaId()
        && $this->partido->getId() == $this->localidad->getPartidoId()
        && $this->validarCalle()
        && $this->validarAltura()
        && $this->validarPisoYDepartamento();

        return $validacion;
    }

    public function validarCalle()
    {
        return FuncionesUtiles::esOracion($this->getCalle());
    }

    public function validarAltura()
    {
        return FuncionesUtiles::esEntero($this->getAltura()) || FuncionesUtiles::esCadenaNumerica($this->getAltura());
    }

    public function validarPisoYDepartamento()
    {
        return !FuncionesUtiles::esCadenaNoNulaOVacia($this->getPiso()) && !FuncionesUtiles::esCadenaNoNulaOVacia($this->getDepartamento())
            || ($this->validarPiso() && $this->validarDepartamento());
    }

    public function validarPiso()
    {
        return FuncionesUtiles::esEntero($this->getPiso()) || FuncionesUtiles::esCadenaNumerica($this->getPiso());
    }

    public function validarDepartamento()
    {
        return FuncionesUtiles::esPalabra($this->getDepartamento());
    }

    public function existeDireccion()
    {
        $where = "Calle LIKE '$this->calle' AND Altura = $this->altura AND ProvinciaId = $this->provinciaId AND PartidoId = $this->partidoId AND LocalidadId = $this->localidadId";

        if(FuncionesUtiles::esCadenaNoNulaOVacia($this->getPiso()) && FuncionesUtiles::esCadenaNoNulaOVacia($this->getDepartamento()))
            $where .= " AND Piso = $this->piso AND Departamento LIKE '$this->departamento'";

        $row = $this->pageRows(0, 1, $where);

        if($row)
            $this->setId($row[0]['Id']);

        return $row;
    }

    public function insertarDireccion()
    {
        $array = [
            "Calle" => $this->getCalle(),
            "Altura" => $this->getAltura(),
            "Piso" => $this->getPiso(),
            "Departamento" => $this->getDepartamento(),
            "ProvinciaId" => $this->getProvinciaId(),
            "PartidoId" => $this->getPartidoId(),
            "LocalidadId" => $this->getLocalidadId()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function getIdLastInsert()
    {
        $this->setId($this->db->getInsertId());
    }
}