<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 14:55
 */

class CantidadProductoNegativaException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}