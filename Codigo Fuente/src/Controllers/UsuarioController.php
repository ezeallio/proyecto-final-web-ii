<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 10:55
 */

class UsuarioController extends Controller
{
    function miPerfil()
    {
        $d["title"] = Constantes::MIPERFILTITLE;

        $sesion = unserialize($_SESSION["session"]);

        $usuario = new Usuario();
        $direccion = new Direccion();
        $localidad = new Localidad();
        $partido = new Partido();
        $provincia = new Provincia();

        $d["usuario"] = $usuario->traerUsuario($sesion->getId());
        $direccion->traerDireccion($d["usuario"]["DireccionId"]);
        $d["direccion"] = $direccion;
        $localidad->getById($direccion->getLocalidadId());
        $d["localidad"] = $localidad;
        $partido->getById($localidad->getPartidoId());
        $d["partido"] = $partido;
        $provincia->getById($partido->getProvinciaId());
        $d["provincia"] = $provincia;

        $this->set($d);
        $this->render(Constantes::MIPERFILVIEW);
    }

    function misFacturaciones()
    {
        $d["title"] = Constantes::MISFACTURACIONESTITLE;

        $sesion = unserialize($_SESSION["session"]);
        $facturacion = new Facturacion();
        $facturaciones = [];

        $facturaciones = $facturacion->traerListaDeFacturaciones($sesion->getId());

        $d["facturaciones"] = $facturaciones;

        $this->set($d);
        $this->render(Constantes::MISFACTURACIONESVIEW);
    }

}