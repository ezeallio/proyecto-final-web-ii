<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 6/5/2019
 * Time: 21:08
 */

class FuncionesUtiles
{
    public static function esCadenaNoNulaOVacia($string)
    {
        return is_string($string) && $string && strlen($string) && strcmp($string, "");
    }

    public static function esMayorACero($int)
    {
        return $int > 0;
    }

    public static function esOracion($string)
    {
        return self::esCadenaNoNulaOVacia($string) && preg_match(Constantes::REGEXLETRASYESPACIO, $string);
    }

    public static function esOracionCompuesta($string)
    {
        return self::esCadenaNoNulaOVacia($string) && preg_match(Constantes::REGEXLETRASNUMEROSYESPACIO, $string);
    }

    public static function esPalabra($string)
    {
        return self::esCadenaNoNulaOVacia($string) && preg_match(Constantes::REGEXSOLOLETRAS, $string);
    }

    public static function esPalabraConNumeros($string)
    {
        return self::esCadenaNoNulaOVacia($string) && preg_match(Constantes::REGEXLETRASYNUMEROS, $string);
    }

    public static function esEmailValido($email)
    {
        return self::esCadenaNoNulaOVacia($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function esEntero($num)
    {
        return is_int($num) || is_long($num) || is_integer($num) || is_numeric($num);
    }

    public static function esDecimal($num)
    {
        return is_float($num) || is_double($num);
    }

    public static function esCadenaNumerica($string)
    {
        return ctype_digit($string);
    }

    public static function cmpById($a, $b)
    {
        return $a->getId() > $b->getId();
    }

    public static function cmpByNombre($a, $b)
    {
        return strcasecmp($a->getNombre(), $b->getNombre()) > 0;
    }
}

?>