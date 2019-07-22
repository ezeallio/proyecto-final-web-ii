var paginador = $('#paginador');
var divProductosContainer = $('#divProductosContainer');


paginador.pagination({
    dataSource: pathHome + 'Buscar/getPublicaciones/' + btoa(encodeURI(palabra)).replace(/=/gi, ''),
    autoHidePrevious: true,
    autoHideNext: true,
    pageSize: 6,
    locator: 'items',
    totalNumber: cantidadProductos,
    className: 'paginationjs-theme-blue paginationjs-big',
    callback: function (data, pagination) {
        if(cantidadProductos != 0) {
            divProductosContainer.empty();
            const cantPublicaciones = data.length;
            var i = 0;
            while(i < cantPublicaciones) {
                var cont = 0;

                var row = $('<div class="row my-3 w-100">');

                do {
                    var col = $('<div class="col-sm-4 mt-2">');

                    var anchor = $('<a>');
                    anchor.attr('href', pathHome + 'Productos/publicacion/' + data[i].producto.id);

                    var productItem = $('<div id="' + data[i].producto.id + '" class="product-item w-100">');

                    var productFilter = $('<div class="product product_filter">');

                    var productImage = $('<div class="product_image h-75 justify-content-center align-items-center">');

                    var img = $('<img class="h-100">');
                    img.attr('src', pathHome + 'Webroot/img/productos/' + data[i].imagen.nombre);

                    productImage.append(img);

                    var productInfo = $('<div class="product_info">');

                    var productName = $('<h6 class="product_name">');

                    var anchorProductName = $('<a>');
                    anchorProductName.attr('href', pathHome + 'Productos/publicacion/' + data[i].producto.id);
                    anchorProductName.text(data[i].producto.nombre);

                    productName.append(anchorProductName);

                    var productPrice = $('<div class="product_price">');
                    productPrice.text('$' + data[i].producto.precio);

                    productInfo.append(productName);
                    productInfo.append(productPrice);

                    var divButtonAddToCart = $('<div class="red_button">');

                    var buttonAddToCart = $('<button id="btnAddToCart" class="btn btn-primary ml-3">');

                    var fabOpenCart = $('<i class="fab fa-opencart mr-2">');

                    var fasCheck = $('<i class="fas fa-check mr-2">');

                    var fasBan = $('<i class="fas fa-ban mr-2">');

                    var spanAddToCart = $('<span>');

                    if (window.carrito != null && window.carrito.length != 0 && $.inArray(parseInt(data[i].producto.id), window.carrito) != -1) {
                        spanAddToCart.text('En Carrito');
                        buttonAddToCart.append(fasCheck);
                        buttonAddToCart.prop('disabled', true);
                    } else if (data[i].producto.cantidad == 0) {
                        spanAddToCart.text('Sin Stock');
                        buttonAddToCart.append(fasBan);
                        buttonAddToCart.prop('disabled', true);
                    } else {
                        spanAddToCart.text('Agregar al Carrito');
                        buttonAddToCart.append(fabOpenCart);
                        buttonAddToCart.attr('onclick', 'agregarProductoCarrito(' + data[i].producto.id + ')');
                    }

                    buttonAddToCart.append(spanAddToCart);

                    divButtonAddToCart.append(buttonAddToCart);

                    anchor.append(productImage);

                    productFilter.append(anchor);
                    productFilter.append(productInfo);

                    productItem.append(productFilter);
                    productItem.append(divButtonAddToCart);

                    col.append(productItem);

                    row.append(col);

                    i++;
                    cont++;
                }while(i < cantPublicaciones && cont < 3);

                divProductosContainer.append(row);
            }
        }
    },
    ajax: {
        type: 'POST',
        dataType: 'json'
    }
});



