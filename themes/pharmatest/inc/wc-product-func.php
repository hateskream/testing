<?php



remove_all_actions('woocommerce_single_product_summary');

add_action('woocommerce_single_product_summary','add_product_rating',10);
add_action('woocommerce_single_product_summary','add_product_attributes',20);

add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text' );
remove_action('woocommerce_review_before','woocommerce_review_display_gravatar',10);

remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);


function custom_single_add_to_cart_text() {
    return 'Купить';
}
add_action( 'wp_enqueue_scripts', 'product_page_scripts', 30 );

function product_page_scripts() {
    wp_enqueue_script( 'quantity-change',get_template_directory_uri().'/inc/js/quantity.js');
}

add_filter( 'woocommerce_product_description_heading', 'remove_tab_title' );
function remove_tab_title($heading)
{
    $heading = false;
    return $heading;
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );          // Remove the description tab
        if (get_field('video')) {

            $tabs['video'] = array(
                'title' => 'Видеообзор',
                'priority' => 10,
                'callback' => 'video_tab_content'
            );
        }
        if (get_post_meta(get_the_ID(), 'vdw_gallery_id'))
        {
            $tabs['certificate'] = array(
                'title' => 'Сертификаты',
                'priority' => 50,
                'callback' => 'certificate_tab_content'
            );
        }
    return $tabs;
}
function video_tab_content()
{
    ?>
    <div class = "video-tab-content">
        <?php lazy_video(get_field('video'), 480,270);?>
    </div>
    <?php
}
function certificate_tab_content()
{
    ?>
    <div class = "archive-certificates-block">
        <div id = "gallery" class = " certificates-container d-flex fw">
            <?php
    $certificates = get_post_meta(get_the_ID(),'vdw_gallery_id');

    foreach ($certificates[0] as $certificate)
    {
        $url = wp_get_attachment_image_url($certificate,'large');
        ?>
            <figure class = "certificates-img-wrapper">
                <a href="<?php echo $url ?>">
                    <img class = "certificates-img lazy" data-src = "<?php echo $url ?>">
                </a>
            </figure>

    <?php
    }
    ?>



            </div>
    </div>
    <?php

}




add_filter('woocommerce_product_review_comment_form_args','change_contact_form');
    function change_contact_form($form)
    {
        $form['title_reply'] = 'Оставьте свой отзыв';
        $form['fields']['cookies'] = '';
        $form['comment_notes_before'] = '';

        $form['fields']['author'] = '<div class = "comment-form-data-wrapper"><p class="comment-form-author">
			<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
			<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' />
		</p>';
        $form['fields']['email'] ='<p class="comment-form-email">
			<label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required"s*</span>' : '' ) . '</label> 
			<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />
		</p></div>';

        return $form;
    }

add_filter('woocommerce_upsell_display_args',function($args){
  $args['columns'] = 3;
  return $args;
});

add_filter('woocommerce_product_upsells_products_heading',function(){
   return  'Рекомендуемые товары';
});


function add_product_rating()
{
    if ( ! wc_review_ratings_enabled() ) {
        return;
    }
    global $product;
    $rating_count = $product->get_rating_count();
    $average      = $product->get_average_rating();
    ?>
    <div class="woocommerce-product-rating">
    <?php
    echo wc_get_rating_html( $average, $rating_count );
    ?>
    </div>
    <?php

}
function add_product_attributes()
{
    global $product;

    $sostav = get_field('sostav');
    $genotypes = get_field('genotypes');
    $oname = get_field('original_name');
    $quantity = get_field('quantity');
    $brand = $product->get_attribute('brand');
    $country = $product->get_attribute('country');
    $cat = get_the_terms( $product->get_id(), 'product_cat' )[0]->slug;
    $attr = get_the_terms( $product->get_id(), 'pa_brand' )[0]->slug;
    ?>
    <div class = "product-attributes-container">
    <p>
    <span class = "attribute-title">Состав: </span><?php
        echo '<a href = "' . get_bloginfo('url') . '/' . $cat.'" class = "base-link">';
        echo $sostav;
        echo '</a>';?>
    </p>
        <p>
        <span class = "attribute-title">Производитель: </span><?php
            echo '<a href = "' . get_bloginfo('url') . '/' . $attr.'" class = "base-link">';
            echo $brand.' ('.$country.')';
            echo '</a>';?>
        </p>
        <p>
        <span class = "attribute-title">Генотипы: </span><?php echo $genotypes ?>
        </p>
        <p>
            <span class = "attribute-title">Наличие: </span> Москва (доставка по РФ 2-3 дня оплата при получении)
        </p>
        <p>
            <span class = "attribute-title">Оригинальное название: </span><?php echo $oname ?>
        </p>
        <p>
            <span class = "attribute-title">Количество: </span><?php echo $quantity ?>
        </p>

         <?php
         $product_id;
         $c = 0;
         $product_price;
         $product_variation;

         $variation_slug = $_GET['attribute_pa_duration'];
         if ( $product->is_type( 'variable' ) ) {
            $product_variation = 1;
         ?>
    <span class = "attribute-title">Длительность:</span>
    <div class = "product-variations-container d-flex align-center">

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
        <div class = "attribute-price-block">
        <p>
            <span class = "attribute-title">Цена: </span>
            <span class="price"><?php echo $product_price ?></span>
        </p>

    <p>
        <span class = "attribute-title">
            По всем вопросам:
            <a class="base-link d-inline" href="tel:+78005057089">8-800-505-70-89</a>
            <span class = "d-inline">(Бесплатно по РФ)</span>
        </span>
    </p>
        </div>
    <div  class = "product-buy-container d-flex fw align-center">
        <a href="?add-to-cart=<?php echo $product_id ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id ?>" data-product_sku="" rel="nofollow"><i class="fa fa-shopping-cart"></i> Заказать</a>
    <?php
    woocommerce_quantity_input(
        array(
            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
            'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        )
    );
    ?>
        <div class = "product-one-click-container d-flex">
            <a href ="#" class = "product-one-click-button one-click-button base-button"><i class="fa fa-share"></i> Купить в 1 клик</a>
            <div class = "hidden-attrs">
                <span class = "hidden-attrs__page">product</span>
                <span class = "hidden-attrs__id"><?php echo $product_id ?></span>
                <span class = "hidden-attrs__name"><?php echo $product->get_name() ?></span>
                <span class = "hidden-attrs__variation"><?php echo $product_variation ?></span>
                <span class = "hidden-attrs__price"><?php echo  $product->get_price() ?></span>
            </div>
        </div>
    </div>
                <div class = "product-info-container d-flex">
                    <div class = "info-group d-flex fw align-center justify-between">
                    <div class = "d-flex align-center">
                        <span class = "info d-flex justify-center align-center"><i class="fa fa-info"></i></span>
                            <a href ="#" class = "payment product-info-button base-link">Способы оплаты</a>
                    </div>
                    <div class = "d-flex align-center">
                        <span class = "info d-flex justify-center align-center"><i class="fa fa-info"></i></span>
                            <a href ="#" class = "guarantee product-info-button base-link">Гарантии</a>
                    </div>
                    <div class = "d-flex align-center">
                        <span class = "info d-flex justify-center align-center"><i class="fa fa-info"></i></span>
                            <a href ="#" class = "shipping product-info-button base-link">Доставка</a>
                    </div>
                    </div>
                </div>
    </div>
<?php

}

