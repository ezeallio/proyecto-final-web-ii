

function actualizarCantidad(producto) {
    var divCard = $('#' + producto.id);
    var divCantidad = divCard.find('.product_quantity');
    var botonAgregarCarrito = divCard.find('.botonCarrito');
    var cantidadProductos = Number(producto.cantidad);
    cambiarEstadoDelBotonComprar(botonAgregarCarrito, cantidadProductos);
    divCantidad.text('Disponibles:'+producto.cantidad);
}

function cambiarEstadoDelBotonComprar(botonCarrito, cantidad) {
    if(cantidad < 1){
        botonCarrito.prop('onclick',null).off('click');
        botonCarrito.text('Agotado');
    }else {
        botonCarrito.text('Agregado');
    }
}

function subirSubTotal(idProducto, cantidadTotal) {
    var tr = $('#'+idProducto);
    var divSubtotal = tr.find('.subtotal');
    var tdCantidad = tr.find('#quantity_value');
    var tdPrecio = tr.find('.precioProducto');
    var cantidad = parseInt(tdCantidad.text());
    if(cantidad < cantidadTotal){
        tdCantidad.text(cantidad+1);
        var precio = parseInt(tdPrecio.text());
        var subTotalParcial = (cantidad+1) * precio;
        divSubtotal.text(subTotalParcial);
        actualizarTotal();
    }

}

function bajarSubTotal(idProducto) {
    var tr = $('#'+idProducto);
    var divSubtotal = tr.find('.subtotal');
    var tdCantidad = tr.find('#quantity_value');
    var tdPrecio = tr.find('.precioProducto');
    var cantidad = parseInt(tdCantidad.text());
    if(cantidad > 1){
        var precio = parseInt(tdPrecio.text());
        var subTotalParcial = (cantidad-1) * precio;
        tdCantidad.text(cantidad-1);
        divSubtotal.text(subTotalParcial);
        actualizarTotal();
    }
}

function actualizarTotal(){
    var total=0;
    var tdTotal = $('.total');
    $('.subtotal').each( function() {
        total += parseInt($(this).text());
    });
    tdTotal.text(total);
}

$(document).ready(function($) {
    function subtTotalInicial(cantidad) {
        $('.fila-producto').each(function() {
            var tdPrecioProducto = $(this).find('.precioProducto');
            var precioProducto = Number(tdPrecioProducto.text());
            var subTotal = $(this).find('.subtotal');
            var subTotalParcial = cantidad * precioProducto;

            subTotal.text(subTotalParcial);
        });
    }
    var cantidadInicial = 1;
    subtTotalInicial(cantidadInicial);
    actualizarTotal();
});

function eliminarProducto(id) {
    var obj = {};
    obj.idProducto = id;
    llamadaAjax(pathHome + 'Carrito/eliminarDelCarrito', JSON.stringify(obj), true, "actualizarPaginaCarrito", "dummy");
}

function actualizarCarrito(cantidad){
    var contadorCarritoHeader = $('#checkout_items');
    var contadorCarritoHamburguesa = $('#contadorCarritoHamburguesa');

    contadorCarritoHeader.show();
    contadorCarritoHamburguesa.show();

    if(cantidad < 1){

        contadorCarritoHamburguesa.hide();
        contadorCarritoHeader.hide();
    }else{

        contadorCarritoHeader.addClass("checkout_items");

        contadorCarritoHeader.text(cantidad);
        contadorCarritoHamburguesa.text(cantidad);
    }
}

function actualizarPaginaCarrito(idProducto) {
    var fila = $('#' + idProducto);
    fila.remove();
    var carritoCompras = $('#checkout_items');
    var cantidadEnCarrito = parseInt(carritoCompras.text())-1;
    actualizarTotal();
    actualizarCarrito(cantidadEnCarrito);
    if(cantidadEnCarrito === 0){
        ocultarTabla();
        mostrarMensaje();
        ocultarBotonComprar();
    }

}



function ocultarTabla() {
    var tabla = $('#tablaCarrito');
    tabla.hide();
}

function mostrarMensaje() {
    var element =
    $(document.createElement('p'))
        .attr('class','text-center')
        .html('No hay productos agregados al carrito')
        .appendTo('#contenedorCarrito');
}

function ocultarBotonComprar() {
    var botonComprar = $('#botonComprarCarrito');
    botonComprar.hide();
}

$('#botonComprarCarrito').click(function () {
    $(this).prop('disabled', true);
    $(".delete-producto-button").prop('disabled', true);

    var array = [];
    $.each($('.fila-producto'), function (i, item) {
        array.push({
            id: $(item).attr('id'),
            cantidad: $(item).find('#quantity_value').text()
        });
    });

    llamadaAjax(pathComprar, JSON.stringify(array), true, 'compraExitosa', 'compraFallida');
});


function compraExitosa(dummy) {
    window.location.href = pathHome + "Compra/exito";
}

function compraFallida(err) {
    $(this).prop('disabled', false);
    $(".delete-producto-button").prop('disabled', false);

    alertify.alert('Error en la Compra', err);
}

