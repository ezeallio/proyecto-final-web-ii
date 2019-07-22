
const regexLetrasYNumerosYEspacios = /^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
const regexSOLONumeros = /^[0-9]+$/;

function validarNombreProducto() {

    var validacion = false;
    var nombreProducto = $('#inputNombreProducto').val();

    if (nombreProducto === null || nombreProducto === "" || nombreProducto.length === 0) {
        $("#errorNombreProducto").find("span").text("Ingrese el nombre del producto");
        $("#errorNombreProducto").fadeIn("slow");
    } else if (nombreProducto.length < 5 || nombreProducto.length > 50) {
        $("#errorNombreProducto").find("span").text("El nombre del producto debe tener entre 5 y 50 caracteres");
        $("#errorNombreProducto").fadeIn("slow");
    } else if (!regexLetrasYNumerosYEspacios.test(nombreProducto)) {
        $("#errorNombreProducto").find("span").text("El nombre del producto solo puede contener letras y numeros");
        $("#errorNombreProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarPrecioProducto() {

    var validacion = false;
    var precioProducto = $('#inputPrecioProducto').val();

    if (precioProducto === null || precioProducto.length === 0) {
        $("#errorPrecioProducto").find("span").text("Ingrese el precio del producto");
        $("#errorPrecioProducto").fadeIn("slow");
    } else if (!regexSOLONumeros.test(precioProducto)) {
        $("#errorPrecioProducto").find("span").text("Ingrese solo numeros en el precio");
        $("#errorPrecioProducto").fadeIn("slow");
    } else if (precioProducto.length > 8) {
        $("#errorPrecioProducto").find("span").text("El Precio maximo de un producto es de 8 digitos");
        $("#errorPrecioProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarCantidadProducto() {

    var validacion = false;
    var cantidadProducto = $('#inputCantidadProducto').val();

    if (cantidadProducto === null || cantidadProducto.length === 0) {
        $("#errorCantidadProducto").find("span").text("Ingrese la cantidad del producto");
        $("#errorCantidadProducto").fadeIn("slow");
    } else if (!regexSOLONumeros.test(cantidadProducto)) {
        $("#errorCantidadProducto").find("span").text("Ingrese solo numeros en la cantidad");
        $("#errorCantidadProducto").fadeIn("slow");
    } else if (cantidadProducto > 50) {
        $("#errorCantidadProducto").find("span").text("El maximo de productos que puede cargar es de 50");
        $("#errorCantidadProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarCategoriaProducto() {

    var validacion = false;
    var categoriaProducto = $('#selectCategoriaProducto').val();

    if (categoriaProducto === null || categoriaProducto === 0) {
        $("#errorCategoriaProducto").find("span").text("Elija una de las categorias disponibles");
        $("#errorCategoriaProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarEstadoProducto() {

    var validacion = false;
    var estadoProducto = $('#selectEstadoProducto').val();

    if (estadoProducto === null || estadoProducto === 0) {
        $("#errorEstadoProducto").find("span").text("Elija una de los estados disponibles");
        $("#errorEstadoProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarMetodoProducto() {

    var validacion = false;
    var metodoProducto = $('#selectMetodoProducto').val();

    if (metodoProducto === null || metodoProducto === 0) {
        $("#errorMetodoProducto").find("span").text("Elija un metodo de Entrega");
        $("#errorMetodoProducto").fadeIn("slow");
    } else {
        validacion = true;
    }
    return validacion;
}

function validarDetalleEntregaProducto() {

    var validacion = false;
    var metodoProducto = $('#selectMetodoProducto').val();
    var detalleEntregaProducto = $('#inputDetalleEntregaProducto').val();

    if (metodoProducto == 1){

        if (detalleEntregaProducto === null || detalleEntregaProducto === "" || detalleEntregaProducto.length === 0) {
            $("#errorDetalleEntregaProducto").find("span").text("Ingrese el punto de entrega");
            $("#errorDetalleEntregaProducto").fadeIn("slow");
        }else if (detalleEntregaProducto.length < 5 || detalleEntregaProducto.length > 50) {
            $("#errorDetalleEntregaProducto").find("span").text("El punto de entrega debe tener entre 5 y 50 caracteres");
            $("#errorDetalleEntregaProducto").fadeIn("slow");}
        else {
            validacion = true;
        }
    }
    else {
        validacion = true;
    }
    return validacion;
}


function validaDescripcionProducto() {

    var validacion = false;
    var descripcionProducto = $('#textareaDescripcionProducto').val();

    if (descripcionProducto.length > 200) {
        $("#errorDescripcionProducto").find("span").text("Su descripcion solo puede tener 200 caracteres");
        $("#errorDescripcionProducto").fadeIn("slow");
        return false;
    } else {
        validacion = true;
    }

    return validacion;
}

function validarAltaModificarProducto() {

    return validarNombreProducto() &&
        validarPrecioProducto() &&
        validarCantidadProducto() &&
        validaDescripcionProducto() &&
        validarCategoriaProducto() &&
        validarEstadoProducto() &&
        validarMetodoProducto() &&
        validarDetalleEntregaProducto() &&
        validarDetalleEntregaProducto();
}

var maxlen = 200;

$("#textareaDescripcionProducto").keyup(function (e) {

    var txtLen = $(this).val().length;

    if (txtLen <= maxlen) {
        var remain = 0 + txtLen;

        $("#caracteres").text(remain);
    }
});


$("#textareaDescripcionProducto").keydown(function (e) {
    var keycode = e.keyCode;

    var txtLen = $(this).val().length;

    if (txtLen >= maxlen) {

        if (keycode != 8) {
            return false;
        }
    }
});


