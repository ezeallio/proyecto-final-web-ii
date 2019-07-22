<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 13/5/2019
 * Time: 01:39
 */

abstract class CodigoError
{
    const DireccionInvalida = 1;
    const ErrorInsertSQL = 2;
    const UsuarioInvalido = 3;
    const EntidadDuplicada = 4;
    const PasswordInvalida = 5;
    const GeolocalizacionInvalida = 6;
    const EmailOrNickInvalido = 7;
    const ProductoInvalido = 8;
    const ImagenNoInsertada = 9;
    const ErrorUpdateSQL = 13;
    const EnvioMailRenovacionPasswordFallido = 14;
    const UsuarioNoEncontrado = 15;
    const EstadoInvalido = 20;
    const ProductoNoEncontrado = 16;
    const CantidadProductoNegativa = 18;
    const ImagenPrincipalNoEncontrada = 30;
    const EliminarProducto = 33;
    const EliminacionMasivaImagen = 40;
    const MetodoNoEncontrado = 44;
    const UsuarioBaneado = 47;
    const ProductoDuplicadoEnCarrito = 50;
    const ErrorGetSql = 51;
    const CierreSession = 52;
    const UsuarioNuncaRealizoCompra = 60;
    const ReviewRealizadaPreviamente = 61;
}