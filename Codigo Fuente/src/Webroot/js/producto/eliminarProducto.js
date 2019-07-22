function insertarIdProducto(idProducto)
{
    if($("#idProductoOculto").length) //si ya existe el input en el form
        $("#idProductoOculto").val(idProducto);
    else
        $("#confirmarEliminar").append("<input type='hidden' id='idProductoOculto' name='idProducto' value='" + idProducto + "' />");
}