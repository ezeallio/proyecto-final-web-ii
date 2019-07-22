<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 24/6/2019
 * Time: 21:55
 */

class ProductoNoEncontradoException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}