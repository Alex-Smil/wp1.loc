(function($) {
    wp.customize( 'test_link_color', function( value ) {
        value.bind( function( newval ) {
            $('a').css('color', newval);
            // console.log('TEST of test-customize.js');
        } );
    } );
})(jQuery);