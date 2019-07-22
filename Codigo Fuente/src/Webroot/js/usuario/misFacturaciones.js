$(document).ready(function() {
    $('.factu-info').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    });
});

function cambiarDireccionFlecha(element) {
    var facturacion = $(element);

    if(facturacion.hasClass('opened')) {
        facturacion.removeClass('opened').find('.dropdown-user').empty().append($('<i class="fas fa-chevron-down float-right">'));
    } else {
        facturacion.addClass('opened').find('.dropdown-user').empty().append($('<i class="fas fa-chevron-up float-right">'));
    }
}