jQuery( function( $ ) {

    $( "body" ).on( "change input", ".quantity .qty", function() {
        var add_to_cart_button = jQuery( this ).parents( ".product-buy-container " ).find( ".add_to_cart_button" );
        add_to_cart_button.attr( "data-quantity", jQuery( this ).val() );
    });
});