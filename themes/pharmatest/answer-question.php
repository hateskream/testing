<?php
/*
Template Name: Шаблон вопрос-ответ
Template Post Type: page
*/

get_header();
$mini_photo = get_field('mini_photo');
$link_base = get_permalink();
?>
    <div class ="faq-page main-container container">
        <div class ="upper-form d-flex flex-column">
            <div class ="upper-form__title d-flex flex-column">
                <h1><?php the_title() ?></h1>
            </div>
            <div class ="upper-form__content d-flex">
                <div class ="upper-form__left col33-md">
                    <?php the_content() ?>
                </div>
                <?php
                $image = get_the_post_thumbnail_url();
                $style = 'background-image: url('.$image.');'
                ?>
                <div class ="upper-form__mid col33-md" style = "<?php echo $style ?>">
                </div>
                <div class ="upper-form__right col33-md">
                    <div class ="cf-form-parent">
                        <?php echo do_shortcode('[contact-form-7 id="252" title="Вопрос-ответ"]');?>
                    </div>
                </div>
            </div>
        </div>
<?php
global $wp_query;
$paged = ($wp_query->query_vars['paged'])?($wp_query->query_vars['paged']):1;
$per_page = ($_GET['posts_per_page'])?($_GET['posts_per_page']):20;

$args = array(
    'posts_per_page' => $per_page,
    'paged' =>$paged,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'flamingo_inbound',
    'suppress_filters' => true,
    'tax_query' => array(
        array(
            'taxonomy' => 'flamingo_inbound_channel',
            'field' => 'term_id',
            'terms' => 47,
        ),
    ),
    'meta_query' => array(
        array(
            'key'     => 'published',
            'value'   => 'on',
        ),
    ),
);
$query = new WP_Query($args);
$count = $query->post_count;
$max_count = $query->found_posts;
?>


        <div class="faq-form">
            <div class="faq-form__title">
                <h2>Вопрос - Ответ</h2>
            </div>

    <!--        
			<div class="page-counter d-flex justify-between">
                <div>
                    <span>Отображается с <?php echo ($paged-1)*$per_page+1; ?>  по <?php echo ($paged-1)*$per_page+$count; ?>  из <?php echo $max_count ?>. Отображать результатов на страницу - </span>
                    <?php
                    custom_page_count($link_base);
                    ?>
                </div>
            </div>
	-->

            <div>
                <?php
                while ($query->have_posts())
                {
                    $query->the_post();
                        $id = get_the_ID();
                        $question = get_post_meta( $id, 'question', true );
                        $question_date = get_post_meta( $id, 'question_date', true );
                        $question_name = get_post_meta( $id, 'question_name', true );
                        $answer = get_post_meta( $id, 'answer', true );
                        $answer_date = get_post_meta( $id, 'answer_date', true );
                        echo '<div class="faq-form__block d-flex flex-column">';
                        echo '<div class="faq-form__question d-flex flex-column">';
                        echo '<div class="faq-form__qupper d-flex justify-between">';
                        echo '<div class="faq-form__qtitle">Вопрос</div>';
                        echo '<div class="faq-form__time">'.$question_date.'</div>';
                        echo '</div>';
                        echo '<div class="faq-form__qtext">';
                        echo $question;
                        echo '</div>';
                        echo '<div class="faq-form__qsign">';
                        echo $question_name;
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="faq-form__answer d-flex">';
                        echo '<div class="faq-form__avatar">';
                        echo '<img class="faq-form__image" src="'.$mini_photo.'">';
                        echo '</div>';
                        echo '<div class="faq-form__rblock">';
                        echo '<div class="faq-form__answer-block d-flex flex-column ">';
                        echo '<div class="faq-form__atop d-flex justify-between">';
                        echo '<div class="faq-form__atitle">';
                        echo 'Ответ врача:';
                        echo '</div>';
                        echo '<div class="faq-form__time">';
                        echo $answer_date;
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="faq-form__atext">';
                        echo $answer;
                        echo '</div>';
                        echo '</div> </div> </div> </div>'; }?>
            </div>
        </div>


<?php
//$link = add_query_arg(array( 'posts_per_page' => '1'),home_url($wp->request) );
//echo $link;
custom_pagination($query->max_num_pages,$paged);
?>

    </div>
        <?php
wp_reset_postdata();
get_footer();
