<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 11/6/2019
 * Time: 19:20
 */

class EliminarProductoException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}