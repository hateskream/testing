<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pharmatest
 */
global $r_opt;
?>

<footer id="colophon" class="site-footer">
    <div class="footer1 container d-flex fw">
        <div class="d-flex flex-column align-center col33-md">
            <div>
                <div class="footer1__menu-title">
                    <a class="footer1__title-link" href = "<?php echo get_home_url() ?>/sofosbuvir-i-daklatasvir">Софосбувир и Даклатасвир</a>
                </div>

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-fc1',
                        'menu_id'        => 'fc1',
                        'menu_class' => 'footer-col-menu',
                    )
                );
                ?>
            </div>
        </div>
        <div class="d-flex flex-column align-center col33-md">
            <div>
                <div class="footer1__menu-title">
                    <a class="footer1__title-link" href = "<?php echo get_home_url() ?>/sofosbuvir-i-ledipasvir">Софосбувир и Ледипасвир</a>
                </div>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-fc2',
                        'menu_id'        => 'fc2',
                        'menu_class' => 'footer-col-menu',
                    )
                );
                ?>
            </div>
        </div>
        <div class="d-flex flex-column align-center col33-md">
            <div>
                <div class="footer1__menu-title">
                    <a class="footer1__title-link" href = "<?php echo get_home_url() ?>/sofosbuvir-i-velpatasvir">Софосбувир и Велпатасвир</a>
                </div>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-fc3',
                        'menu_id'        => 'fc3',
                        'menu_class' => 'footer-col-menu',
                    )
                );
                ?>
            </div>
        </div>

    </div>
    <div class="footer2 d-flex container justify-between">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'menu-2',
                'menu_id'        => 'footer-menu',
                'menu_class' => 'base-menu footer-menu',
            )
        );
        ?>
    </div>

    <div class="footer3 ma container d-flex fw">
        <div class="footer3__left flex-column d-flex col33-md">
            <div class="d-flex footer3__text-block">
                <i class="fa fa-map-marker footer3__icon"></i>
                <div class="ma ml5"><?php echo $r_opt['address'];?></div>
            </div>

            <div class="d-flex footer3__text-block">
                <i class="fa fa-clock-o footer3__icon"></i>
                <div class="ma ml5"><?php echo $r_opt['regime'];?></div>
            </div>
            <div class="d-flex footer3__text-block">
                <i class="fa fa-phone footer3__icon"></i>
                <a class="base-link ma ml5" href = "tel:<?php echo $r_opt['phone'] ?>" class="soc">

                    <?php echo $r_opt['phone'] ?>
                </a>
            </div>
            <div class="d-flex footer3__text-block">
                <i class="fa fa-envelope-o footer3__icon"></i>
                <a class="base-link ma ml5" href = "mailto:<?php echo $r_opt['mail'] ?>" class="soc">

                    <?php echo $r_opt['mail'] ?>
                </a>
            </div>
            <div class = "footer3__socials d-flex justify-left">
                <a href = "<?php echo $r_opt['soc-youtube'] ?>" class="footer3__soc-link">
                    <i class="fa fa-youtube footer3__icon"></i>
                </a>
                <a href = "<?php echo $r_opt['soc-vk'] ?>" class="footer3__soc-link">
                    <i class="fa fa-vk footer3__icon"></i>
                </a>
                <a href = "<?php echo $r_opt['soc-fb'] ?>" class="footer3__soc-link">
                    <i class="fa fa-facebook footer3__icon"></i>
                </a>
                <a href = "<?php echo $r_opt['soc-whatsapp'] ?>" class="footer3__soc-link">
                    <i class="fa fa-whatsapp footer3__icon"></i>
                </a>
                <a href = "<?php echo $r_opt['soc-tg'] ?>" class="footer3__soc-link">
                    <i class="fa fa-telegram footer3__icon"></i>
                </a>
            </div>

        </div>
        <div class="footer3__center flex-column d-flex justify-center align-center col33-md">
            <a class = "order-phone-btn footer-btn base-button" href="#"> Заказать звонок </a>
            <a class = "podbor-btn footer-btn base-button" href="<?php echo $r_opt['link-podbor'] ?>"> Подбор </a>
            <a class = "analysis-btn footer-btn base-button" href="<?php echo $r_opt['link-analizi'] ?>"> Анализы </a>
            <a  class = "base-link site-map-link" href="<?php echo $r_opt['link-karta'] ?>"> Карта Сайта</a>


        </div>
        <div class="footer3__right d-flex justify-end col33-md">
            <div class = "d-flex align-start flex-column" >
                <div class = "footer3__title" >Принимаем к оплате</div>
                <img src="<?php echo get_template_directory_uri() ?>/inc/images/payment-methods.png">
                <div class = "footer3__title">Реквизиты</div>
                <div class = "footer3__text-block"><?php echo $r_opt['requisites']; ?></div>
                <a class = "footer3__bold-link base-link" href = "<?php echo $r_opt['link-politika'] ?>">Политика<br> конфиденциальности</a>
                <a class = "footer3__bold-link base-link" href = "<?php echo $r_opt['link-soglasie'] ?>">Согласиен на обработку ПД</a>
            </div>
        </div>
    </div>

    <div class="footer4 ma container d-flex justify-center">
        Copyright ©2010-2020 | Медикафарм Москва
    </div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


</body>
</html>
