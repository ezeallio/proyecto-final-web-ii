<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 24/5/2019
 * Time: 23:50
 */

class Geolocalizacion extends Model
{
    private $id;
    private $latitud;
    private $longitud;

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
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * @param mixed $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    /**
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * @param mixed $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    public function validarLatitud()
    {
        return FuncionesUtiles::esDecimal($this->getLatitud());
    }

    public function validarLongitud()
    {
        return FuncionesUtiles::esDecimal($this->getLongitud());
    }

    public function validarGeolocalizacion()
    {
        return $this->validarLatitud() && $this->validarLongitud();
    }

    public function existeGeolocalizacion()
    {
        $where = "Latitud = $this->latitud AND Longitud = $this->longitud";

        $row = $this->pageRows(0, 1, $where);

        if($row)
            $this->setId($row[0]['Id']);

        return $row;
    }

    public function insertarGeolocalizacion()
    {
        $array = [
            "Latitud" => $this->getLatitud(),
            "Longitud" => $this->getLongitud()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function getGeolocalizacionById($pk)
    {
        $row = $this->selectByPk($pk);

        if($row) {
            $this->setId($row["Id"]);
            $this->setLatitud($row["Latitud"]);
            $this->setLongitud($row["Longitud"]);
        }

        return $row;
    }
}