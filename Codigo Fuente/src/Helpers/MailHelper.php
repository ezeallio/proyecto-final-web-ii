<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 25/5/2019
 * Time: 17:20
 */

class MailHelper
{
    public static function enviarMailRenovacionPassword($email, $newPass)
    {
        // Varios destinatarios
        $para = $email;

        // título
        $titulo = "ShopLine - Renovación de Contraseña";

        // mensaje
        $mensaje = "
                <html lang='es'>
                <head>
                  <title>Recordatorio de cumpleaños para Agosto</title>
                </head>
                <body>
                  <p>Su nueva contraseña es <strong>" . $newPass . "</strong></p>
                  <p>Acceda a la pantalla de modificar perfil para poder cambiarla</p>
                </body>
                </html>
                ";

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Cabeceras adicionales
        $cabeceras .= "To: " . $email . "\r\n";
        $cabeceras .= 'From: ShopLine <shoplinepw2@gmail.com>' . "\r\n";

        // Enviarlo
        return mail($para, $titulo, $mensaje, $cabeceras);
    }
}