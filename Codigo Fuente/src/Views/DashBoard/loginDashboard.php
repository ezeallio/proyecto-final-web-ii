
<script>
    const pathAccionLoguearAdmin = "<?php echo getBaseAddress() . "DashBoard/loguearAdmin"; ?>";
</script>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header justify-content-center text-center"><img class="img-fluid" id="logo" src="<?php echo getBaseAddress() . "Webroot/img/dashboard/logoSeguridad.png" ?>"></div>
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmailOrNick">Nickname/Email</label>
                <input type="text" name="emailOrNick" id="inputEmailOrNick" class="form-control">
                <div id="errorNick" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su nombre de
                    usuario o Email
                </div>
                <div id="errorNick2" class="error"><i class="fas fa-exclamation-triangle"></i> Escriba su nick o email
                    de forma correcta
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword">Contraseña</label>
                <input type="password" class="form-control" name="password" id="inputPassword">
                <div id="errorPass" class="error"><i class="fas fa-exclamation-triangle"></i> Por favor ingrese su
                    contraseña
                </div>
                <div id="errorPass2" class="error"><i class="fas fa-exclamation-triangle"></i> Su contraseña debe tener
                    entre 6 a 15 digitos
                </div>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="recordarme" id="checkboxRecordarme"
                           value="1">
                    <small class="align-text-top">Recordarme</small>
                </label>
            </div>

            <div class="d-flex justify-content-center align-items-center my-3">
                <button type="submit" id="btnIngresarAdmin" class="btn btn-primary btn-block">Ingresar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/validacionLoginDashboard.js" ?>"></script>

</body>
