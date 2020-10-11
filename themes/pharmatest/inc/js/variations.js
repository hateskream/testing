jQuery( function( $ ) {

    $( ".product-variation").mousedown( function(e) {
        e.preventDefault();
        $(this).parents('.product-variations-container').find('.selected').removeClass('selected');
        $(this).addClass('selected');

        var add_to_cart_button = $(this).parents('.product-attributes-container, .archive-buttons-container').find('.add_to_cart_button');
        var price_field = $(this).parents('.product-attributes-container, .archive-buttons-container').find('.woocommerce-Price-amount bdi');

        add_to_cart_button.attr('data-product_id',$(this).attr('data-id'));
        add_to_cart_button.attr('href','?add-to-cart='+$(this).attr('data-id'));
        price_field.text($(this).attr('data-price').replace(/\B(?=(\d{3})+(?!\d))/g, " ")+' руб.');

    });
});