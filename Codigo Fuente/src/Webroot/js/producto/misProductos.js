var paginador = $('#paginador');
var divProductosContainer = $('#divProductosContainer');

paginador.pagination({
    dataSource: pathHome + 'Productos/getPublicaciones',
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

                var row = $('<div class="row w-100">');

                do {
                    var col = $('<div class="col-sm-4">');

                    var divCard = $('<div class="card w-100 justify-content-center align-items-center mt-3">');

                    var divCardInner = $("<div class='card__inner h-75 w-100'>");

                    var imgCardInner = $("<img class='img-fluid h-100 w-100'>");
                    imgCardInner.attr('src', pathHome + 'Webroot/img/productos/' + data[i].imagen.nombre);

                    divCardInner.append(imgCardInner);

                    var h3CardTagLine = $("<h3 class='card__tagline mt-2'>");
                    h3CardTagLine.text(data[i].producto.nombre);

                    var ulCardIcons = $("<ul class='card__icons mt-2'>");

                    var liAccionVerPublicacion = $("<li>");

                    var anchorAccionVerPublicacion = $("<a>");
                    anchorAccionVerPublicacion.attr('href', pathHome + 'Productos/publicacion/' + data[i].producto.id);

                    var iFasFaEye = $("<i class='fas fa-eye'>");

                    anchorAccionVerPublicacion.append(iFasFaEye);

                    liAccionVerPublicacion.append(anchorAccionVerPublicacion);

                    var liAccionEditarPublicacion = $("<li>");

                    var anchorAccionEditarPublicacion = $("<a>");
                    anchorAccionEditarPublicacion.attr('href', pathHome + 'Productos/editarProducto/' + data[i].producto.id);

                    var iFasFaEdit = $("<li class='fas fa-edit'>");

                    anchorAccionEditarPublicacion.append(iFasFaEdit);

                    liAccionEditarPublicacion.append(anchorAccionEditarPublicacion);

                    var liAccionEliminarPublicacion = $("<li>");

                    var anchorAccionEliminarPublicacion = $("<a href='#' onclick='insertarIdProducto(" + data[i].producto.id + ")' data-toggle='modal' data-target='#eliminarModal'>");

                    var iFasFaTimes = $("<li class='fas fa-times'>");

                    anchorAccionEliminarPublicacion.append(iFasFaTimes);

                    liAccionEliminarPublicacion.append(anchorAccionEliminarPublicacion);

                    ulCardIcons.append(liAccionVerPublicacion);
                    ulCardIcons.append(liAccionEditarPublicacion);
                    ulCardIcons.append(liAccionEliminarPublicacion);

                    var pPrecio = $("<p class='font-weight-bold' style='color: #0099df;'>");
                    pPrecio.text("$ " + data[i].producto.precio);

                    divCard.append(divCardInner);
                    divCard.append(h3CardTagLine);
                    divCard.append(ulCardIcons);
                    divCard.append(pPrecio);

                    col.append(divCard);

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