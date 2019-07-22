<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 29/6/2019
 * Time: 23:04
 */

class UsuarioNuncaRealizoCompraException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}