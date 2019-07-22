<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/olvidePassword.css"; ?>">

<script>
    const pathRenovarPassword = "<?php echo getBaseAddress() . "Seguridad/renovarPassword"; ?>";
</script>
<div class="col-lg-3 col-sm-5 col-6 shadow border rounded mx-auto p-4 my-5 bg-white">
    <div class="form-group">
        <label for="inputEmailOrNick">Nickname/Email</label>
        <input type="text" name="inputEmailOrNick" id="inputEmailOrNick" class="form-control" required>
        <div id="errorEmailOrNick" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
        </div>
    </div>
    <a class="d-flex justify-content-center align-items-center mt-4">
        <button type="button" name="btnRecuperarPassword" id="btnRecuperarPassword" class="btn btn-primary">
            Recuperar Contraseña
        </button>
    </a>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/olvidePassword.js"; ?>"></script>