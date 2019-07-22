<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        $this->layout = "layoutSeguridad";

        $genero = new Genero();
        $provincia = new Provincia();

        $d['generos'] = $genero->getAllGeneros();
        $d['provincias'] = $provincia->getAllProvincias();

        usort($d['generos'], Constantes::CMPBYID);
        usort($d['provincias'], Constantes::CMPBYNOMBRE);

        $d['title'] = Constantes::REGISTRARTITLE;

        $this->set($d);
        $this->render(Constantes::REGISTRARVIEW);
    }

    function getPartidosByProvinciaId($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));
        $partido = new Partido();

        $partidos = $partido->getPartidosByProvinciaId($data->provinciaId);

        usort($partidos, Constantes::CMPBYNOMBRE);

        $partidosDto = array();

        foreach ($partidos as $partido) {
            $partidoDto = new PartidoDto();
            $partidoDto->id = $partido->getId();
            $partidoDto->nombre = mb_convert_encoding($partido->getNombre(), 'UTF-8', 'UTF-8');
            $partidoDto->provinciaId = $partido->getProvinciaId();
            $partidosDto[] = $partidoDto;
        }

        echo json_encode($partidosDto);
    }

    function getLocalidadesByPartidoId($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $localidad = new Localidad();

        $localidades = $localidad->getLocalidadesByPartidoId($data->partidoId);

        usort($localidades, Constantes::CMPBYNOMBRE);

        $localidadesDto = array();

        foreach ($localidades as $localidad) {
            $localidadDto = new LocalidadDto();

            $localidadDto->id = $localidad->getId();
            $localidadDto->nombre = mb_convert_encoding($localidad->getNombre(), 'UTF-8', 'UTF-8');
            $localidadDto->partidoId = $localidad->getPartidoId();

            $localidadesDto[] = $localidadDto;
        }

        echo json_encode($localidadesDto);
    }

    function login()
    {
        $this->layout = "layoutSeguridad";
        $d['title'] = Constantes::LOGINTITLE;
        $this->set($d);
        $this->render(Constantes::LOGINVIEW);
    }

    function loguearUsuario($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $user = new Usuario();
        $session = new Session();

        if (FuncionesUtiles::esPalabraConNumeros($data->emailOrNick)) {
            $user->setUsername($data->emailOrNick);
            $user->setEmail(null);
        } else if (FuncionesUtiles::esEmailValido($data->emailOrNick)) {
            $user->setEmail($data->emailOrNick);
            $user->setUsername(null);
        } else {
            throw new EmailOrNickInvalidoException("El Email o Nickname insertado no son válidos", CodigoError::EmailOrNickInvalido);
        }

        if (PasswordHelper::validarPassword($data->password)) {
            $user->setUpassword(strtoupper(sha1($data->password)));
        } else {
            throw new PasswordInvalidaException("Formato de password ingresado inválido", CodigoError::PasswordInvalida);
        }

        if(!$user->loguearUsuarioDB()) {
            throw new UsuarioNoEncontradoException("Usuario o contraseña inválido. Revise sus datos y vuelva a intentarlo", CodigoError::UsuarioNoEncontrado);
        } else if (date("Y-m-d", strtotime($user->getFechaBaneo())) >= date("Y-m-d", time())) {
            throw new UsuarioBaneadoException("Su usuario se encuentra baneado hasta el " . date("d/m/Y", strtotime($user->getFechaBaneo())), CodigoError::UsuarioBaneado);
        } else {
            if($user->getFechaBaneo())
                if(!$user->desbanear())
                    throw new SQLUpdateException("No se ha podido desbanear al usuario con id " . $user->getId(), CodigoError::ErrorUpdateSQL);

            $session->setId($user->getId());
            $session->setUserName($user->getUsername());
            $session->setRolId($user->getRolId());
            $_SESSION["session"] = serialize($session);
            if($data->recordarme)
                setcookie("session", $_SESSION["session"], time() + 60*2, "/", apache_request_headers()["Host"]); //60 segs = 1 min. Multiplicado por 2, son 2 minutos.
        }

        echo json_encode(true);
    }

    function registrarUsuario($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $usuario = new Usuario();
        $direccion = new Direccion();
        $geolocalizacion = new Geolocalizacion();

        $direccion->setCalle($data->calle);
        $direccion->setAltura($data->altura);
        $direccion->setPiso($data->piso);
        $direccion->setDepartamento($data->departamento);
        $direccion->setProvinciaId($data->provinciaId);
        $direccion->setPartidoId($data->partidoId);
        $direccion->setLocalidadId($data->localidadId);

        if (!$direccion->validarDireccion())
            throw new DireccionInvalidaException("La dirección insertada es inválida", CodigoError::DireccionInvalida);

        if (!$direccion->existeDireccion()) {
            if (!$direccion->insertarDireccion())
                throw new SQLInsertException("Error al Insertar la Dirección", CodigoError::ErrorInsertSQL);
        }

        $geolocalizacion->setLatitud($data->geolocalizacion->latitud);
        $geolocalizacion->setLongitud($data->geolocalizacion->longitud);

        if (!$geolocalizacion->validarGeolocalizacion())
            throw new GeolocalizacionInvalidaException("Ubicación geográfica inválida", CodigoError::GeolocalizacionInvalida);

        if (!$geolocalizacion->existeGeolocalizacion()) {
            if (!$geolocalizacion->insertarGeolocalizacion())
                throw new SQLInsertException("Error al Insertar la Geolocalización", CodigoError::ErrorInsertSQL);
        }

        if (!PasswordHelper::validarPassword($data->password))
            throw new PasswordInvalidaException("El formato de la contraseña no es válido", CodigoError::PasswordInvalida);

        $usuario->setNombre($data->nombre);
        $usuario->setApellido($data->apellido);
        $usuario->setCUIT($data->CUIT);
        $usuario->setUsername($data->nickname);
        $usuario->setUpassword(strtoupper(sha1($data->password)));
        $usuario->setEmail($data->email);
        $usuario->setTelefonoFijo($data->telefonoFijo);
        $usuario->setTelefonoCelular($data->telefonoCelular);
        $usuario->setDireccionId($direccion->getId());
        $usuario->setGeneroId($data->generoId);
        $usuario->setRolId(Roles::USUARIO);
        $usuario->setFechaNacimiento($data->fechaNacimiento);
        $usuario->setGeolocalizacionId($geolocalizacion->getId());

        if (!$usuario->validarUsuario())
            throw new UsuarioInvalidoException("Los datos de Usuario ingresados son inválidos", CodigoError::UsuarioInvalido);

        if ($usuario->existeUsuarioDB())
            throw new EntidadDuplicadaException("Usuario Duplicado", CodigoError::EntidadDuplicada);

        if (!$usuario->insertarUsuario())
            throw new SQLInsertException("Error al insertar al usuario", CodigoError::ErrorInsertSQL);

        $session = new Session();

        $session->setId($usuario->getId());
        $session->setUserName(mb_convert_encoding($usuario->getUsername(), 'UTF-8', 'UTF-8'));
        $session->setRolId($usuario->getRolId());

        $_SESSION['session'] = serialize($session);

        echo json_encode($_SESSION['session']);
    }

    function cerrarSession()
    {
        unset($_SESSION['session']);
        unset($_SESSION['carrito']);

        if(isset($_COOKIE["session"])) {
            unset($_COOKIE["session"]);
            setcookie("session", null, -1, "/", apache_request_headers()["Host"]);
        }
        header("location: " . getBaseAddress());
    }


    function olvidePassword()
    {
        $this->layout = "layoutSeguridad";

        $d['title'] = Constantes::OLVIDEPASSWORDTITLE;

        $this->set($d);
        $this->render(Constantes::OLVIDEPASSWORDVIEW);
    }

    function renovarPassword($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $user = new Usuario();

        $user->setCUIT(0);
        if (FuncionesUtiles::esPalabraConNumeros($data->emailOrNick)) {
            $user->setUsername($data->emailOrNick);
            $user->setEmail(null);
        } else if (FuncionesUtiles::esEmailValido($data->emailOrNick)) {
            $user->setEmail($data->emailOrNick);
            $user->setUsername(null);
        } else {
            throw new EmailOrNickInvalidoException("El Email o Nickname insertado no son válidos", CodigoError::EmailOrNickInvalido);
        }

        if (!$user->existeUsuarioActivoDB()) {
            throw new UsuarioNoEncontradoException("El usuario que intenta renovar la contraseña no existe", CodigoError::UsuarioNoEncontrado);
        }

        $newPass = PasswordHelper::generarNuevoPassRandom();
        if (!$user->renovarPasword($newPass)) {
            throw new SQLUpdateException("Ocurrió un error al actualizar la contraseña", CodigoError::ErrorUpdateSQL);
        }

        $user->getUsuarioById($user->getId());

        if (!MailHelper::enviarMailRenovacionPassword($user->getEmail(), $newPass)) {
            throw new EnvioMailRenovacionPasswordFallidoException("No se ha podido enviar el mail para la renovación de password", CodigoError::EnvioMailRenovacionPasswordFallido);
        }

        echo json_encode(true);
    }
}

?>
