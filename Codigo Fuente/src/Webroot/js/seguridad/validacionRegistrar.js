const regexEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
const regexSoloLetras = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;
const regexSoloNumeros = /^[0-9]+$/;
const regexLetrasYEspacio = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;

var inputNombre = $('#inputNombre');
var inputApellido = $('#inputApellido');
var inputCUIT = $("#inputCUIT");
var inputNickname = $('#inputNickname');
var inputPassword = $('#inputPassword');
var inputRePassword = $('#inputRePassword');
var inputEmail = $('#inputEmail');
var inputFechaNacimiento = $('#inputFechaNacimiento');
var inputTelefonoFijo = $("#inputTelefonoFijo");
var inputTelefonoCelular = $("#inputTelefonoCelular");
var inputCalle = $("#inputCalle");
var inputAltura = $("#inputAltura");
var inputPiso = $("#inputPiso");
var inputDepartamento = $("#inputDepartamento");
var selectGenero = $("#selectGenero");
var selectProvincia = $("#selectProvincia");
var selectPartido = $("#selectPartido");
var selectLocalidad = $("#selectLocalidad");
var btnRegistrar = $("#btnRegistrar");
var registrarModal = $("#registrarModal");
var registrarModalLabel = $("#registrarModalLabel");
var geolocalizacion = null;

function validarNombre() {
    var nombre = inputNombre.val();

    var validacion = false;

    if (nombre == null || nombre.length === 0 || nombre === "") {
        $("#errorNombre").fadeIn("slow");
    } else if (nombre.length < 3) {
        $("#errorNombre2").fadeIn("slow");
    } else if (nombre.length > 15) {
        $("#errorNombre3").fadeIn("slow");
    } else if (!regexSoloLetras.test(nombre)) {
        $("#errorNombre4").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarApellido() {
    var apellido = inputApellido.val();

    var validacion = false;

    if (apellido == null || apellido.length === 0 || apellido === "") {
        $("#errorApellido").fadeIn("slow");
    } else if (apellido.length < 3) {
        $("#errorApellido2").fadeIn("slow");
    } else if (apellido.length > 15) {
        $("#errorApellido3").fadeIn("slow");
    } else if (!regexSoloLetras.test(apellido)) {
        $("#errorApellido4").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarCUIT() {

    var cuit = inputCUIT.val();

    if (cuit.length != 11) {
        $("#errorCUIT").fadeIn("slow");
        return false;
    }

    var acumulado = 0;
    var digitos = cuit.split("");
    var digito = digitos.pop();

    for (var i = 0; i < digitos.length; i++) {
        acumulado += digitos[9 - i] * (2 + (i % 6));
    }

    var verif = 11 - (acumulado % 11);
    if (verif == 11) {
        verif = 0;
    }

    var validacion = false;

    if(digito != verif){
        $("#errorCUIT").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarNickname() {
    var nickname = inputNickname.val();

    var validacion = false;

    if (nickname == null || nickname.length === 0 || nickname === "") {
        $("#errorNickname").fadeIn("slow");
    } else if (nickname.length < 5) {
        $("#errorNickname2").fadeIn("slow");
    } else if (nickname.length > 15) {
        $("#errorNickname3").fadeIn("slow");
    } else if (!regexLetrasYNumeros.test(nickname)) {
        $("#errorNickname4").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarPassword() {
    var password = inputPassword.val();
    var rePassword = inputRePassword.val();

    var validacion = false;

    if (password == null || password.length === 0 || password === "") {
        $("#errorPassword").fadeIn("slow");
    } else if (password.length < 6 || password.length > 15) {
        $("#errorPassword2").fadeIn("slow");
    } else if (!regexLetrasYNumeros.test(password)) {
        $("#errorPassword3").fadeIn("slow");
    }

    if (rePassword == null || rePassword.length === 0 || rePassword === "") {
        $("#errorRePassword").fadeIn("slow");
    } else if (password !== rePassword) {
        $("#errorRePassword2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarEmail() {
    var email = inputEmail.val();

    var validacion = false;

    if (email == null || email.length === 0 || email === "") {
        $("#errorEmail").fadeIn("slow");
    } else if (!regexEmail.test(email)) {
        $("#errorEmail2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarFechaNacimiento() {
    var fechaNacimiento = inputFechaNacimiento.val();

    var validacion = false;

    if (!moment(fechaNacimiento, "DD/MM/YYYY").isValid()) {
        $("#errorFechaNacimiento").fadeIn("slow");
    } else if (Math.round(moment.duration(moment().diff(moment(fechaNacimiento, "DD/MM/YYYY"))).asYears()) < 18) {
        $("#errorFechaNacimiento2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarTelefonoCelular() {
    var telefonoCelular = inputTelefonoCelular.val();

    var validacion = false;

    if (telefonoCelular == null || telefonoCelular.length === 0 || telefonoCelular === "") {
        $("#errorTelfonoCelular").fadeIn("slow");
    } else if (telefonoCelular.length !== 10 || !regexSoloNumeros.test(telefonoCelular)) {
        $("#errorTelfonoCelular2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarTelefonoFijo() {
    var telefonoFijo = inputTelefonoFijo.val();

    var validacion = false;

    if (telefonoFijo == null || telefonoFijo.length === 0 || telefonoFijo === "") {
        $("#errorTelfonoFijo").fadeIn("slow");
    } else if (telefonoFijo.length !== 8 || !regexSoloNumeros.test(telefonoFijo)) {
        $("#errorTelfonoFijo2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarCalle() {
    var calle = inputCalle.val();

    var validacion = false;

    if (calle == null || calle.length === 0 || calle === "") {
        $("#errorCalle").fadeIn("slow");
    } else if (!regexLetrasYEspacio.test(calle)) {
        $("#errorCalle2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarAltura() {
    var altura = inputAltura.val();

    var validacion = false;

    if (altura == null || altura.length === 0 || altura === "") {
        $("#errorAltura").fadeIn("slow");
    } else if (altura.length > 5 || !regexSoloNumeros.test(altura)) {
        $("#errorAltura2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarPisoYDepto() {
    var piso = inputPiso.val();
    var departamento = inputDepartamento.val();

    var validacion = false;

    if ((piso == null || piso.length === 0 || piso === "") && (departamento != null && departamento.length > 0 && departamento !== "")) {
        $("#errorPiso").fadeIn("slow");
    } else if ((piso != null && piso.length > 0 && piso !== "") && (departamento == null || departamento.length === 0 || departamento === "")) {
        $("#errorDepartamento").fadeIn("slow");
    } else if (
        (piso != null && piso.length > 0 && piso !== "")
        && (departamento != null && departamento.length > 0 && departamento !== "")
        && !regexSoloNumeros.test(piso)
    ) {
        $("#errorPiso2").fadeIn("slow");
    } else if (
        (piso != null && piso.length > 0 && piso !== "")
        && (departamento != null && departamento.length > 0 && departamento !== "")
        && !regexSoloLetras.test(departamento)
    ) {
        $("#errorDepartamento2").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarProvincia() {
    var provincia = selectProvincia.val();
    var validacion = false;

    if(provincia === null || provincia === 0) {
        $("#errorProvincia").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarPartido() {
    var partido = selectPartido.val();
    var validacion = false;

    if(partido === null || partido === 0) {
        $("#errorPartido").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarLocalidad() {
    var localidad = selectLocalidad.val();
    var validacion = false;

    if(localidad === null || localidad === 0) {
        $("#errorLocalidad").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function validarGenero() {
    var genero = selectGenero.val();
    var validacion = false;

    if(genero === null || genero === 0) {
        $("#errorGenero").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function saveGeolocationOnMemory(position) {
    geolocalizacion = {};
    geolocalizacion.latitud = position.coords.latitude;
    geolocalizacion.longitud = position.coords.longitude;
    return geolocalizacion;
}

function showGeolocationMessageError() {
    alertify.alert('Error en Geolocalización', "Para continuar, debe permitir al navegador acceder a su ubicación");
    geolocalizacion = null;
    return geolocalizacion;
}

function getLocation() {

    return new Promise(function (resolve, reject) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                resolve(saveGeolocationOnMemory(position));
            }, function () {
                reject(showGeolocationMessageError());
            });
        } else {
            reject(showGeolocationMessageError());
        }
    });
}

function validarGeolocalizacion(geo) {
    return geo != null;
}

function validarFormularioRegistracion() {
    return validarNombre()
        && validarApellido()
        && validarCUIT()
        && validarFechaNacimiento()
        && validarNickname()
        && validarEmail()
        && validarPassword()
        && validarTelefonoFijo()
        && validarTelefonoCelular()
        && validarGenero()
        && validarProvincia()
        && validarPartido()
        && validarLocalidad()
        && validarCalle()
        && validarAltura()
        && validarPisoYDepto();
}

function registrarUsuario() {
    $("input").prop('disabled', true);
    btnRegistrar.prop('disabled', true);
    var obj = {};
    obj.geolocalizacion = geolocalizacion;
    obj.nombre = inputNombre.val();
    obj.apellido = inputApellido.val();
    obj.CUIT = inputCUIT.val();
    obj.nickname = inputNickname.val();
    obj.email = inputEmail.val();
    obj.password = inputPassword.val();
    obj.fechaNacimiento = inputFechaNacimiento.val();
    obj.telefonoFijo = inputTelefonoFijo.val();
    obj.telefonoCelular = inputTelefonoCelular.val();
    obj.generoId = $("#selectGenero").val();
    obj.provinciaId = $("#selectProvincia").val();
    obj.partidoId = $("#selectPartido").val();
    obj.localidadId = $("#selectLocalidad").val();
    obj.calle = inputCalle.val();
    obj.altura = inputAltura.val();
    obj.piso = inputPiso.val();
    obj.departamento = inputDepartamento.val();
    llamadaAjax(pathValidarRegistrar, JSON.stringify(obj), true, "mostrarModalRegistracionExitosa", "mostrarModalError");
}

function realizarRegistracion() {
    $(".error").fadeOut();

    getLocation().then(function (res) {
        var validacion = validarGeolocalizacion(res) && validarFormularioRegistracion();

        if (validacion) {
            registrarUsuario();
        }
    }).catch(function (err) {
        alertify.alert('Error en Geolocalización', "Ha ocurrido un error y no se ha podido registrar su ubicación. Por favor, dé permisos a su navegador y vuelva a intentar")
    });
}

btnRegistrar.click(function () {
    realizarRegistracion();
});

$("input").keypress(function (e) {
    if(e.keyCode === 13) {
        realizarRegistracion();
    }
});

function mostrarModalRegistracionExitosa(dummy) {
    registrarModalLabel.text("¡Registración Exitosa!");
    registrarModal.find(".btn-secondary").addClass('d-none');
    registrarModal.find(".btn-primary").removeClass('d-none');
    registrarModal.find(".modal-body").text("Presione Continuar, o espere unos instantes y será redirigido");
    registrarModal.modal('show');
    setTimeout(function () {
        window.location.href = pathHome;
    }, 5000);
}

function mostrarModalError(err) {
    registrarModalLabel.text("Error de Registración");
    registrarModal.find(".btn-secondary").removeClass('d-none');
    registrarModal.find(".btn-primary").addClass('d-none');
    registrarModal.find(".modal-body").text(err);
    registrarModal.modal('show');
    $("input").prop('disabled', false);
    btnRegistrar.prop('disabled', false);
}