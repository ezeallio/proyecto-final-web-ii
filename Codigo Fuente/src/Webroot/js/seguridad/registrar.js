const nombresMeses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre",
    "Diciembre"
];

const nombresDias = ["D", "L", "M", "M", "J", "V", "S"];

var inputFechaNacimiento = $("#inputFechaNacimiento");
var btnInputFechaNacimiento = $("#btnInputFechaNacimiento");
var selectProvincia = $("#selectProvincia");
var selectPartido = $("#selectPartido");
var selectLocalidad = $("#selectLocalidad");
var rowPartidoLocalidadSelects = $("#rowPartidoLocalidadSelects");

inicializarDatePicker();

function inicializarSelectPartido(provinciaId) {
    var obj = {};
    obj.provinciaId = parseInt(provinciaId, 10);
    llamadaAjax(pathGetPartidosByProvinciaId, JSON.stringify(obj), true, "cargarSelectPartido", "dummy");
}

function inicializarSelectLocalidad(partidoId) {
    var obj = {};
    obj.partidoId = parseInt(partidoId, 10);
    llamadaAjax(pathGetLocalidadesByPartidoId, JSON.stringify(obj), true, "cargarSelectLocalidad", "dummy");
}

function cargarSelectLocalidad(localidades) {
    limpiarSelect(selectLocalidad);
    $.each(localidades, function(i, localidad) {
        var option = $("<option>");
        option.val(localidad.id);
        option.text(localidad.nombre);
        selectLocalidad.append(option);
    });
    selectLocalidad.prop('disabled', false);
    rowPartidoLocalidadSelects.removeClass("d-none");
    btnRegistrar.prop('disabled', false);
}

function cargarSelectPartido(partidos) {
    limpiarSelect(selectPartido);
    $.each(partidos, function(i, partido) {
        var option = $("<option>");
        option.val(partido.id);
        option.text(partido.nombre);
        selectPartido.append(option);
    });
    inicializarSelectLocalidad(selectPartido.val());
    selectPartido.prop('disabled', false);
}

selectPartido.change(function() {
    btnRegistrar.prop('disabled', true);
    selectLocalidad.prop('disabled', true);
    inicializarSelectLocalidad($(this).val());
});

function limpiarSelect(select) {
    select.find('option').remove().end();
}

selectProvincia.change(function() {
    btnRegistrar.prop('disabled', true);
    selectPartido.prop('disabled', true);
    selectLocalidad.prop('disabled', true);
    inicializarSelectPartido($(this).val());
});

btnInputFechaNacimiento.click(function () {
    inputFechaNacimiento.data("daterangepicker").toggle();
});

function showPassword(btn) {
    var pwd = $(btn).parent().siblings(".pwd");
    var eye = $(btn).children();

    if(pwd.attr("type") === "password") {
        pwd.attr("type", "text");
        eye.removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
        pwd.attr("type", "password");
        eye.removeClass("fa-eye-slash").addClass("fa-eye");
    }
}

function inicializarDatePicker() {

    inputFechaNacimiento.daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        opens: "left",
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        startDate: moment().format("DD/MM/YYYY"),
        locale: {
            format: "DD/MM/YYYY",
            daysOfWeek: nombresDias,
            monthNames: nombresMeses
        }
    });

    inputFechaNacimiento.mask("99/99/9999", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        },
        placeholder: "__/__/____",
        selectOnFocus: true
    });
}

//Oculta el spinner de los input number
$(document).ready(function ($) {

    // Disable scroll when focused on a number input.
    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel', function (e) {
            e.preventDefault();
        });
    });

    // Restore scroll on number inputs.
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel');
    });

    // Disable up and down keys.
    $('form').on('keydown', 'input[type=number]', function (e) {
        if (e.which == 38 || e.which == 40)
            e.preventDefault();
    });

});