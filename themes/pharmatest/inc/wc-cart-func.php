<?php


add_action( 'wp_enqueue_scripts', 'cart_scripts', 30 );

function cart_scripts() {
        wp_enqueue_script( 'cart-update',get_template_directory_uri().'/inc/js/cart.js');
}


add_action('woocommerce_cart_collaterals','cart_order',10);
function cart_order(){
    ?>

<?php
}

function hide_coupon_field_on_cart( $enabled ) {
    if ( is_cart() ) {
        $enabled = false;
    }
    return $enabled;
}

add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );

add_action('woocommerce_before_cart_collaterals', 'cart_form',10);
function cart_form(){
    ?>
    <div class = "contact-form-wrapper d-flex fw justify-between">
    <div class = "order-form-parent">
    <?php
        echo do_shortcode('[contact-form-7 id="82" title="Контактная форма 1"]');
        ?>
    </div>
        <?php
    }

add_action('woocommerce_after_cart_collaterals', 'cart_form_end',20);
function cart_form_end()
{
?>
    </div>
<?php
}

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

    wp_localize_script('cart-update', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('myajax-nonce')
        )
    );

}

if( wp_doing_ajax() ) {
    add_action('wp_ajax_post_order', 'post_order_callback');
    add_action('wp_ajax_nopriv_post_order', 'post_order_callback');
}
function post_order_callback() {
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );


    $address = array(
        'first_name' => $_POST['name'] ,
        'last_name'  => '',
        'company'    => '',
        'email'      => '',
        'phone'      => $_POST['phone'],
        'address_1'  => $_POST['address'],
        'address_2'  => '',
        'city'       => '',
        'state'      => '',
        'postcode'   => '',
        'country'    => ''
    );
    $type = $_POST['type'];
    $order;$order_id;
    if ($type == 'cart') {
        $cart = WC()->cart;
        $checkout = WC()->checkout();
        $order_id = $checkout->create_order(array());
        $order = wc_get_order($order_id);

        $cart->empty_cart();
    }
    if ($type =='product'){
        $order = wc_create_order();

        $product_id =  $_POST['id'];
        $product = wc_get_product($product_id);


        $quantity = $_POST['quantity'];

        $order->add_product($product, $quantity);

    }
    $order->set_address($address, 'billing');
    $order->set_address($address, 'shipping');
    $order->set_customer_note($_POST['comment']);
    $order->calculate_totals();
    $order->payment_complete();
    $order_id = trim(str_replace('#', '', $order->get_order_number()));
    echo $order_id;



    wp_die();
}


