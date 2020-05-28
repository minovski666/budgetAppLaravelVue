(function(window, document, $, undefined){

    $(function(){
        jQuery(".loader").fadeOut('slow');
    });

})(window, document, window.jQuery);
(function(window, document, $, undefined){

    $(function(){
        var sidebarNav = jQuery(".sidebar-nav");
        if (sidebarNav.length > 0) {
                $('#sidebarNav').metisMenu();
        }
    });

})(window, document, window.jQuery);
// (function(window, document, $, undefined){
//
//     $('.mobile-toggle').on('click', function() {
//         $('body').toggleClass('sidebar-toggled');
//       });
//
//       $(document).on('click', '.mega-menu.dropdown-menu', function (e) {
//         e.stopPropagation();
//       });
//
//       $('.sidebar-toggle').on('click', function() {
//         $('body').toggleClass('sidebar-mini');
//         $('.app-navbar').toggleClass('expand');
//       });
//
//       $('.app-navbar').hover(function() {
//         if($('body').hasClass('sidebar-mini')) {
//           $('.navbar-header').toggleClass('expand');
//         }
//       });
//
//       $('.search').on('click', function() {
//         $('.search-wrapper').fadeIn(200);
//       });
//
//        //Search Box Close
//        $('.close-btn').on('click', function() {
//         $('.search-wrapper').fadeOut(200);
//       });
//
//       $('.mobile-toggle').on('click', function() {
//         $('body').toggleClass('sidebar-toggled');
//       });
//
// })(window, document, window.jQuery);