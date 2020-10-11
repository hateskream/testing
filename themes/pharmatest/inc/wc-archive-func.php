<?php


add_filter( 'woocommerce_show_page_title', function(){
    return false;
});





// add the filter



add_action( 'wp_enqueue_scripts', 'gallery_scripts', 20 );

function gallery_scripts() {
    if ( is_archive()||is_page_template( 'fp-template.php' )||is_page_template( 'revews.php' ) ) {
      /*  if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
           // wp_enqueue_script( 'zoom' );
        }
        if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
         //   wp_enqueue_script( 'flexslider' );
        }*/
        if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
            wp_enqueue_script( 'photoswipe-ui-default' );
            wp_enqueue_style( 'photoswipe-default-skin' );
            wp_enqueue_script( 'custom-lightbox',get_template_directory_uri().'/inc/js/lightbox.js');
            add_action( 'wp_footer', 'woocommerce_photoswipe' );
        }

    }
    /*!!!!!!!!!!!!!*/
    wp_enqueue_style( 'archive-style', get_template_directory_uri().'/inc/css/style-archive.css');
    wp_enqueue_style( 'product-style', get_template_directory_uri().'/inc/css/style-product.css');

    wp_enqueue_script( 'side-menu', get_template_directory_uri().'/inc/js/side-menu.js');
    if (is_cart())
    {
        wp_enqueue_style( 'cart-style', get_template_directory_uri().'/inc/css/style-cart.css');
    }
    else
    {
        wp_enqueue_script( 'fast-order', get_template_directory_uri().'/inc/js/fast-order.js');
    }

}


remove_all_actions('woocommerce_shop_loop_item_title');
add_action('woocommerce_shop_loop_item_title',function()
{
    global $product;
    ?>
    <div class = "product-loop-title"><?php echo $product->get_name();?></div>
        <?php

});

remove_all_actions('woocommerce_archive_description');
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
add_action('woocommerce_before_main_content','main_container_start',10);

function main_container_start(){
?>
    <div class = "main-container container">
    <?php
}


add_action('woocommerce_before_main_content','columns_divide',30);
function columns_divide(){
    ?>
 <div class = "products-container d-flex fw">
    <div class = "col20-lg">
        <div class = "side-menu"    >
        <?php do_action('attributes_side_menu');?>
        </div>
    </div>
    <div class = "col80-lg d-flex column">
    <?php  if (is_archive()) { ?>
    <h1 class="woocommerce-products-header__title page-title">
        <?php
        woocommerce_page_title();
        ?>
    </h1>
    <?php
    }
    else
        if (is_product())
            echo woocommerce_template_single_title();
}



add_action('woocommerce_before_products','divide_by_columns',10);

function divide_by_columns(){
    ?>

        <div class = 'archive-sorting d-flex justify-end'>
            <span class = "archive-sorting__title">Сотрировка:</span>
            <?php
            global $wp;
            $url = home_url($wp->request);
            echo '<a href="' . $url . '?orderby=price'. '" class = "archive-sorting__link base-link" >' . 'Цена' . '</a>';
            echo '<a href="' . $url . '?orderby=popularity'. '" class = "archive-sorting__link base-link">' . 'Популярность' . '</a>';
            ?>
        </div>
        <?php

}

add_action('woocommerce_after_main_content','main_container_end',5);

function main_container_end(){
    if (is_archive() && !is_shop())
    {
    ?>
    <?php
            do_action('attributes_tag_cloud');
    ?>
            <?php
                if (is_archive())
                do_action('wc_archive_additional_info');?>
    <?php
    }
    ?>

            <div class ="cf-form-parent d-flex justify-center">
                <?php echo do_shortcode('[contact-form-7 id="124" title="Бесплатная консультация"]');?>
            </div>


            </div>
        </div>
    </div>
<?php

}










//Product Content
remove_all_actions('woocommerce_before_shop_loop_item_title');
remove_all_actions('woocommerce_after_shop_loop_item_title');
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',20);
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_link_close',30);

add_action('woocommerce_after_shop_loop_item_title','wc_shop_loop_attributes',5);

remove_all_actions('woocommerce_after_shop_loop_item');


function wc_shop_loop_attributes(){
    global $product;
    $brand = $product->get_attribute('pa_brand');
    $country = $product->get_attribute('pa_country');
    $sostav = get_field('sostav');
    $cat = get_the_terms( $product->get_id(), 'product_cat' )[0]->slug;
?>

    <div class = "archive-attributes-container d-flex column">
        <?php
        echo '<div class = "archive-attribute">Производитель:'.$brand.' ('.$country.')</div>';
        echo '<div class = "archive-attribute">Состав:';
        echo '<a href = "' . get_bloginfo('url') . '/' . $cat.'" class = "d-inline archive-attribute__sostav-link base-link">';

        echo (($sostav)?$sostav:'Софосбувир 400 мг + Ледипасвир 90 мг').'</div>';
        echo '</a>';
        ?>
        </div>
        <div class = "archive-buttons-container d-flex flex-column align-center">
    <?php
         $product_id;
         $c = 0;
         $product_price;
         $product_variation;
         $variation_slug = $_GET['attribute_pa_duration'];
         if ( $product->is_type( 'variable' ) ) {
             $product_variation = 1;
         ?>
    <div class = "product-variations-container d-flex align-center justify-center">

        <?php
        foreach ($product->get_available_variations() as $variation)
        {

            $variation_id=$variation['variation_id'];
            $price = $variation['display_price'];
            $slug = $variation['attributes']['attribute_pa_duration'];
            $name = get_term_by('slug',$slug, 'pa_duration')->name;

            $current = $variation_slug?(($variation_slug==$slug)?true:false):(($c==0)?true:false);
            if ($current){
                $product_id = $variation_id;
                $product_price = $variation['price_html'];
            }
            ?>

            <div class = "product-variation <?php echo $current?'selected':'' ?>" data-id = "<?php echo $variation_id ?>" data-price = "<?php echo $price ?>">
                <?php echo $name ?>
            </div>

            <?php
            $c++;
        }
        echo '</div>';
        }
        else {
            $product_price = $product->get_price_html();
            $product_id = $product->get_ID();
        }
        ?>
        <div class = "archive-price-container d-flex align-center">
            <span>Цена:</span><span class="price"><?php echo $product_price ?></span>
        </div>
    <a href="?add-to-cart=<?php echo $product_id ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id ?>" data-product_sku="" rel="nofollow"><i class="fa fa-shopping-cart"></i> Заказать</a>
        <a href = "#" class = "one-click-button button" data-product_id="<?php echo $product_id ?>">Купить в 1 клик!</a>
            <div class = "hidden-attrs">
            <span class = "hidden-attrs__page">archive</span>
            <span class = "hidden-attrs__id"><?php echo $product_id ?></span>
            <span class = "hidden-attrs__name"><?php echo $product->get_name() ?></span>
            <span class = "hidden-attrs__variation"><?php echo $product_variation ?></span>
            <span class = "hidden-attrs__price"><?php echo  $product->get_price() ?></span>
        </div>
    </div>

<?php
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'filter_loop_add_to_cart_link', 20, 3 );
function filter_loop_add_to_cart_link( $button, $product, $args = array() ) {

    if (is_archive())
    $button_text = __('Заказать', 'woocommerce');
    else
        $button_text = __('Купить', 'woocommerce');
    $icon = 'fa-shopping-cart';

    return sprintf( '<a href="%s" data-quantity="%s" class="%s" %s><i class="fa %s"></i> %s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        $icon,
        $button_text );

}

add_action('woocommerce_after_shop_loop_item','one_click_button',20);

function one_click_button()
{
    ?>

    <?php
}

