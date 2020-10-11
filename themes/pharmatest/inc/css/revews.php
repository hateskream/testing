<?php
/*
Template Name: Шаблон отзывы
Template Post Type: page
*/

get_header();
function age_text($age)
{
    $n = $age%10;
    if (($n == 0)||($n>4))
        return 'лет';
    if ($n > 1) return 'года';
    return 'год';
}

?>
    <div class ="rpage main-container container">
        <div class ="rpage__wrap d-flex flex-column">
            <div class="rpage__title d-flex justify-center">
                <h1><?php the_title(); ?></h1>
            </div>
            <?php
            $bg_image = get_field('block_bgimg');
            $bg_style = 'background-image: url('.$bg_image.')';
            ?>
            <div class="rpage__description" style = "<?php echo $bg_style ?>">
                <?php the_content(); ?>
            </div>
<?php

global $wp_query;
$link_base = get_the_permalink();
$paged = ($wp_query->query_vars['paged'])?($wp_query->query_vars['paged']):1;

$per_page = ($_GET['posts_per_page'])?($_GET['posts_per_page']):20;
$photo = isset($_GET['photo'])?($_GET['photo']):2;
$video = isset($_GET['video'])?($_GET['video']):2;

$meta_query = array(
    array(
        'key'     => 'published',
        'value'   => 'on',
    ));

if ($photo == 0) {
    array_push($meta_query, array(
        'key' => 'review_gallery',
        'compare' => 'NOT EXISTS',
    ));
}
else if ($photo == 1)
{
    array_push($meta_query, array(
        'key' => 'review_gallery',
        'compare' => 'EXISTS',
    ));
}

if ($video == 0) {
    array_push($meta_query, array(
        'key' => 'review_video',
        'compare' => 'NOT EXISTS',
    ));
}

else if ($video == 1)
{
    array_push($meta_query, array(
        'key' => 'review_video',
        'compare' => 'EXISTS',
    ));
}

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
            'terms' => 49,
        ),
    ),
    'meta_query' => $meta_query,
);


$query = new WP_Query($args);
$count = $query->post_count;
$max_count = $query->found_posts;
$get_val = false;
if ($photo<2)
{
    $link_base.='?photo='.$photo;
    $get_val = true;
}
if ($video<2)
{
    $link_base.=($get_val)?('&'):('?');
    $link_base.='video='.$video;
    $get_val = true;
}
if ($per_page!=20)
{
    $link_base.=($get_val)?('&'):('?');
    $link_base.='posts_per_page='.$per_page;
    $get_val = true;
}
?>
            <div class = "rpage__filters d-flex">
                <div class = "rpage__filter">
                    <div class = "filter-title">
                        С фото
                    </div>
                    <select class = "filter-select" data-name = "photo"
                            data-src = "<?php echo add_query_arg(array( 'photo' => 1),$link_base );?>">
                        <option value = '2'> - не важно - </option>
                        <option value = '1' <?php echo ($photo==1)?('selected="selected"'):''?>> Да </option>
                        <option value = '0' <?php echo ($photo==0)?('selected="selected"'):''?>> Нет </option>
                    </select>
                </div>
                <div class = "rpage__filter">
                    <div class = "filter-title">
                        С видео
                    </div>
                    <select class = "filter-select" data-name = "video"
                            data-src = "<?php echo add_query_arg(array( 'video' => 1),$link_base );?>">
                        <option value = '2'> - не важно - </option>
                        <option value = '1' <?php echo ($video==1)?('selected="selected"'):''?>> Да </option>
                        <option value = '0' <?php echo ($video==0)?('selected="selected"'):''?>> Нет </option>
                    </select>
                </div>
            </div>
            <div class="rpage__counter d-flex justify-between">
                <div class="rpage__pages">
                        <span>Отображается с <?php echo ($paged-1)*$per_page+1; ?>  по <?php echo ($paged-1)*$per_page+$count; ?>  из <?php echo $max_count ?>. Отображать результатов на страницу - </span>
                        <?php
                        custom_page_count($link_base);
                        ?>
                </div>
                <div class="rpage__addreviewbtn">
                    <a class="rpage__scrollto" href="#text-block2">Добавить отзыв</a>
                </div>
            </div>
            <div class="rblock">
                <?php
                $figure_n = 0;
                while ($query->have_posts())
                {
                     $query->the_post();
                     $id = get_the_ID();
                        $review = get_post_meta( $id, 'review', true );


                        $review_name = get_post_meta( $id, 'review_name', true );
                        $review_date = get_post_meta( $id, 'review_date', true );
                        $review_age = get_post_meta( $id, 'review_age', true );
                        $review_city = get_post_meta( $id, 'review_city', true );
                        $review_diagnosis = get_post_meta( $id, 'review_diagnosis', true );
                        $review_track = get_post_meta( $id, 'review_track', true );
                        $review_cat = get_post_meta( $id, 'review_cat', true );
                        $review_product = get_post_meta( $id, 'review_product', true );
                        $review_video = get_post_meta( $id, 'review_video', true );
                        $ids = get_post_meta($id, 'review_gallery', true);?>
                        <div class="rblock__single-review d-flex">
                            <div class="rblock__left">
                                <div class="rblock__ltop">
                                    <div class="rblock__name">
                                        <?php echo $review_name;?>
                                    </div>
                                    <?php if ($review_age != ''){?>
                                    <div class="rblock__age">
                                        <?php echo $review_age.' '.age_text($review_age);?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="rblock__lbot">
                                    <div class="rblock__data d-flex">
                                        <div class="rblock__icon">
                                            <i class="fa fa-calendar footer3__icon"></i>
                                        </div>
                                        <div class="rblock__litem">
                                            <div class="rblock__ltitle">
                                                Дата публикации:
                                            </div>
                                            <div class="rblock__ltext">
                                                <?php echo $review_date;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($review_city != ''){?>
                                    <div class="rblock__data d-flex">
                                        <div class="rblock__icon">
                                            <i class="fa fa-map-marker footer3__icon"></i>
                                        </div>
                                        <div class="rblock__litem">
                                            <div class="rblock__ltitle">
                                                Город:
                                            </div>
                                            <div class="rblock__ltext">
                                                <?php echo $review_city;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($review_diagnosis != ''){?>
                                        <div class="rblock__data d-flex">
                                            <div class="rblock__icon">
                                                <i class="fa fa-file-text footer3__icon"></i>
                                            </div>
                                            <div class="rblock__litem">
                                                <div class="rblock__ltitle">
                                                    Диагноз:
                                                </div>
                                                <div class="rblock__ltext">
                                                    <?php echo $review_diagnosis;?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                  <?php if ($review_cat != ''){?>
                                    <div class="rblock__data d-flex">
                                        <div class="rblock__icon">
                                            <i class="fa fa-user-md footer3__icon"></i>
                                        </div>
                                        <div class="rblock__litem">
                                            <div class="rblock__ltitle">
                                                Назначение врача:
                                            </div>
                                            <div class="rblock__ltext">
                                                <?php $term=get_term_by('id', $review_cat,'product_cat');
                                                $term_link=get_term_link((int)$review_cat,'product_cat');
                                                echo '<a href="'.$term_link.'">'.$term->name.'</a>' ?>

                                            </div>

                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($review_product != ''){?>
                                    <div class="rblock__data d-flex">
                                        <div class="rblock__icon">
                                            <i class="fa fa-medkit footer3__icon"></i>
                                        </div>
                                        <div class="rblock__litem">
                                            <div class="" s="rblock__ltitle">
                                                Заказанный курс:
                                            </div>
                                            <div class="rblock__ltext">
                                                <?php echo '<a href="'.get_permalink($review_product).'">'.get_the_title($review_product).'</a>'; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if ($review_track != ''){?>
                                    <div class="rblock__data d-flex">
                                        <div class="rblock__icon">
                                            <i class="fa fa-truck footer3__icon"></i>
                                        </div>
                                        <div class="rblock__litem">
                                            <div class="rblock__ltitle">
                                                Почтовый трек-номер:
                                            </div>
                                            <div class="rblock__ltext">
                                                <a href="https://www.pochta.ru/tracking#<?php echo $review_track; ?>"> <?php echo $review_track;?> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="rblock__right">
                                <div class="rblock__rtext">
                                    <?php echo $review;?>
                                </div>

                                <?php if ($ids) :?>
                                    <div class="rblock__rimg review-photo d-flex">
                                        <?php

                                        foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,'full');
                                            echo '<figure data-number = "'.$figure_n.'">';
                                            echo '<a href = "'.$image[0].'" data-width = "'.$image[1].'" data-height = "'.$image[2].'">';
                                            echo '<img class="image-preview lazy" data-src="'.wp_get_attachment_image_url($value,'thumbnail').'">';
                                            echo '</a>';
                                            echo '</figure>';
                                            $figure_n++;
                                        endforeach; ?>
                                    </div>
                                <?php endif;?>
                                <?php if ($review_video != ''){?>
                                    <div class="rblock__video">
                                        <?php lazy_video($review_video, 288,162);?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <?php custom_pagination($query->max_num_pages,$paged);
            wp_reset_postdata();
            ?>
            <div class="rpage__description pt15" id = "text-block2" style = "<?php echo $bg_style ?>">
                <?php echo get_field('text_block2'); ?>
            </div>
    </div>
        <div class ="cf-form-parent">
            <?php echo do_shortcode('[contact-form-7 id="301" title="Отзывы"]');?>
        </div>
    </div>


<?php
get_footer();
