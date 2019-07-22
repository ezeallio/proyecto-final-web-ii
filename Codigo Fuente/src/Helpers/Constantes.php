<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 11/5/2019
 * Time: 10:23
 */

abstract class Constantes
{
    //Vistas
    const INICIOVIEW = "inicio";
    const REGISTRARVIEW = "registrar";
    const LOGINVIEW =  "login";
    const PRODUCTOSVIEW = "misProductos";
    const ALTAPRODUCTO = "altaProducto";
    const EDITARPRODUCTO = "editarProducto";
    const OLVIDEPASSWORDVIEW = "olvidePassword";
    const PUBLICACIONVIEW = "publicacion";
    const BUSQUEDAVIEW = "productos";
    const CARRITOCOMPRASVIEW = "miCarrito";
    const COMPRAEXITOSAVIEW = "compraExitosa";
    const COMPRASVIEW = "misCompras";
    const INICIODASHBOARDVIEW = "inicioDashboard";
    const LOGINDASHBOARVIEW = "loginDashboard";
    const BUSCARUSUARIODAHBOARDVIEW = "buscarUsuario";
    const FACTURACIONDASHBOARDVIEW = "facturacionDashboard";
    const MIPERFILVIEW = "miPerfil";
    const MISFACTURACIONESVIEW = "misFacturaciones";
    const FACTURACIONEXITOSAVIEW = "facturacionExitosa";
    const ULTIMOSBANEADOSVIEW = "ultimosBaneados";
    const ESTADISTICASDASHBOARDVIEW = "estadisticasDashboard";
    const FACTURACIONMENSUALDASHBOARDVIEW  = "facturacionMensualDashboard";
    //Acciones
    const CERRARSESIONACTION = "cerrarSession";


    //Títulos
    const MAINTITLE = "ShopLine";
    const REGISTRARTITLE = "Registrar en ShopLine";
    const LOGINTITLE = "Iniciar Sesion en ShopLine";
    const PRODUTOSTITLE = "Mis Ventas";
    const AGREGARPRODUCTOTITLE = "Agregar Producto";
    const EDITARPRODUCTOTITLE = "Editar Producto";
    const PUBLICACIONTITLE = "Publicacion";
    const BUSQUEDATITLE = "Producto Buscado";
    const CARRITOCOMPRASTITLE = "Mi carrito";
    const COMPRAEXITOSATITLE = "Compra Exitosa";
    const COMPRASTITLE = "Mis Compras";
    const DASHBOARDTITLE = "Admin Shopline";
    const LOGINDASHBOARDTITLE = "Inicio Sesion Admin";
    const BUSCARUSUARIODASHBOARDTITLE = "Usuario Buscado";
    const FACTURACIONDASHBOARDTITLE = "Facturaciones";
    const MIPERFILTITLE = "Mi Perfil";
    const MISFACTURACIONESTITLE = "Mis Facturaciones";
    const FACTURACIONEXITOSATITLE = "Facturacion exitosa";
    const ULTIMOSBANEADOSTITLE = "Ultimos baneados";
    const ESTADISTICASDASHBOARDTITLE = "Estadisticas";
    const FACTURACIONMENSUALDASHBOARDTITLE = "Facturaciones Mensuales";

    const OLVIDEPASSWORDTITLE = "Olvidé Mi Contraseña";


    //Regex
    const REGEXLETRASYNUMEROS = "/^[0-9a-zA-Z]+$/";
    const REGEXEMAIL = "/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/";
    const REGEXSOLOLETRAS = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    const REGEXLETRASYESPACIO = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    const REGEXLETRASNUMEROSYESPACIO = "/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    const REGEXSOLONUMEROS = "/^[0-9]+$/";

    //Comparadores
    const CMPBYID = "FuncionesUtiles::cmpById";
    const CMPBYNOMBRE = "FuncionesUtiles::cmpByNombre";

    //Propiedades
    const ID = "Id";
}