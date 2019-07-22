<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 13/5/2019
 * Time: 20:28
 */

class PasswordInvalidaException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}