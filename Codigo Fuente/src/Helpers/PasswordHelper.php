<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 25/5/2019
 * Time: 17:16
 */

class PasswordHelper
{
    public static function crearSemillaDeMicrosegundos()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float)$sec + ((float)$usec * 100000);
    }

    public static function generarNuevoPassRandom()
    {
        mt_srand(self::crearSemillaDeMicrosegundos());
        return mt_rand(100000, 999999999999999);
    }

    public static function validarPassword($pass)
    {
        return FuncionesUtiles::esPalabraConNumeros($pass) && ($cantLetras = strlen($pass)) <= 15 && $cantLetras >= 6;
    }

    public static function confirmarPassword($pass, $repass)
    {
        return self::validarPassword($pass) && self::validarPassword($repass) && $pass === $repass;
    }
}