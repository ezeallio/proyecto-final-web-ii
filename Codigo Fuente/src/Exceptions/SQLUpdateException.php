<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 25/5/2019
 * Time: 17:04
 */

class SQLUpdateException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}