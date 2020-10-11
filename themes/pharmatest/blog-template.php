<?php
/*
Template Name: Шаблон блога
Template Post Type: page
*/

get_header();
?>
    <div class ="blog-page main-container container">
        <?php
        global $wp_query;
        $paged = ($wp_query->query_vars['paged'])?($wp_query->query_vars['paged']):1;
        $per_page = ($_GET['posts_per_page'])?($_GET['posts_per_page']):20;

        $args = array(
            'posts_per_page' => $per_page,
            'paged' =>$paged,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
        );
        $query = new WP_Query($args);
        $count = $query->post_count;
        $max_count = $query->found_posts;
        ?>
        <h1><?php the_title(); ?></h1>
        <div class = "posts-container d-flex fw">
        <?php
        while($query->have_posts())
        {
            $query->the_post();
            $link = get_the_permalink();
            $image = get_the_post_thumbnail_url(get_the_ID(),'medium');
            $style = 'background-image: url('.$image.');';
            ?>
            <div class = "post-item d-flex flex-column">
                <a href = "<?php echo $link ?>">
                    <div class = "post-image" style = "<?php echo $style; ?>">
                    </div>
                </a>
                <div class = "post-info-group d-flex flex-column justify-between">
                    <a href = "<?php echo $link ?>" class = "base-link">
                        <span class ="post-title d-inline"><?php the_title();?></span>
                    </a>
                    <div class = "post-description">
                        <?php echo get_field('intro_text') ?>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    </div>
        <?php
        custom_pagination($query->max_num_pages,$paged);
        ?>
    </div>
<?php
wp_reset_postdata();
get_footer();
