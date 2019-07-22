var dzUpload = $('#dzUpload');
var btnAgregarEditar = $('#btnAgregarEditar');
var inputNombreProducto = $('#inputNombreProducto');
var inputPrecioProducto = $('#inputPrecioProducto');
var inputCantidadProducto = $('#inputCantidadProducto');
var selectCategoriaProducto = $('#selectCategoriaProducto');
var selectEstadoProducto = $('#selectEstadoProducto');
var textareaDescripcionProducto = $('#textareaDescripcionProducto');
var selectMetodoProducto = $('#selectMetodoProducto');
var divDetalleEntregaProducto = $('#divDetalleEntregaProducto');
var inputDetalleEntregaProducto = $('#inputDetalleEntregaProducto');

selectMetodoProducto.change(

        function metodoEntrega () {

        if (selectMetodoProducto.val() == 1){
            divDetalleEntregaProducto.removeClass("d-none");
        }
        else {
            divDetalleEntregaProducto.addClass("d-none");
        }
    }
);

Dropzone.autoDiscover = false;

function inicializarDropzoneJs() {
    dzUpload.dropzone({
        url: pathHome + 'Productos/alta',
        addRemoveLinks: true,
        success: function (file, response) {
            var imgName = response;
            file.previewElement.classList.add('dz-success');
            window.location.href = pathHome + "Productos/misProductos";
        },
        error: function (file, response) {
            file.previewElement.classList.add('dz-error');
        },
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        acceptedFiles: '.png, .jpg, .jpeg',
        init: function () {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            btnAgregarEditar.click(function (e) {
                // Make sure that the form isn't actually being sent.
                $(".error").fadeOut();
                e.preventDefault();
                e.stopPropagation();

                if (dzClosure.getQueuedFiles().length == 0) {

                    $("#errorImagenesProducto").find("span").text("Ingrese al menos una imagen");
                    $("#errorImagenesProducto").fadeIn("slow");

                }
                else if (validarAltaModificarProducto()) {
                    dzClosure.processQueue();
                }
            });

            this.on("maxfilesexceeded", function(file) {
                dzClosure.removeFile(file);
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function (data, xhr, formData) {
                formData.append("nombreProducto", inputNombreProducto.val());
                formData.append("precioProducto", inputPrecioProducto.val());
                formData.append("cantidadProducto", inputCantidadProducto.val());
                formData.append("categoriaProducto", selectCategoriaProducto.val());
                formData.append("estadoProducto", selectEstadoProducto.val());
                formData.append("descripcionProducto", textareaDescripcionProducto.val());
                formData.append("metodoProducto", selectMetodoProducto.val());
                formData.append("detalleEntregaProducto", inputDetalleEntregaProducto.val());
                btnAgregarEditar.submit();
            });
        }
    });
}

inicializarDropzoneJs();
