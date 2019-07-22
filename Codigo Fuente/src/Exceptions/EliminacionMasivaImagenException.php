<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 11/6/2019
 * Time: 19:17
 */

class EliminacionMasivaImagenException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}