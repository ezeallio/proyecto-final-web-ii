<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 26/5/2019
 * Time: 11:26
 */

class UsuarioInvalidoException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}