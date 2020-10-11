<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pharmatest
 */

get_header();

?>

	<div class="container d-flex">
        <div class="title-404 d-flex allign-center justify-around">
            <img height="400" class="" src="<?php echo get_template_directory_uri()?>/inc/images/404-doctor.png">
            <div class="d-flex flex-column justify-center">
                <h1>Страница не найдена</h1>
                <a class="base-link" href="<?php echo get_home_url() ?>"><h2>вернуться на главную</h2></a>
                <a class="base-link" href="<?php echo get_home_url() ?>/catalog"><h2>перейти в каталог </h2></a>
            </div>
        </div>
    </div>
<?php
get_footer();
