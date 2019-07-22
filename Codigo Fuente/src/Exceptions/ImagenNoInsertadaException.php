<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 28/5/2019
 * Time: 16:02
 */

class ImagenNoInsertadaException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}