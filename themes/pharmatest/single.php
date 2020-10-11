<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pharmatest
 */

get_header();
$author = get_field('blog_author');
$archive_page = get_pages(
    array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'blog-template.php'
    )
);
$archive_id = $archive_page[0]->ID;
$blog_archive_link =  get_permalink( $archive_id );
wp_reset_postdata();
?>


    <div class="single main-container container">
        <div class="top-block">
            <?php
            $image = get_the_post_thumbnail_url();
            $style = 'background-image: url('.$image.');';
            ?>

            <div class="top-block__wrapper" >
                <div class="top-block__blog-header " style = "<?php echo $style ?>">
                    <div class="top-block__nav">
                        <a href="<?php echo get_home_url(); ?>">Главная</a>
                        &nbsp;/&nbsp;
                        <a href="<?php echo $blog_archive_link; ?>">Блог</a>
                        &nbsp;/&nbsp;<?php the_title() ?>
                    </div>
                    <div class="top-block__title">
                        <h1><?php the_title() ?></h1>
                    </div>
                </div>
            </div>
            <div class="top-block__info d-flex justify-between">
                <div class="top-block__left">
                    <div class="top-block__author">
                        <b>Автор:</b> гепатолог <a class = "base-link" href="#"><?php echo get_the_title($author); ?></a>
                    </div>
                    <div class="top-block__date">
                        <b>Дата публикации:</b> <?php echo get_the_date() ?>
                    </div>
                </div>
                <div class="top-block-right d-flex align-center">
                    <?php echo do_shortcode("[uptolike]"); ?>
                    <div class = "comments-count">
                        <a href="#disqus_thread">1</a>
                    </div>
                </div>

            </div>
            <div class="top-block__text">
                <?php echo get_field('intro_text'); ?>
            </div>

        </div>
        <div

        <div class="content d-flex flex-column">
            <div class="content__top-wrap d-flex">
                <div class="content__left">
                    <div class="content__text-field">
                       <?php
                       the_content();
                       ?>
                    </div>
                    <div class = "d-flex justify-between align-center">
                        <div class = "likes-bot-wrapper d-flex">
                            <div class = "like-container">
                                <a class="like__btn base-link" href = "2"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                <span class="like__number"><?php
                                    $number = get_field('likes_number');
                                    if ($number == '') echo 0;
                                    else echo $number;
                                    ?></span>
                            </div>
                            <div class = "like-container">
                                <a class="dislike__btn base-link" href = "2"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                <span class="dislike__number"><?php
                                    $number = get_field('dislikes_number');
                                    if ($number == '') echo 0;
                                    else echo $number;
                                    ?></span>
                            </div>
                        </div>
                        <div class = "share-bot-wrapper">
                            <?php echo do_shortcode("[uptolike]"); ?>
                        </div>
                    </div>
                    <div class="content__bot-wrap">
                        <div class="bot-block d-flex justify-between">
                            <div class="bot-block__left d-flex">
                                <div class="bot-block__photo">
                                    <?php
                                    $image =  get_the_post_thumbnail_url($author);
                                    ?>
                                    <img class="bot-block__photo-img" src="<?php echo $image; ?>">
                                </div>
                                <div class="bot-block__author">
                                    <div class="bot-block__descr">
                                        Автор:
                                    </div>
                                    <div class="bot-block__author-name">
                                        <a class="base-link" href="<?php echo get_field('author_link',$author)  ?>"><?php echo get_the_title($author); ?></a>
                                    </div>
                                    <div class="bot-block__author-descr">
                                        <?php echo get_the_excerpt($author); ?>
                                    </div>

                                    <div class="bot-block__soc d-flex">
                                        <?php $link = get_field('site_link',$author);
                                        if ($link!='')
                                        {
                                        ?>
                                        <a href = "https://wa.me/79138027235" target="_blank" title = "Ссылка на сайт автора" class="bot-block__soc-icon">
                                            <i class="fa fa-user-md"></i>
                                        </a>
                                        <?php } ?>
                                        <?php $link = get_field('vk_link',$author);
                                        if ($link!='')
                                        {
                                        ?>
                                        <a href = "https://wa.me/79138027235" target="_blank" class="bot-block__soc-icon">
                                            <i class="fa fa-vk"></i>
                                        </a>
                                        <?php } ?>
                                        <?php $link = get_field('fb_link',$author);
                                        if ($link!='')
                                        {
                                        ?>
                                        <a href = "https://vk.com/v_kakoy_apteke_kupit_sofosbuvir" class="bot-block__soc-icon">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <?php } ?>
                                        <?php $link = get_field('twitter_link',$author);
                                        if ($link!='')
                                        {
                                        ?>
                                        <a href = "https://vk.com/v_kakoy_apteke_kupit_sofosbuvir" class="bot-block__soc-icon">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $articles = get_posts( array(
                                'numberposts' => 3,
                                'orderby'     => 'date',
                                'order'       => 'DESC',
                                'meta_key'    => 'blog_author',
                                'meta_value'  =>$author,
                                'post_type'   => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            ) );
                            $count = count($articles);
                            if ($count>0)
                            {
                                ?>
                                <div class="bot-block__articles">
                                <div class="bot-block__atitle">
                                    Последние статьи автора
                                </div>
                            <?php
                                foreach( $articles as $article ){
                                ?>
                                    <div class="bot-block__single-article">
                                        <a href="<?php echo get_the_permalink($article->ID) ?>" class="base-link"><?php echo get_the_title($article->ID); ?></a>
                                    </div>
                                <?php
                                }
                                ?>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $related_products = get_field('related_products');
                $related_posts = get_field('related_posts');
                if (($related_products!='')||($related_posts!=''))
                {
                    ?>
                <div class="content__right d-flex  flex-column ">
                    <?php
                    if ($related_products!='')
                    {
                        ?>
                    <div class="content__products">
                        <div class="content__ptitle">
                            Упомянутые товары:
                        </div>
                        <div class="content__plist">
                            <?php
                            foreach ($related_products as $rp)
                            {
                                $term = get_the_terms ( $rp, 'product_cat' )[0];
                                $product = wc_get_product($rp);
                            ?>
                            <div class="content__single-item d-flex justify-center flex-column">
                                <a href="<?php echo get_permalink($rp) ?>" class="base-link">
                                <div class="content__item-descr">
                                    <?php echo $product->get_name(); ?>
                                </div>
                                <div class="content__item-picture">
                                    <?php echo $product->get_image('thumbnail'); ?>
                                </div>
                                </a>
                                <div class="content__item-name">
                                    <a href="<?php echo get_term_link($term->term_id,'product_cat'); ?>" class="base-link"><?php echo $term->name ?></a>
                                </div>
                            </div>
                                <?php
                            }
                                ?>
                        </div>
                    </div>
                        <?php
                    }
                    if ($related_posts!='')
                    {
                    ?>
                    <div class="content__articles">
                        <div class="content__atitle">
                            Статьи по теме:
                        </div>
                        <?php
                        foreach ($related_posts as $related_post)
                        {
                            ?>
                            <div class="content__single-article">
                                <a href="<?php echo get_the_permalink($related_post); ?>" class="base-link"><?php echo get_the_title($related_post); ?></a>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                        <?php
                    }
                    ?>
                </div>
                    <?php
                    }
                ?>
            </div>

        </div>

 <?php

 comments_template();
 ?>
    </div>

<?php
get_footer();
