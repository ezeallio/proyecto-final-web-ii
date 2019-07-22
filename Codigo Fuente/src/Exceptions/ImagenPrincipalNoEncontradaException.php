<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 9/6/2019
 * Time: 20:19
 */

class ImagenPrincipalNoEncontradaException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}