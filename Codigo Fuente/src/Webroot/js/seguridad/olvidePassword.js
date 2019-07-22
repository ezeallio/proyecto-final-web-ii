const regexEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;

var inputEmailOrNick = $("#inputEmailOrNick");
var btnRecuperarPassword = $("#btnRecuperarPassword");
var errorEmailOrNick = $("#errorEmailOrNick");

function validarEmailOrNick() {
    var validacion = false;
    var emailOrNick = inputEmailOrNick.val();

    if(emailOrNick === null || emailOrNick.length === 0 || emailOrNick === "") {
        errorEmailOrNick.find("span").text("Ingrese su Nickname o Email");
        errorEmailOrNick.fadeIn("slow");
    } else if(!regexEmail.test(emailOrNick) && !regexLetrasYNumeros.test(emailOrNick)) {
        errorEmailOrNick.find("span").text("Email o Nickname inválido");
        errorEmailOrNick.fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

function recuperarPassword() {
    $(".error").fadeOut();
    $(".error").find("span").text("");

    if(validarEmailOrNick()) {
        $("input").prop('disabled', true);
        btnRecuperarPassword.prop('disabled', true);
        var obj = {};
        obj.emailOrNick = inputEmailOrNick.val();
        llamadaAjax(pathRenovarPassword, JSON.stringify(obj), true, "mostrarModalRenovacionPasswordExitosa", "mostrarModalRenovacionPasswordFallida");
    }
}

btnRecuperarPassword.click(function () {
    recuperarPassword();
});

function mostrarModalRenovacionPasswordExitosa(dummy) {
    $("input").prop('disabled', false);
    btnRecuperarPassword.prop('disabled', false);
    alertify.alert("¡Contraseña Renovada!", "Se ha enviado un mensaje a su casilla de mail con su nueva contraseña").setting("modal", false);
}

function mostrarModalRenovacionPasswordFallida(err) {
    $("input").prop('disabled', false);
    btnRecuperarPassword.prop('disabled', false);
    alertify.alert('Error en Renovación de Password', err).setting("modal", false);
}

$("input").keypress(function (e) {
    if(e.keyCode === 13) {
        recuperarPassword();
    }
});