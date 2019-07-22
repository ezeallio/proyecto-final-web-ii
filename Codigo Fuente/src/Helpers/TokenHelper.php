<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 4/6/2019
 * Time: 10:33
 */

class TokenHelper
{
    public static function getToken()
    {
        return sha1(bin2hex(openssl_random_pseudo_bytes(16)));
    }
}