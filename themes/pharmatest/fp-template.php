<?php
/*
Template Name: Шаблон главной
Template Post Type: page
*/

get_header();
global $r_opt;

?>


    <main id="primary" class="site-main">
        <div class ="main-container container">
            <?php
            $banner = $r_opt['banner'];
            $url = $banner['url'];
            $height = $banner['height'];
            $style = 'style="'.'background-image:url('.$url.');'.'height:'.$height.'px;'.'"';
            ?>
            <div class="index1 ph container d-flex justify-center align-end" <?php echo $style;  ?>>
                <div class="index1__button-div d-flex">
                    <a class="index1__button1 base-button" href="#"> Получить скидку</a>
                </div>
            </div>

            <div class="index2 container d-flex justify-center flex-column">
                <div class="index2__title fp-title d-flex justify-center">
                    <h1><?php echo get_field('block1_title');?></h1>
                </div>
                <div class="d-flex fw">
                    <div class="d-flex justify-center col50-lg fw" >
                    <?php
                    lazy_video($r_opt["block1_video"], 576,324);
                    ?>


                    </div>
                    <div class="index2__text col50-lg">
                       <?php echo get_field('block1_text');?>
                    </div>
                </div>
            </div>


            <div class = "index-products ">
                <div class = "index-products__title fp-title d-flex justify-center">
                    <h2><?php echo get_field('block2_title');?></h2>
                </div>
                <?php
                $wooCats = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ]);
                array_shift($wooCats);
                ?>
                <div class = "category-tabs-container col90 ma">
                    <ul class = "category-tabs d-flex fw justify-center">
                        <?php
                        $c = 0;
                        foreach($wooCats as $cat)
                        {
                            $c++;
                            ?>
                            <li class = "category-tabs__tab <?php echo ($c==1)?'selected':''?>" data-slug = "<?php echo $cat->slug ?>">
                                <?php
                                echo $cat->name;
                                ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class ="woocommerce">
                    <?php
                    $c = 0;
                    foreach($wooCats as $cat)
                    {
                        $c++;
                        ?>
                        <div class = "<?php echo ($c==1)?'active ':''; echo $cat->slug;?>-wrapper fp-products-container">
                            <ul class="products columns-4">
                                <?php
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field'    => 'slug',
                                            'terms'    => $cat,
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
                    ?>
                </div>
            </div>





            <div class="index3 container d-flex justify-center flex-column">
                <div class="index3__title fp-title d-flex justify-center">
                    <h2><?php echo get_field('block3_title');?></h2>
                </div>
                <div class="d-flex fw">
                    <div class="index3__left d-flex col50-lg justify-center align-left flex-column">
                        <div class="index3__ltext1 d-flex fw"><span>Почему выбирают&nbsp</span><span>именно нас?</span></div>
                        <div class="index3__ltext2 d-flex flex-column">
                            <p>Познакомтесь с нашими преимуществами!</p>
                            <p> Мы уверены, что покупка у нас оставит </p>
                            <p> только положительные эмоции.</p>
                        </div>
                    </div>
                    <div class="index3__right d-flex fw col50-lg">
                        <div class="d-flex col50-sm flex-column justify-between">
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy" data-src="<?php echo get_template_directory_uri() ?>/inc/images/why-icon1.png">
                                <div class="index3__rtext">100% оригинальный препарат
                                </div>
                            </div>
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy " data-src= "<?php echo get_template_directory_uri() ?>/inc/images/why-icon2.png">
                                <div class="index3__rtext">Индивидуальные консультации с врачом</div>
                            </div>
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy " data-src= "<?php echo get_template_directory_uri() ?>/inc/images/why-icon3.png">
                                <div class="index3__rtext">Доставка курьером по России</div>
                            </div>
                        </div>
                        <div class="d-flex col50-sm flex-column justify-between">
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy " data-src= "<?php echo get_template_directory_uri() ?>/inc/images/why-icon4.png">
                                <div class="index3__rtext">На связи 24/7</div>
                            </div>
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy " data-src= "<?php echo get_template_directory_uri() ?>/inc/images/why-icon5.png">
                                <div class="index3__rtext">С нами удобно и приятно сотрудничать</div>
                            </div>
                            <div class="d-flex index3__relem">
                                <img class="index3__timage lazy " data-src= "<?php echo get_template_directory_uri() ?>/inc/images/why-icon6.png">
                                <div class="index3__rtext">К каждом препарату есть инструкция</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="index4 container d-flex justify-center flex-column">
                <div class="index4__title fp-title d-flex justify-center">
                    <h2><?php echo get_field('block4_title');?></h2>
                </div>
                <div class="d-flex fw justify-center ">
                    <?php $links = $r_opt['links-gallery'];
                    foreach ($links as $link)
                    {
                        echo '<div class="index4__container d-flex justify-end flex-column col25">';
                        echo '<a class = "base-link" href = "'.$link['url'].'">';
                        echo '<img class="index4__image" src="'.$link['image'].'">';
                        echo '<div class="ma index4__text">'.$link['title'].'</div>';
                        echo '</a> </div>';
                    };
                    ?>
                </div>

                <div class="d-flex justify-center">
                    <a class="base-button" href="<?php echo get_home_url()?>/catalog">В каталог</a>
                </div>

            </div>

        <div class="index6 container d-flex fw justify-center">
            <div class="index6__title fp-title d-flex justify-center">
                <h2><?php echo get_field('block5_title');?></h2>
            </div>
            <div class="slider1 d-flex align-center container">
                <?php $slides = $r_opt['brands-slider'];

                foreach ($slides as $slide)
                {
                    echo '<a href = "'.$slide['url'].'">';
                    echo '<div class="slider-item">';

                    echo '<img class="slider-image lazy" data-src="'.$slide['image'].'">';
                    echo '</div></a>';
                }
                ?>
            </div>
        </div>

        <div class = "archive-certificates-block container">
            <div class = "fp-title d-flex justify-center">
                <h2><?php echo get_field('block6_title');?></h2>
            </div>

            <div id = "gallery" class = " certificates-container d-flex fw">
                <?php $certificates = $r_opt['certificates'];
                foreach ($certificates as $cert)
                {
                    ?>
                    <figure class = "certificates-img-wrapper">
                        <a href="<?php echo $cert['image'] ?>">
                            <img class = "certificates-img lazy" data-src = "<?php echo $cert['image']?>">
                        </a>
                        <div class= "certificates-title">
                            <?php
                            echo $cert['title']
                            ?>

                        </div>
                    </figure>
                    <?php
                }
                ?>
            </div>
        </div>

            <div class = "howto-block container">
                <div class = "fp-title d-flex justify-center">
                    <h2><?php echo get_field('block7_title');?></h2>
                </div>
                <div class = "howto-block__content">
                    <?php echo get_field('block7_text');?>
                </div>
            </div>

        <div class = "container">
        <div class ="cf-form-parent cf90 d-flex justify-center">
            <?php echo do_shortcode('[contact-form-7 id="124" title="Бесплатная консультация"]');?>
        </div>


        </div>

        <div class="index7 container d-flex fw justify-center">
            <div class="index7__title fp-title d-flex justify-center">
                <h2><?php echo get_field('block8_title');?></h2>
            </div>
            <div class="slider2 d-flex align-center container">
                <?php $slides_v = $r_opt['video-slider'];

                foreach ($slides_v as $slide_v)
                {?>
                    <div class="slider-item d-flex">
                        <?php lazy_video($slide_v['url'], 480,270);?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="index8 container d-flex flex-column">
            <div class="index8__title fp-title d-flex justify-center">
                <h2><?php echo get_field('block9_title');?></h2>
            </div>
            <div class="faq ma">
                <ul class="faq__div d-flex fw justify-center">
                    <li class="faq__title selected" data-id="1">Cофосбувир</li>
                    <li class="faq__title" data-id="2">Даклатасвир</li>
                    <li class="faq__title" data-id="3">Ледипасвир</li>
                    <li class="faq__title" data-id="4">Велпатасвир</li>
                    <li class="faq__title" data-id="5">Общие вопросы</li>
                </ul>
                <?php

                for ($i = 1;$i<6;$i++)
                {   $faq_id='faq'.$i.'-tab';
                    $faq=$r_opt[$faq_id];
                    ?>

                    <div class="accordeon<?php echo $i ?> accordeon">
                        <?php

                        foreach ($faq as $element)
                        {
                            ?>
                            <div class="acc-head">
                                <?php echo $element['title'];?>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <div class="acc-body">
                                <?php echo $element['description'];?>;
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
        </div>
        </div>

    </main>

<?php
get_footer();
