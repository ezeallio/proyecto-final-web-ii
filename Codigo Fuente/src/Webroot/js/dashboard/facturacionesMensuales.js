var vendedoresId = [];
var totalFacturaciones = [];
var inputRangoFacturacion = $('#inputRangoFacturacion');
var btnInputRangoFacturacion = $('#btnInputRangoFacturacion');
var divFormGroupRangoFacturacion = $('#divFormGroupRangoFacturacion');
var divCardsContainer = $('#divCardsContainer');
var advertencia = $('#advertencia');
var advertencia2 = $('#advertencia2');
var btnFacturar = null;
var tableId = null;

inicializarDateRangePicker();

function cargarTablas(registrosComprasPorMes) {
   divCardsContainer.empty();
   if(registrosComprasPorMes === null || registrosComprasPorMes.length === 0) {
      advertencia2.removeClass('d-none');
   } else {
      advertencia2.addClass('d-none');
      $.each(registrosComprasPorMes, function (mes, registros) {
         var divCard = $('<div class="card mb-3 w-100">');

         var divCardHeader = $('<div class="card-header">');

         var iFasFaTable = $('<i class="fas fa-table mr-2">');

         var spanCardHeader = $('<span>');
         spanCardHeader.text('Facturaciones de mes ' + mes);

         divCardHeader.append(iFasFaTable);
         divCardHeader.append(spanCardHeader);

         var divCardBody = $('<div class="card-body">');

         var divTableResponsive = $('<div class="table-responsive">');

         var tableDataTable = $('<table class="table table-bordered" width="100%" cellspacing="0">');
         tableDataTable.attr('id', mes.replace('/', ''));

         var tHead = $('<thead>');

         var trHead = $('<tr class="text-center">');

         var thHeadNroCompra = $('<th>');
         thHeadNroCompra.text('Nro de Compra');
         var thHeadProducto = $('<th>');
         thHeadProducto.text('Producto');
         var thHeadCantidad = $('<th>');
         thHeadCantidad.text('Cantidad');
         var thHeadFecha = $('<th>');
         thHeadFecha.text('Fecha');
         var thHeadTotalAComprar = $('<th>');
         thHeadTotalAComprar.text('Total a Comprar');
         var thHeadTotalAFacturar = $('<th>');
         thHeadTotalAFacturar.text('Total a Facturar');

         trHead.append(thHeadNroCompra);
         trHead.append(thHeadProducto);
         trHead.append(thHeadCantidad);
         trHead.append(thHeadFecha);
         trHead.append(thHeadTotalAComprar);
         trHead.append(thHeadTotalAFacturar);

         tHead.append(trHead);

         tableDataTable.append(tHead);

         var tBody = $('<tbody>');

         $.each(registros, function (i, registro) {
            var trBody = $('<tr class="text-center">');

            var tdId = $('<td>');
            tdId.text(registro.id);
            var tdNombreProducto = $('<td>');
            tdNombreProducto.text(registro.nombreProducto)
            var tdCantidad = $('<td>');
            tdCantidad.text(registro.cantidad);
            var tdVendedorId = $('<td class="d-none">');
            tdVendedorId.text(registro.vendedorId);
            var tdFechaCompra = $('<td>');
            tdFechaCompra.text(moment(registro.compra.fechaCompra, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY'));
            var tdTotal = $('<td>');
            var total = registro.precioUnitario * registro.cantidad;
            tdTotal.text('$ ' + total);
            var tdTotalFacturacion = $('<td>');
            var totalFacturacion = total * 0.04;
            tdTotalFacturacion.text('$ ' + totalFacturacion);
            var tdTotalFacturacionEscondido = $('<td class="d-none">');
            tdTotalFacturacionEscondido.text(totalFacturacion);

            trBody.append(tdId);
            trBody.append(tdNombreProducto);
            trBody.append(tdCantidad);
            trBody.append(tdVendedorId);
            trBody.append(tdFechaCompra);
            trBody.append(tdTotal);
            trBody.append(tdTotalFacturacion);
            trBody.append(tdTotalFacturacionEscondido);

            tBody.append(trBody);
         });

         tableDataTable.append(tBody);

         var btnFacturar = $('<button class="btn btn-primary float-right mr-3" onclick="realizarFacturacionMensual(this)">');

         var iFasFaMoneyCheck = $('<i class="fas fa-money-check mr-2">');

         var spanGenerarFacturacion = $('<span>');
         spanGenerarFacturacion.text('Generar Facturación');

         btnFacturar.append(iFasFaMoneyCheck);
         btnFacturar.append(spanGenerarFacturacion);

         divTableResponsive.append(tableDataTable);
         divTableResponsive.append(btnFacturar);

         divCardBody.append(divTableResponsive);

         var divCardFooter = $('<div class="card-footer small text-muted">');

         divCard.append(divCardHeader);
         divCard.append(divCardBody);
         divCard.append(divCardFooter);

         divCardsContainer.append(divCard);
      });
      divCardsContainer.addClass('d-flex').removeClass('d-none');
   }
}

function traerFacturacionesPendientes(rangoFechas) {
   var fechas = rangoFechas.split('-');
   var obj = {};
   obj.fechaDesde = moment(fechas[0], 'DD/MM/YYYY').format('YYYY-MM-DD');
   obj.fechaHasta = moment(fechas[1], 'DD/MM/YYYY').format('YYYY-MM-DD');
   llamadaAjax(pathGetFacturacionesPendientes, JSON.stringify(obj), true, 'cargarTablas', 'dummy');
}

function inicializarDateRangePicker() {
   if(fechaMasAntiguaCompra === '') {
      divFormGroupRangoFacturacion.addClass('d-none').empty();
      advertencia.removeClass('d-none');
   } else {
      inputRangoFacturacion.change(function () {
         traerFacturacionesPendientes($(this).val());
      });

      inputRangoFacturacion.daterangepicker({
         showDropdowns: true,
         opens: 'left',
         minDate: moment(fechaMasAntiguaCompra, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY'),
         maxDate: moment().format('DD/MM/YYYY'),
         locale: {
            format: 'DD/MM/YYYY',
            daysOfWeek: nombresDias,
            monthNames: nombresMeses,
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar'
         }
      });

      btnInputRangoFacturacion.click(function () {
         inputRangoFacturacion.data('daterangepicker').toggle();
      });
   }
}





function realizarFacturacionMensual(element) {
   btnFacturar = $(element);
   tableId = btnFacturar.siblings('table').attr('id');

   $('#' + tableId + ' tbody tr td:nth-child(4)').each( function(){
      vendedoresId.push($(this).text());
   });

   $('#' + tableId + ' tbody tr td:nth-child(8)').each( function(){
      totalFacturaciones.push(parseInt($(this).text()));
   });
   facturacionesMensuales();
}

function facturacionesMensuales() {
   btnFacturar.prop('disabled', true);
   var obj = {};
   obj.facturacionesTotal = totalFacturaciones;
   obj.vendedoresId = vendedoresId;
   llamadaAjax(pathAccionFacturacionMensual, JSON.stringify(obj), true, "facturacionExitoso", "facturacionFallida");
}

function facturacionExitoso (dummy) {
   vendedoresId = [];
   totalFacturaciones = [];
   $('#' + tableId).closest('.card').remove();
   tableId = null;
   btnFacturar = null;
   if(divCardsContainer.length === 1) {
      divCardsContainer.removeClass('d-flex').addClass('d-none').empty();
      advertencia2.removeClass('d-none');
   }
   alertify.alert('Facturación exitosa', 'Se ha realizado la facturación correspondiente');
}

function facturacionFallida(err) {
   tableId = null;
   btnFacturar.prop('disabled', false);
   btnFacturar = null;
   alertify.alert('Error', err);
}