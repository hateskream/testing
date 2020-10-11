<?php
/**
 * pharmatest functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pharmatest
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'pharmatest_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pharmatest_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pharmatest, use a find and replace
		 * to change 'pharmatest' to the name of your theme in all the template files.
		 */
		//load_theme_textdomain( 'pharmatest', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		//add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'pharmatest' ),
                'menu-2' => esc_html__( 'Footer', 'pharmatest' ),
                'menu-fc1' => esc_html__( 'Footer col1', 'pharmatest' ),
                'menu-fc2' => esc_html__( 'Footer col2', 'pharmatest' ),
                'menu-fc3' => esc_html__( 'Footer col3', 'pharmatest' ),
                'menu-city' => esc_html__( 'Cities', 'pharmatest' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pharmatest_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pharmatest_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width

function pharmatest_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pharmatest_content_width', 640 );
}
add_action( 'after_setup_theme', 'pharmatest_content_width', 0 );
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

function pharmatest_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pharmatest' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pharmatest' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pharmatest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
/*function meks_which_template_is_loaded() {
    if ( is_super_admin() ) {
        global $template;
        print_r( $template );
    }
}

add_action( 'wp_footer', 'meks_which_template_is_loaded' );*/



function pharmatest_scripts() {

    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' );


	wp_enqueue_style( 'pharmatest-style', get_stylesheet_uri(), array(), _S_VERSION );

    wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null);

    wp_enqueue_script( 'main-menu',get_template_directory_uri().'/inc/js/menu.js','jquery');

    wp_enqueue_script( 'variation-change',get_template_directory_uri().'/inc/js/variations.js');

    wp_enqueue_script( 'custom-lightbox',get_template_directory_uri().'/inc/js/lightbox.js');

    wp_enqueue_style( 'main-style', get_template_directory_uri().'/inc/css/style.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    if  (is_page_template( 'fp-template.php' ))
    {
        wp_enqueue_style( 'fp-style', get_template_directory_uri().'/inc/css/front-page.css');
            wp_enqueue_script( 'slick',get_template_directory_uri().'/inc/js/slick.min.js','jquery');

            wp_enqueue_script( 'slick-script',get_template_directory_uri().'/inc/js/fp-scripts.js','jquery');

    }
    if (is_page_template('answer-question.php' ))
    {
        wp_enqueue_style( 'answer-question', get_template_directory_uri().'/inc/css/answer-question.css');
    }
    if (is_page_template('revews.php' ))
    {
        wp_enqueue_style( 'revews', get_template_directory_uri().'/inc/css/revews.css');
    }
    if  (is_page_template( 'revews.php' )){
        wp_enqueue_script( 'reviews-script',get_template_directory_uri().'/inc/js/reviews.js','jquery');
    }
    if (is_page_template('blog-template.php' ))
    {
        wp_enqueue_style( 'blog-archive', get_template_directory_uri().'/inc/css/blog-archive.css');
    }
	if (is_front_page()){

    }
	if (is_single())
    {
        wp_enqueue_script( 'blog-scripts',get_template_directory_uri().'/inc/js/blog.js','jquery');
        wp_enqueue_style( 'blog-styles', get_template_directory_uri().'/inc/css/blog.css');
        wp_localize_script( 'blog-scripts', 'bloginfo', array(
            'template_url' => get_bloginfo('template_url'),
            'site_url' => get_bloginfo('url'),
            'post_id'   => get_queried_object()
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'pharmatest_scripts' );




/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load WooCommerce compatibility file.
 */

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}




if ( ! function_exists( 'cart_link' ) ) {
    function cart_link() {
        $count = WC()->cart->cart_contents_count;
        if ($count>0)
        {
            echo '<span class = "cart-contents">';
            echo $count;
            echo '</span>';
        }
        else{
            echo '<span class="cart-contents zero">123123</span>';
        }

    }
}

//Ajax Обновление кратких данных из корзины
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    $count = WC()->cart->cart_contents_count;
    if ($count>0)
    {
        echo '<span class = "cart-contents">';
        echo $count;
        echo '</span>';
    }
    else{
        echo '<span class="cart-contents zero"></span>';
    }
    $fragments['span.cart-contents'] = ob_get_clean();
    return $fragments;
}

/*function add_rewrite_rules( $wp_rewrite )
{
    $new_rules = array(
        'blog/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');

function change_blog_links($post_link, $id=0){

    $post = get_post($id);

    if( is_object($post) && $post->post_type == 'post'){
        return home_url('/blog/'. $post->post_name.'/');
    }

    return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);*/


function my_enqueue($hook) {
    if ($hook!='toplevel_page_r_opt') return;
    wp_register_style( 'custom_wp_admin_css', get_template_directory_uri().'/inc/css/admin-kost.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );

}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

add_action('init', function(){
    register_post_type('custom_author', array(
        'labels'             => array(

            'name'               => 'Авторы', // Основное название типа записи
            'singular_name' => 'Автор',
            'add_new'            => 'Добавить нового автора',
            'add_new_item'       => 'Добавить нового автора',
            'edit_item'          => 'Редактировать автора',
            'new_item'           => 'Новый автор',
            'view_item'          => 'Посмотреть автора',
            'search_items'       => 'Найти автора',

        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_nav_menus' => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title','thumbnail','excerpt')
    ) );
});


/*!!!!!!!*/
require get_template_directory() . '/inc/sample-config.php';

        require get_template_directory() . '/inc/wc-archive-func.php';

        require get_template_directory() . '/inc/wc-product-func.php';

        require get_template_directory() . '/inc/wc-cart-func.php';

        require get_template_directory() . '/inc/edit-data/catalog-data.php';

        require get_template_directory() . '/inc/contents_class.php';


add_action( 'rest_api_init', function () {
    register_rest_route( 'medikafarm/v2', '/likes/(?P<id>\d+)', array(
        'methods' => array('GET','POST'),
        'callback' => 'add_like',
    ) );
});
add_action( 'rest_api_init', function () {
    register_rest_route( 'medikafarm/v2', '/dislikes/(?P<id>\d+)', array(
        'methods' => array('GET','POST'),
        'callback' => 'add_dislike',
    ) );
});

function add_dislike( WP_REST_Request $request ) {
    $field_name = 'dislikes_number';
    $current_likes = get_field($field_name, $request['id']);
    $updated_likes = $current_likes + 1;
    $likes = update_field($field_name, $updated_likes, $request['id']);
    return $likes;
}

function add_like( WP_REST_Request $request ) {
    $field_name = 'likes_number';
    $current_likes = get_field($field_name, $request['id']);
    $updated_likes = $current_likes + 1;
    $likes = update_field($field_name, $updated_likes, $request['id']);
    return $likes;
}



add_filter( 'the_content', 'contents_on_post_top', 20 );
function contents_on_post_top( $content ){
    if( ! is_single() )
        return $content;
    if (is_product())
        return $content;
    $args = array(
        'margin'    => 30,
        'to_menu'   => false,
        'title'      => 'Содержание:',
        'markup' => 'true',
        'selectors' => array('h2','h3','h4','h5','h6'),
    );

    $contents = Kama_Contents::init( $args )->make_contents( $content );

    return $contents . $content;
}



function cquote_code( $atts ){
    $result = '<div class="content__quote">';
    $result .='<div class="content__qtitle">'.$atts["title"].'</div>';
    $result .='<div class="content__qtext">'.$atts["content"].'</div>';
    $result .='</div>';
    return $result;
}
add_shortcode('cquote_tag', 'cquote_code');

function cimportant_code( $atts ){
    $result = '<div class="content__opinion">';
    $result .='<div class="content__otitle">'.$atts["title"].'</div>';
    $result .='<div class="content__otext">'.$atts["content"].'</div>';
    $result .='</div>';
    return $result;
}
add_shortcode('cimportant_tag', 'cimportant_code');

function consultation_form_code( $atts ){
    $result = '<div class ="cf-form-parent d-flex justify-center">';
    $result .='<div class = "consultation-form cf-form-content d-flex flex-column">';
    $result .= '<div class = "cf-form-title">'.$atts['title'].'</div>';
    $result .='<div class = "text-center">'.$atts['description'].'</div>';
    $result .=do_shortcode('[contact-form-7 id="182" title="Бесплатная консультация"]');
    $result .='</div></div>';
    return $result;
}
add_shortcode('consultation_tag', 'consultation_form_code');



add_action('wp_head', 'add_description',1);
        function add_description()
        {
            if (!is_archive())
            {
                $description = get_field('description');
                if ($description !='')
                echo '<meta name="description" content="'.$description.'">';
            }
        }

        add_action('document_title_parts', 'add_title');
        function add_title($parts){
            $title = get_field('title');
            if ($title!='')
            {
                if( isset($parts['tagline']) )
                {
                    unset($parts['tagline'] );
                }
                if( isset($parts['site']) )
                    unset($parts['site']);

                $parts['title'] = $title;
    }
    return $parts;

}

function rel_next_prev(){

    if ((is_page_template('answer-question.php' ))||(is_page_template('revews.php' )))
    {

        global $paged;
        if ($paged>0)
        {
            ?>
        <link rel="prev" href="<?php echo get_pagenum_link( $paged-1); ?>" /><?php
        }

    ?>
        <link rel="next" href="<?php echo get_pagenum_link( max(2,$paged+1)); ?>" />
    <?php
	}
}
add_action( 'wp_head', 'rel_next_prev' );




function lazy_video($url,$width,$height)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    $video_id = $match[1];
    $video_icon = get_template_directory_uri().'/inc/images/youtube-icon.png'?>
    <iframe
            width = <?php echo $width.'px'?>;
            height = <?php echo $height.'px'?>;
            id="videoframe"
            srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{background:#000;height:100%}img{position:absolute;width:100%;top:0;bottom:0;margin:auto}</style>
  <a href=https://www.youtube-nocookie.com/embed/<?php echo $video_id ?>?autoplay=1&modestbranding=1&iv_load_policy=3&theme=light&playsinline=1>
  <img src=https://img.youtube.com/vi/<?php echo $video_id ?>/hqdefault.jpg>
  <img id='playbutton' src='<?php echo $video_icon?>' style='width: 66px; position: absolute; left: 41.5%;'></a>"
            frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            scrolling="no"
            loading="lazy"
            style="background-color: #000">
    </iframe>
    <?php
}

function custom_page_count($link_base)
{
    for ($i=20;$i<=60;$i+=20)
    {
        $link = add_query_arg(array( 'posts_per_page' => $i),$link_base );
        echo '<a href="'.$link.'">'.$i.'</a>';
        if ($i<100) echo ' | ';
    }
    $link = add_query_arg(array( 'posts_per_page' => 100),$link_base );
    echo '<a href="'.$link.'">100</a>';
}

function custom_pagination($page_number,$current_page)
{
    if ($page_number>1)
    {
        echo '<div class = "pagination">';
        if ($current_page>1)
        {
            $link = get_pagenum_link( $current_page-1 );
            echo '<a href ="'.$link.'" rel = "prev">&laquo;</a>';
        }
        if ($current_page>3)
        {
            $link = get_pagenum_link( 1 );
            echo '<a href ="'.$link.'">1</a>';
        }
        if ($current_page>4)
        {
            $link = get_pagenum_link( max(1,$current_page-5) );
            echo '<a href ="'.$link.'">...</a>';
        }
        for ($i = max(1,$current_page-2);$i<=min($page_number, $current_page+2);$i++)
        {
            $link = get_pagenum_link( $i );
            $active = ($current_page==$i)?(' class ="active"'):('');
            echo '<a href ="'.$link.'"'.$active.'>'.$i.'</a>';
        }
        if (($current_page+3)<$page_number)
        {
            $link = get_pagenum_link( min($page_number,$current_page+3) );
            echo '<a href ="'.$link.'">...</a>';
        }
        if (($current_page+2)<$page_number)
        {
            $link = get_pagenum_link($page_number);
            echo '<a href ="'.$link.'">'.$page_number.'</a>';
        }
        if ($current_page<$page_number)
        {
            $link = get_pagenum_link( $current_page+1 );
            echo '<a href ="'.$link.'" rel = "next">&raquo;</a>';
        }
        echo '</div>';
    }
}





function archive_certificates($title,$cert)
{
    ?>
    <div class = "archive-certificates-block">

        <h2>Сертификаты для <?php echo $title ?></h2>
            <div id = "gallery" class = " certificates-container d-flex fw">
                <?php
                    foreach ($cert as $id => $name)
                    {
                        $url = wp_get_attachment_image_url($id,'large');
                        ?>
                        <figure class = "certificates-img-wrapper">
                            <a href="<?php echo $url ?>">
                                <img class = "certificates-img lazy" data-src = "<?php echo $url ?>">
                            </a>
                            <div class= "certificates-title">
                                <?php echo $name ?>
                            </div>
                        </figure>
                        <?php
                    }
                ?>
            </div>
    </div>

    <?php

}

add_filter( 'post_type_link', 'course_admin_link', 10, 4 );
function course_admin_link( $post_link, $post, $leavename, $sample ){
    if (get_the_terms( $post, 'pa_course' )[0]->slug == 'course')
    {
        $post_link = str_replace('/product/','/course/',$post_link);
    }

    return $post_link;
}

add_filter( 'template_include', 'course_redirect', 99 );
function course_redirect( $template ) {
    global $post;

    if (get_the_terms( $post, 'pa_course' )[0]->slug == 'course')
    {
        global $wp;
        $link = home_url( $wp->request );
        if (strpos($link,'/product/')!==false)
        {
            if ($new_template = locate_template(array('404.php'))) ;
            return $new_template;
        }
    }
    return $template;
}



global $pf_override;

class URL_override {

    public $child_attrs = ['brand','country'];
    public $solo_attrs = array('brand','country','genotype');

    public $attr_names = array();
    public $cat_names = array();
    public $term_names = array(array());

    public $filled_attrs = array(array());

    public $cur_cat;
    public $cur_attr;
    public $cur_term;

    public $data = array();

    function __construct() {

        // add filters
        //add_filter( 'init', array( &$this, 'populates_site_terms' ) );
        add_action('init', array( &$this, 'change_cat_urls' ));
        add_action('get_header',array(&$this,'initialize_data'));

        add_filter( 'document_title_parts', array( &$this, 'change_cat_titles' ));
        add_action('wp_head',array(&$this,'set_description'),1);

        add_action('attributes_side_menu',array( &$this, 'build_side_menu' ));

        add_action('woocommerce_shop_loop',array( &$this, 'calc_attributes' ),100);

        add_action('attributes_tag_cloud',array( &$this, 'build_tag_cloud' ));

        add_filter('term_link', array( &$this, 'change_term_links' ),10,3);

        add_filter( 'woocommerce_loop_product_link', array( &$this, 'change_post_links' ),999,2 );

        add_filter('woocommerce_page_title',array( &$this, 'change_archive_h1' ),10,1);

        add_action('wc_archive_additional_info',array( &$this, 'additional_info' ),10);
        add_filter( 'woocommerce_get_breadcrumb', array( &$this, 'change_breadcrumb'),10 );

    }



    function change_cat_titles($parts){
        if (is_archive())
        {
        $title = $this->data['meta-title'];
        if ($title!='')
        {
            if( isset($parts['tagline']) )
            {
                unset($parts['tagline'] );
            }
            if( isset($parts['site']) )
                unset($parts['site']);
            $parts['title'] = $title;
            }
        }
        return $parts;
    }
    function set_description()
    {
        if (is_archive()){
        $description = $this->data['meta-description'];
        if ($description !='')
            echo '<meta name="description" content="'.$description.'">';
        }
    }

    function  change_archive_h1($title){
        if (is_archive())
        {
        $title = $this->data['h1-title'];
        }
        return $title;
    }

    function additional_info(){
        if (is_archive())
        {
        $cat =  $this->get_cat();
        $attr= $this->get_attr_term();
        $term = $this->cur_term;

        archive_description($this->data['text-title'],$this->data['text-content']);
        archive_certificates($this->data['cert-title'],$this->data['certificates']);
        if (isset($attr) & isset($cat)&($cat!=''))
        {
            ?>

            <div class = "archive-similar-products-block">

                <h2><?php echo $this->data['simprod-title']?></h2>
                <ul class="products columns-3">
                    <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,
                        'tax_query' => array(
                            'relation'=>'AND',
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $cat,
                            ),
                            array(
                                'taxonomy' => 'pa_'.$attr,
                                'field'    => 'slug',
                                'terms'    =>  $term,
                                'operator' => 'NOT IN',
                            ),


                        ),
                    );
                    $loop = new WP_Query( $args );

                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <?php
        }
        }

    }




    function initialize_data(){
        $cat =  $this->get_cat();
        $attr= $this->get_attr_term();
        $term = $this->cur_term;
        $cat_name = $this->cat_names[$cat];
        $attr_name = $this->attr_names[$attr];
        $term_name = $this->term_names[$attr][$term];
        $this->data = catalog_additional_info($cat_name,$attr_name,$term_name);

    }
    function change_breadcrumb( $crumbs ) {
        if (!is_archive()) return $crumbs;

        $cat =  $this->get_cat();
        $attr= $this->get_attr_term();
        $term = $this->cur_term;

        if ($term)
        {
            if ($cat)
            {
                $crumbs[2][0] = $this->cat_names[$cat].' '.$this->term_names[$attr][$term];
                $crumbs[2][1] = '';
            }
            else{
                $crumbs[1] = $crumbs[2];
                unset($crumbs[2]);
            }

        }

        return $crumbs;
    }

    function get_cat()
    {
        if (!isset($this->cur_cat))
        {
            global $wp_query;

            $this->cur_cat =  isset($wp_query->query['product_cat'])?$wp_query->query['product_cat']:'';
        }
        return $this->cur_cat;

    }
    function get_attr_term()
    {
        global $wp_query;
        if (!isset($this->cur_attr))
        {
            foreach ($this->solo_attrs as $attr)
            {
                if (isset($wp_query->query['pa_'.$attr]))
                {
                    $this->cur_attr= $attr;
                    $this->cur_term =isset($wp_query->query['pa_'.$attr])?$wp_query->query['pa_'.$attr]:'';
                }
            }
        }
        return $this->cur_attr;
    }






    function change_post_links( $link, $product ) {
            if($product->get_attribute('pa_course'))
                $link = str_replace('product','course',$link);
            return $link;
    }

    function change_term_links( $link, $term, $taxonomy ){

        if ($taxonomy == 'product_cat')
        {
            $link = preg_replace('(product-category/)','',$link);
        }
        foreach ($this->solo_attrs as $attr)
        {
            if ($taxonomy == 'pa_'.$attr)
                {
                    $link = preg_replace('('.$attr.'/)','',$link);
                }
        }

        return $link;

    }

    function build_tag_cloud($category)
    {
        $cat =  $this->get_cat();
        $q_attr= $this->get_attr_term();

        if ($q_attr) return;
        ?>
        <div class = "tagcloud d-flex order-1">
        <?php
        foreach ($this->filled_attrs as $attr => $term)
        {
            foreach ($term as $slug=>$value)
            {
                    echo '<div class = "tagcloud__tag-container">';
                    echo '<a href = "' . get_bloginfo('url') . '/' . $cat . '/' . $slug . '" class = "tagcloud__tag-link">';
                    echo $this->term_names[$attr][$slug];
                    echo '</a>';
                    echo '</div>';
            }
        }
        ?>
        </div>
            <?php

    }

    function calc_attributes(){
        global $post;
        foreach ($this->child_attrs as $attr)
        {
            $terms = get_the_terms($post,'pa_'.$attr);
            foreach ($terms as $term)
            {
                $this->filled_attrs[$attr][$term->slug] = true;
            }
        }
    }

    function build_side_menu(){
        echo '<div class ="side-menu__header">';
        echo 'Вещества';
        echo '</div><ul class = "side-menu__list">';
        foreach($this->cat_names as $slug => $name)
        {
            echo '<li class = "side-menu__list-item">';
            echo '<a href = "'.get_bloginfo('url').'/'.$slug.'" class = "side-menu__link base-link" >';
            echo $name;
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        foreach($this->solo_attrs as $attr)
            {echo '<div class ="side-menu__header">';
            echo $this->attr_names[$attr];
            echo '</div><ul class = "side-menu__list">';
                    foreach($this->term_names[$attr] as $slug => $name)
                    {
                        echo '<li class = "side-menu__list-item">';
                        echo '<a href = "'.get_bloginfo('url').'/'.$slug.'" class = "side-menu__link base-link" >';
                        echo $name;
                        echo '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
            }
    }

    function change_cat_urls() {


        //Добавляем URL на курсы
        add_rewrite_rule(

            '^course/([^/]+)/?(:/([0-9]+))?/?$',
            'index.php?product=$matches[1]',
            'top'
        );

        $wooCats = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ]);
        array_shift($wooCats);


        $catSlugs = [];
        foreach($wooCats as $wooCat) {
                $catSlugs[] = $wooCat->slug;

                $this->cat_names[$wooCat->slug] =$wooCat->name;
        }

        //Добавляем URL на категорию
        add_rewrite_rule(
            '^('.implode('|', $catSlugs).')$/?',
            'index.php?product_cat=$matches[1]',
            'top'
        );
        add_rewrite_rule(
            '^('.implode('|', $catSlugs).')/page/?([0-9]{1,})/?$',
            'index.php?product_cat=$matches[1]&paged=$matches[2]',
            'top'
        );

        foreach($this->solo_attrs as $attr) {

            $terms = get_terms([
                'taxonomy' => 'pa_'.$attr,
                'hide_empty' => false,
            ]);

           $this->attr_names[$attr] = wc_attribute_label('pa_'.$attr);

            $termSlugs=[];
            foreach($terms as $term){
                $termSlugs[]=$term->slug;

                $this->term_names[$attr][$term->slug] =$term->name;

            }

            //Добавляем URL на атрибуты
            add_rewrite_rule(
                '^('.implode('|', $termSlugs).')$/?',
                'index.php?pa_'.$attr.'=$matches[1]',
                'top'
            );
            add_rewrite_rule(
                '^('.implode('|', $termSlugs).')/page/?([0-9]{1,})/?$',
                'index.php?pa_'.$attr.'=$matches[1]'.'&paged=$matches[2]',
                'top'
            );

            //Добавляем URL на категорию+атрибут

            if (in_array($attr,$this->child_attrs))
            {
                add_rewrite_rule(
                    '^('.implode('|', $catSlugs).')/('.implode('|', $termSlugs).')$/?',
                    'index.php?product_cat=$matches[1]&pa_'.$attr.'=$matches[2]',
                    'top'
                );
                add_rewrite_rule(
                    '^('.implode('|', $catSlugs).')/('.implode('|', $termSlugs).')/page/?([0-9]{1,})/?$',
                    'index.php?product_cat=$matches[1]&pa_'.$attr.'=$matches[2]'.'&paged=$matches[3]',
                    'top'
                );
            }

        }
    }


}
$pf_override = new  URL_override();

add_filter('loop_shop_columns', 'loop_columns');

if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3;
    }
}

add_filter( 'woocommerce_currency_symbol', 'change_rub_symbol', 50 );
function change_rub_symbol() {
// Just returns rubles :)
    return 'руб.';
}



