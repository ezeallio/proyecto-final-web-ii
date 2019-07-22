<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 28/5/2019
 * Time: 15:52
 */

class ProductoInvalidoException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}