<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/bootstrap/css/bootstrap.min.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/fontawesome/css/all.min.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/alertifyjs/css/alertify.min.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/alertifyjs/css/themes/default.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/alertifyjs/css/themes/semantic.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/daterangepicker/daterangepicker.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/animate.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.theme.default.css" ?>">
    <link rel="shortcut icon" href="<?php echo getBaseAddress() . "Webroot/img/favicon.ico" ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo getBaseAddress() . "Webroot/img/favicon.ico" ?>" type="image/x-icon">
    <link href="<?php echo getBaseAddress() . "Webroot/css/shared/poppins.css"; ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/home/inicio.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/home/responsive.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/error/errorValidaciones.css" ?>">
    <link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/shared/layoutSeguridad.css" ?>">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <script src="<?php echo getBaseAddress() . "Webroot/lib/jquery/jquery-3.4.0.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/bootstrap/js/bootstrap.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/fontawesome/js/all.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/moment/moment-with-locales.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/jQuery-Mask-Plugin/dist/jquery.mask.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/daterangepicker/daterangepicker.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/alertifyjs/alertify.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/popper/popper.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/tooltip/tooltip.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/validate/validate.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/easing/easing.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/Isotope/isotope.pkgd.min.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.js"; ?>"></script>
    <script src="<?php echo getBaseAddress() . "Webroot/js/utilidades/utilidades.js"; ?>"></script>

    <script>
        const pathHome = "<?php echo getBaseAddress(); ?>";
    </script>

    <div class="bg-white d-flex justify-content-center px-5 py-3" id="logos">
        <div class="row w-75">
            <a href="<?php echo getBaseAddress();?>">
                <img class="img-fluid" id="logo" src="<?php echo getBaseAddress() . "Webroot/img/home/logoSeguridad.png" ?>">
                <img class="img-fluid" id="logoResponsive" src="<?php echo getBaseAddress() . "Webroot/img/home/logoResponsive3.png" ?>">
            </a>
        </div>
    </div>

    <main role="main">

        <div class="starter-template">

            <?php
            echo $content_for_layout;
            ?>

            <?php
            require_once ROOT . "Views/Shared/footer.php";
            ?>

        </div>

    </main>
</body>

</html>
