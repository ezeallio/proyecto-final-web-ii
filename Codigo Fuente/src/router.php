<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = substr(trim($url), strripos(trim($url), "/src/"));
        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 2);

        if (!strcmp($explode_url[0], ""))
        {
            $request->controller = "Home";
            $request->action = "inicio";
            $request->params = [];
        }
        else if(self::isSecurityController($explode_url[0]) && !self::isCloseSessionAction($explode_url[1]) && isset($_SESSION["session"]))
        {
            header("Location: " . getBaseAddress());
        }
        else if (((self::isProductController($explode_url[0]) && !self::isPostAction($explode_url[1]) && !self::isGetReviewsAction($explode_url[1]) && !self::isMostrarMas($explode_url[1])) || self::isCartController($explode_url[0]) || self::isBuyController($explode_url[0])) &&  !isset($_SESSION["session"]))
        {
            header("Location: " . getBaseAddress() . "Seguridad/login");
        }
        else if ((self::isDashboardController($explode_url[0])) && !self::isDashboardLoginAction($explode_url[1]) && !self::isDashboardLoginAdminAction($explode_url[1]) && !isset($_SESSION["sessionAdmin"]))
        {
            header("Location: " . getBaseAddress() . "DashBoard/login");
        }
        else if(self::isDashboardController($explode_url[0]) && (self::isDashboardLoginAction($explode_url[1]) || self::isDashboardLoginAdminAction($explode_url[1])) && isset($_SESSION["sessionAdmin"]))
        {
            header("Location: " . getBaseAddress() . "DashBoard/inicio");
        }
        else
        {
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
            if($_POST)
                $request->params = array_merge($request->params, $_POST);
        }
    }

    private static function isProductController($controller)
    {
        return !strcasecmp($controller, 'Productos');
    }

    private static function isDashboardController($controller)
    {
        return !strcasecmp($controller, 'DashBoard');
    }

    private static function isDashboardLoginAction($action)
    {
        return !strcasecmp($action, 'login');
    }

    private static function isDashboardLoginAdminAction($action)
    {
        return !strcasecmp($action, 'loguearAdmin');
    }

    private static function isBuyController($controller)
    {
        return !strcasecmp($controller, 'Compra');
    }

    private static function isCartController($controller)
    {
        return !strcasecmp($controller, 'Carrito');
    }

    private static function isSecurityController($controller)
    {
        return !strcasecmp($controller, 'Seguridad');
    }

    private static function isCloseSessionAction($action)
    {
        return !strcasecmp($action, Constantes::CERRARSESIONACTION);
    }

    private static function isPostAction($action)
    {
        return !strcasecmp($action, 'publicacion');
    }

    private static function isGetReviewsAction($action)
    {
        return !strcasecmp($action, 'getReviews');
    }

    private static function isMostrarMas($action)
    {
        return !strcasecmp($action, 'mostrarMas');
    }
}
?>