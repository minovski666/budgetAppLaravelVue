$(document).ready(function () {

    $('.sidebar-toggle').on('click', function () {
        $('body').toggleClass('sidebar-mini');
        $('.app-navbar').toggleClass('expand');
    });

    $('.app-navbar').hover(function () {
        if ($('body').hasClass('sidebar-mini')) {
            $('.navbar-header').toggleClass('expand');
        }
    });

    $('.search').on('click', function () {
        $('.search-wrapper').fadeIn(200);
    });

    //Search Box Close
    $('.close-btn').on('click', function () {
        $('.search-wrapper').fadeOut(200);
    });

    $('.mobile-toggle').on('click', function () {
        $('body').toggleClass('sidebar-toggled');
    });
})