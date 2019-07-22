$(document).ready(function() {

    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="fas fa-chevron-up float-right mr-3"></i>');
            }
            else
            {
                currentButton.html('<i class="fas fa-chevron-down float-right mr-3"></i>');
            }
        });
    });
});