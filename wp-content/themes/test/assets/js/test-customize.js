(function($) {
    wp.customize( 'test_link_color', function( value ) {
        value.bind( function( newval ) {
            $('a').css('color', newval);
        } );
    } );

    wp.customize( 'test_phone', function( value ) {
        value.bind( function( newval ) {
            $('.test-phone span').text(newval);
        } );
    } );
})(jQuery);