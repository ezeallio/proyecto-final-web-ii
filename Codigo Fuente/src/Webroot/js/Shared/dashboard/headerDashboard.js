var btnBuscarUsuario = $("#buscarUsuario");
var inputUsuarioBuscado = $("#inputUsuarioBuscado");
var errorUsuarioBuscado = $("#errorUsuarioBuscado");

function validarUsuarioBuscado() {

    var validacion = false;
    var usuarioBuscado = inputUsuarioBuscado.val();

    if(usuarioBuscado === null || usuarioBuscado.length === 0 || usuarioBuscado === "") {
        errorUsuarioBuscado.fadeIn("slow");
    }
    else {
        validacion = true;
    }

    return validacion;
}

btnBuscarUsuario.click(function () {
    var validacion = validarUsuarioBuscado();

    if (validacion != false){
        window.location.href = pathHome + "DashBoard/buscar/" + inputUsuarioBuscado.val();
    }

});

$("input").keypress(function (e) {
    if(e.keyCode === 13 && validarUsuarioBuscado()) {
        window.location.href = pathHome + "DashBoard/buscar/" + inputUsuarioBuscado.val();
    }
});