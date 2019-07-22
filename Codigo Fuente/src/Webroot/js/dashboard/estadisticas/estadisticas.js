var divProductosBuscados = $('#productosMasBuscados');
var divCategoriasFavoritas = $('#categoriasFavoritas');
var divProductosVendidos = $('#masVendido');
var divMontosInvolucrados = $('#masAcumulado');

$(document).ready(function ($) {
    divProductosBuscados.hide();
    divCategoriasFavoritas.hide();
    divProductosVendidos.hide();
    divMontosInvolucrados.hide();
});

function obtenerNombres(productosDto) {
    var nombres = [];
    $.each(productosDto, function(i, producto) {
        nombres[i] = producto.nombre;
    });
    return nombres;
}

function obtenerCantidades(productosDto) {
    var cantidades = [];
    $.each(productosDto, function(i, producto) {
        cantidades[i] = producto.cantidad;
    });
    return cantidades;
}

function exportarGraficoPdf(idCanvas, nombreArchivo) {
    var myBarChar = $('#'+idCanvas)[0];
    var barChartDataUrl = myBarChar.toDataURL("img/png");
    var doc = new jsPDF('l', 'mm', 'a4');
    doc.addImage(barChartDataUrl, 'JPEG', 50, 50, 200, 100);
    doc.save(nombreArchivo);
}

function buscarEstadisticas(cantidad, tipoEstadistica, idCanvas, idBoton) {
    var obj = {}
    obj.cantidad = cantidad;
    obj.tipoEstadistica = tipoEstadistica;
    obj.idCanvas = idCanvas;
    obj.idBoton = idBoton;
    var metodo = "graficoBarras";
    if(tipoEstadistica == 2 || tipoEstadistica == 3){
        metodo = "graficoTorta";
    }
    llamadaAjax(pathHome + 'Dashboard/buscarEstadisticas', JSON.stringify(obj), true, metodo, "estadisticaVacia");
}

function graficoBarras(estadisticasDto) {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var nombresProductos = obtenerNombres(estadisticasDto);
    var cantidadesProductos = obtenerCantidades(estadisticasDto);
    var cantidadMaxima = parseInt(cantidadesProductos[0]);
    var divContenedorCanvas = $('#'+estadisticasDto[0].idCanvas).parent();
    // Bar Chart Example
    resetCanvas(estadisticasDto[0].idCanvas, divContenedorCanvas.attr('id'));
    var ctx = document.getElementById(estadisticasDto[0].idCanvas);

    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresProductos,

            datasets: [{
                label: estadisticasDto[0].label,
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: cantidadesProductos,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: cantidadMaxima,
                        maxTicksLimit: cantidadMaxima * 3
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

    var divCard = divContenedorCanvas.parent();
    var divGrafico = divCard.parent();
    var divContendor = divGrafico.parent();
    var button = $('#'+estadisticasDto[0].idBoton);
    divContendor.show();
    divGrafico.show();
    var idDiv = "'"+divContendor.attr('id')+"'";
    var idButton = "'"+estadisticasDto[0].idBoton+"'";
    var cantidad = 6;
    var tipoEstadistica = "'"+estadisticasDto[0].tipoEstadistica+"'";
    var idCanvas = "'"+estadisticasDto[0].idCanvas+"'";
    button.text('Ocultar');
    button.attr('onclick', 'ocultarGrafico('+idDiv+','+idButton+','+tipoEstadistica+','+cantidad+','+idCanvas+')');

}

function resetCanvas(idCanvas, idContenedorCanvas) {
    $('#'+idCanvas).remove();
    var canvas = $('<canvas width="50%" height="25">');
    canvas.attr('id',idCanvas);// this is my <canvas> element
    $('#'+idContenedorCanvas).append(canvas);
}

function graficoTorta(estadisticasDto) {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var nombresProductos = obtenerNombres(estadisticasDto);
    var cantidadesProductos = obtenerCantidades(estadisticasDto);
    var divContenedorCanvas = $('#'+estadisticasDto[0].idCanvas).parent();
    // Bar Chart Example
    resetCanvas(estadisticasDto[0].idCanvas, divContenedorCanvas.attr('id'));
    var ctx = document.getElementById(estadisticasDto[0].idCanvas);
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: nombresProductos,
            datasets: [{
                data: cantidadesProductos,
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#A716A3', '#A74811',],
            }],
        },
    });
    var divCard = divContenedorCanvas.parent();
    var divGrafico = divCard.parent();
    var divContendor = divGrafico.parent();
    var button = $('#'+estadisticasDto[0].idBoton);
    divContendor.show();
    divGrafico.show();
    var idDiv = "'"+divContendor.attr('id')+"'";
    var idButton = "'"+estadisticasDto[0].idBoton+"'";
    var cantidad = 6;
    var tipoEstadistica = "'"+estadisticasDto[0].tipoEstadistica+"'";
    var idCanvas = "'"+estadisticasDto[0].idCanvas+"'";
    button.text('Ocultar');
    button.attr('onclick', 'ocultarGrafico('+idDiv+','+idButton+','+tipoEstadistica+','+cantidad+','+idCanvas+')');

}

function ocultarGrafico(idDiv, idButton, tipoEstadistica, cantidad, idCanvas) {
    var divContenedor = $('#'+idDiv);
    var button = $('#'+idButton);

    divContenedor.hide();
    button.text('Mostrar');
    button.attr('onclick', 'buscarEstadisticas('+"'"+cantidad+"'"+','+"'"+tipoEstadistica+"'"+','+"'"+idCanvas+"'"+','+"'"+idButton+"'"+')');
}
