(function ($) {
    wp.customize('body_font_size', function (value) {
        value.bind(function (newSize) {
            $('body').css('font-size', newSize + 'px');
        });
    });

    wp.customize('heading_h1_size', function (value) {
        value.bind(function (newSize) {
            $('h1').css('font-size', newSize + 'px');
        });
    });

    wp.customize('heading_h2_size', function (value) {
        value.bind(function (newSize) {
            $('h2').css('font-size', newSize + 'px');
        });
    });

    wp.customize('body_font_family', function (value) {
        value.bind(function (newVal) {
            document.body.style.fontFamily = newVal + ', sans-serif';
        });
    });
    

    // Add other elements for typography as needed
})(jQuery);
