<?php

class Usuario extends Model
{

    private $id;
    private $nombre;
    private $apellido;
    private $CUIT;
    private $username;
    private $upassword;
    private $email;
    private $telefonoCelular;
    private $telefonoFijo;
    private $geolocalizacionId;
    private $geolocalizacion;
    private $direccionId;
    private $direccion;
    private $generoId;
    private $genero;
    private $rolId;
    private $rol;
    private $fechaNacimiento;
    private $fechaBaneo;
    private $fechaBaja;

    /**
     * @return mixed
     */
    public function getGeolocalizacionId()
    {
        return $this->geolocalizacionId;
    }

    /**
     * @param mixed $geolocalizacionId
     */
    public function setGeolocalizacionId($geolocalizacionId)
    {
        $this->geolocalizacionId = $geolocalizacionId;
    }

    /**
     * @return mixed
     */
    public function getGeolocalizacion()
    {
        return $this->geolocalizacion;
    }

    /**
     * @param mixed $geolocalizacion
     */
    public function setGeolocalizacion($geolocalizacion)
    {
        $this->geolocalizacion = $geolocalizacion;
    }

    /**
     * @return mixed
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * @param mixed $telefonoFijo
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;
    }

    /**
     * @return mixed
     */
    public function getCUIT()
    {
        return $this->CUIT;
    }

    /**
     * @param mixed $CUIT
     */
    public function setCUIT($CUIT)
    {
        $this->CUIT = $CUIT;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getGeneroId()
    {
        return $this->generoId;
    }

    /**
     * @param mixed $generoId
     */
    public function setGeneroId($generoId)
    {
        $this->generoId = $generoId;
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

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUpassword()
    {
        return $this->upassword;
    }

    /**
     * @param mixed $upassword
     */
    public function setUpassword($upassword)
    {
        $this->upassword = $upassword;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelefonoCelular()
    {
        return $this->telefonoCelular;
    }

    /**
     * @param mixed $telefonoCelular
     */
    public function setTelefonoCelular($telefonoCelular)
    {
        $this->telefonoCelular = $telefonoCelular;
    }

    /**
     * @return mixed
     */
    public function getDireccionId()
    {
        return $this->direccionId;
    }

    /**
     * @param mixed $direccionId
     */
    public function setDireccionId($direccionId)
    {
        $this->direccionId = $direccionId;
    }

    /**
     * @return mixed
     */
    public function getRolId()
    {
        return $this->rolId;
    }

    /**
     * @param mixed $rolId
     */
    public function setRolId($rolId)
    {
        $this->rolId = $rolId;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return mixed
     */
    public function getFechaBaneo()
    {
        return $this->fechaBaneo;
    }

    /**
     * @param mixed $fechaBaneo
     */
    public function setFechaBaneo($fechaBaneo)
    {
        $this->fechaBaneo = $fechaBaneo;
    }

    /**
     * @return mixed
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    public function traerUsuario($pk)
    {
        $usuario = $this->selectByPk($pk);

        if($usuario) {
            $this->setNombre($usuario["Nombre"]);
            $this->setApellido($usuario["Apellido"]);
            $this->setUsername($usuario["Username"]);
            $this->setEmail($usuario["Email"]);
            $this->setTelefonoCelular($usuario["TelefonoCelular"]);
            $this->setFechaNacimiento($usuario["FechaNacimiento"]);
            $this->setGeolocalizacionId($usuario["GeolocalizacionId"]);
        }

        return $usuario;
    }

    public function traerUsuarioPorUserName ($username)
    {
        $usuario = $this->pageRows(0, 1, "Username LIKE '$username'");

        if($usuario) {
            $this->setId($usuario[0]["Id"]);
            $this->setNombre($usuario[0]["Nombre"]);
            $this->setApellido($usuario[0]["Apellido"]);
            $this->setUsername($usuario[0]["Username"]);
            $this->setEmail($usuario[0]["Email"]);
            $this->setFechaBaneo($usuario[0]["FechaBaneo"]);
            $this->setTelefonoCelular($usuario[0]["TelefonoCelular"]);
            $this->setFechaNacimiento($usuario[0]["FechaNacimiento"]);
            $this->setGeolocalizacionId($usuario[0]["GeolocalizacionId"]);
        }

        return $usuario;
    }

    /**
     * @param mixed $fechaBaja
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function validarNombre()
    {
        return FuncionesUtiles::esOracion($this->nombre)
            && ($cantLetras = strlen($this->nombre)) <= 15
            && $cantLetras >= 3;
    }

    public function validarApellido()
    {
        return FuncionesUtiles::esOracion($this->apellido)
            && ($cantLetras = strlen($this->apellido)) <= 15
            && $cantLetras >= 3;
    }

    public function validarCUIT()
    {
        $cuit = preg_replace('/[^\d]/', '', (string) $this->getCUIT());
        $cuit_tipos = [20, 23, 24, 27, 30, 33, 34];

        if (strlen($cuit) != 11)
            return FALSE;

        $tipo = (int) substr($cuit, 0, 2);

        if (!in_array($tipo, $cuit_tipos, TRUE))
            return FALSE;

        $acumulado = 0;
        $digitos = str_split($cuit); // Convertir en un array
        $digito = array_pop($digitos); // Extraer último elemento del array
        $contador = count($digitos);

        for ($i = 0; $i < $contador; $i++)
            $acumulado += $digitos[ 9 - $i ] * (2 + ($i % 6));

        $verif = 11 - ($acumulado % 11);

        // Si el resultado es 11, el dígito verificador será 0
        // Sino, será el dígito verificador
        $verif = $verif == 11 ? 0 : $verif;

        return $digito == $verif;
    }

    public function validarUsername()
    {
        return FuncionesUtiles::esPalabraConNumeros($this->username)
            && ($cantLetras = strlen($this->username)) <= 10
            && $cantLetras >= 3;
    }

    public function validarEmail()
    {
        return FuncionesUtiles::esEmailValido($this->email);
    }

    public function validarTelefonoCelular()
    {
        return (FuncionesUtiles::esEntero($this->telefonoCelular)
                || FuncionesUtiles::esCadenaNumerica($this->telefonoCelular))
            && strlen($this->telefonoCelular) === 10;
    }

    public function validarTelefonoFijo()
    {
        return (FuncionesUtiles::esEntero($this->telefonoFijo)
                || FuncionesUtiles::esCadenaNumerica($this->telefonoFijo))
            && strlen($this->telefonoFijo) === 8;
    }

    public function validarRol()
    {
        return (FuncionesUtiles::esEntero($this->rolId) || FuncionesUtiles::esCadenaNumerica($this->rolId))
            && (Roles::ADMINISTRADOR === $this->rolId || Roles::USUARIO === $this->rolId);
    }

    public function validarGenero()
    {
        return (FuncionesUtiles::esEntero($this->generoId) || FuncionesUtiles::esCadenaNumerica($this->generoId))
            && (generos::Masculino == $this->generoId || generos::Femenino == $this->generoId || generos::Otro == $this->generoId);
    }

    public function loguearUsuarioDB ()
    {
        $row = $this->pageRows(0, 1, "(Username LIKE '$this->username' OR Email LIKE '$this->email') AND FechaBaja IS NULL AND UPassword LIKE '$this->upassword'");

        if($row) {
            $this->setId($row[0]["Id"]);
            $this->setEmail($row[0]["Email"]);
            $this->setUsername($row[0]["Username"]);
            $this->setRolId($row[0]["RolId"]);
            $this->setFechaBaneo($row[0]["FechaBaneo"]);
        }

        return $row;
    }

    public function loguearAdminDB ()
    {
        $row = $this->pageRows(0, 1, "(Username LIKE '$this->username' OR Email LIKE '$this->email') AND FechaBaneo IS NULL AND FechaBaja IS NULL AND UPassword LIKE '$this->upassword' AND RolId = 1");

        if($row) {
            $this->setId($row[0]["Id"]);
            $this->setEmail($row[0]["Email"]);
            $this->setUsername($row[0]["Username"]);
            $this->setRolId($row[0]["RolId"]);
        }

        return $row;
    }

    public function existeUsuarioDB ()
    {
        $row = $this->pageRows(0, 1, "Username LIKE '$this->username' OR Email LIKE '$this->email' OR CUIT = $this->CUIT");

        if($row)
            $this->setId($row[0]["Id"]);

        return $row;
    }

    public function existeUsuarioActivoDB ()
    {
        $row = $this->pageRows(0, 1, "(Username LIKE '$this->username' OR Email LIKE '$this->email' OR CUIT = $this->CUIT) AND FechaBaja IS NULL AND FechaBaneo IS NULL");

        if($row)
            $this->setId($row[0]["Id"]);

        return $row;
    }

    public function validarUsuario()
    {
        return $this->validarNombre() && $this->validarApellido() && $this->validarCUIT()
            && $this->validarUsername() && $this->validarEmail() && $this->validarRol()
            && $this->validarGenero() && $this->validarTelefonoFijo() && $this->validarTelefonoCelular();
    }

    public function insertarUsuario()
    {
        $array = [
            "Nombre" => $this->getNombre(),
            "Apellido" => $this->getApellido(),
            "CUIT" => $this->getCUIT(),
            "Username" => $this->getUsername(),
            "UPassword" => $this->getUpassword(),
            "Email" => $this->getEmail(),
            "TelefonoFijo" => $this->getTelefonoFijo(),
            "TelefonoCelular" => $this->getTelefonoCelular(),
            "DireccionId" => $this->getDireccionId(),
            "GeneroId" => $this->getGeneroId(),
            "RolId" => $this->getRolId(),
            "FechaNacimiento" => date('Y-m-d', strtotime($this->getFechaNacimiento())),
            "GeolocalizacionId" => $this->getGeolocalizacionId()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function getUsuarioById($pk)
    {
        if($registro = $this->selectByPk($pk))
        {
            $this->setId($registro["Id"]);
            $this->setNombre($registro["Nombre"]);
            $this->setApellido($registro["Apellido"]);
            $this->setCUIT($registro["CUIT"]);
            $this->setFechaNacimiento($registro["FechaNacimiento"]);
            $this->setUsername($registro["Username"]);
            $this->setUpassword($registro["UPassword"]);
            $this->setTelefonoFijo($registro["TelefonoFijo"]);
            $this->setTelefonoCelular($registro["TelefonoCelular"]);
            $this->setDireccionId($registro["DireccionId"]);
            $this->setRolId($registro["RolId"]);
            $this->setGeneroId($registro["GeneroId"]);
            $this->setEmail($registro["Email"]);
            $this->setFechaBaneo($registro["FechaBaneo"]);
            $this->setFechaBaja($registro["FechaBaja"]);
        }

        return $registro;
    }

    public function renovarPasword($newPass)
    {
        $array = [
            "Id" => $this->getId(),
            "UPassword" => strtoupper(sha1($newPass))
        ];
        return $this->update($array);
    }

    public function banear ()
    {
        $array = [
            "Id" => $this->getId(),
            "FechaBaneo" => date('Y-m-d', strtotime(str_replace('/', '-', $this->getFechaBaneo())))
        ];
        return $this->update($array);
    }

    public function desbanear()
    {
        $array = [
            "Id" => $this->getId(),
            "FechaBaneo" => null
        ];

        return $this->update($array);
    }

    public function traerListaDeUltimoBaneados(){

        $baneados = array();

        $rows = $this->pageRows(0, 15, "FechaBaneo is not null order by Id desc");

        foreach($rows as $row)
        {
            $usuario = new Usuario();
            $usuario->db->disconnect();
            $usuario->setId($row["Id"]);
            $usuario->setFechaBaneo($row["FechaBaneo"]);
            $usuario->setUsername($row["Username"]);
            $baneados[] = $usuario;
        }

        return $baneados;

    }

}

?>