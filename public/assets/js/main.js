$(document).ready(function(){
    $('.slider').slider({
        interval: 10000,
        // height: 864,
        // indicators: false,
    });
    $('.scrollspy').scrollSpy({
        scrollOffset: 1000,
    });

    $('.collapsible').collapsible();

    $('select').formSelect();

    $('.tabs').tabs();

    $('.materialboxed').materialbox();
});
