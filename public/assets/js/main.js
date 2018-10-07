$(document).ready(function(){
    $('.slider').slider({
        interval: 12000,
        // height: 864,
        // indicators: false,
    });
    $('.sidenav').sidenav();

    $('.scrollspy').scrollSpy({
        scrollOffset: 300,
    });

    $('.collapsible').collapsible();

    $('select').formSelect();

    $('.tabs').tabs();

    $('.materialboxed').materialbox();

});
