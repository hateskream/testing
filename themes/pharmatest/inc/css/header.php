<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pharmatest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

<?php
   wp_head();
     ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open();

?>

<div id="page" class="site">

	<header id="masthead" class="site-header">
        <div class="header1 container d-flex justify-between">
            <div class="header1__left-block col33 d-flex">
                <div class="header1__select-div">

                    <?php
                   $cookie_name = 'mfarm_city';
                   $linktext = '';
                   if  (is_page_template( 'fp-template.php' )&&(!is_front_page()))
                   {
                       $linktext = get_the_title();
                   }
                   else
                        $linktext = isset($_COOKIE[$cookie_name])?$_COOKIE[$cookie_name]:'Выберите город';
                   echo '<a class = "city-select-link base-link" href = "#">'.$linktext.'</a>';
                   ?>

                </div>
                <div class="header1__address-div ma">
                    Ул. Звездный бульвар, 2а, оф 535.
                </div>
            </div>
            <div class="header1__center-block d-flex justify-center col33">
                <a class="base-link ma" href="mailto:info@софосбувир-россия.рф">info@софосбувир-россия.рф</a>
            </div>
            <div class="header1__right-block col33 justify-end d-flex ma">
                Режим работы: Пн.-Сб. с 8.00 до 21.00 (Мск)
            </div>
        </div>

        <div class="header2 container d-flex">
            <div class="header2__left-block col33 d-flex">
                <div class="header2__logo d-flex align-center p5">
                    <a href = "<?php echo get_home_url() ?>">
                    <img class = "header2__img" src="<?php echo get_template_directory_uri() ?>/inc/images/logo.png">
                    </a>
                </div>
                <div class="header2__buttons p5 flex-column d-flex justify-center align-center">

                    <a class="podbor-btn base-button" href="#"> Подбор </a>
                    <a class="analysis-btn base-button" href="#"> Анализы</a>

                </div>
            </div>
            <div class="header2__center-block col33 align-center justify-center d-flex">
                <div class="header2__content p5 flex-column d-flex justify-between align-center">
                    <div class="header2__phone-text">
                        Горячая линия по РФ бесплатно:
                    </div>
                    <a class="header2__phone-link" href="tel:+78005057089">8-800-505-70-89</a>
                    <a class="base-button header2__free-button" href='#'>Бесплатная Консультация!</a>
                </div>
            </div>
            <div class="header2__right-block col25 d-flex justify-between">
                <div class="header2__socials justify-between d-flex ">
                    <a href = "https://wa.me/79138027235" target="_blank" class="header2__soc header2_socials ma">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                    <a href = "https://vk.com/v_kakoy_apteke_kupit_sofosbuvir" class="header2__soc header2_socials ma">
                        <i class="fa fa-vk"></i>
                    </a>
                </div>
                <div class="header2__cart p5  d-flex">
                    <a href = "<?php echo get_home_url()  ?>/cart"  class="header2__soc header__cart ma">
                        <i class="fa fa-shopping-cart">
                        <?php cart_link();?>
                        </i>
                        <div class = "mini-cart-container">

                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="header3 container">
            <div class = "mobile-popup-back"></div>
            <div class = "main-menu-wrapper">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'main-menu',
                    'menu_class' => 'base-menu main-menu',
                )
            );
            ?>
            </div>
            <div class="header3__mobile">
                <div class = "mobile-menu-wrapper flex-column">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'mobile-menu',
                        'menu_class' => 'mobile-menu',
                    )
                );

                ?>
                    <span class = "menu-close"></span>
                    <div class="d-flex justify-center header3__soc-container d-flex">
                        <a href = "https://wa.me/79138027235" target="_blank" class="header3__soc-icon">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                        <a href = "https://vk.com/v_kakoy_apteke_kupit_sofosbuvir" class="header3__soc-icon">
                            <i class="fa fa-vk"></i>
                        </a>
                        <a href = "https://vk.com/v_kakoy_apteke_kupit_sofosbuvir" class="header3__soc-icon">
                            <i class="fa fa-telegram"></i>
                        </a>
                </div>
                </div>
                <div class="header3__mobile-left col20">
                    <i class="fa fa-bars"></i>

                </div>

                <div class="header3__mobile-right col50 d-flex justify-end">
                    <a class="base-button free-button" href='#'>Бесплатная Консультация!</a>
                    <a class="header3__button1 base-button" href="#"> Подбор </a>
                    <a class="header3__button2 base-button" href="#"> Анализы</a>

                </div>

                <a href = "<?php echo get_home_url()  ?>/cart"  class="header3__soc header__cart ma">
                    <i class="fa fa-shopping-cart">
                        <?php cart_link();?>
                    </i>
                    <div class = "mini-cart-container">

                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                    </div>
                </a>
            </div>
        </div>



	</header><!-- #masthead -->

    <?php if (!is_cart()){?>

    <div class = "woocommerce">
    <div class = "popup-back">

        <div class = "popup-window fast-order">
            <span class = "popup-window__close">
            </span>
            <div class = "popup-window__title">
                Заказать в 1 клик
            </div>
            <div class = "popup-window__content d-flex justify-between">
                <div class = "order-form-parent">
                <?php

                echo do_shortcode('[contact-form-7 id="82" title="Контактная форма 1" html_class="form-order"]');
                ?>
                </div>


                <div class = "fast-order__right-block d-flex flex-column  align-center">
                    <div class = "fast-order__details d-flex flex-column justify-between align-center ">
                        <div>
                            <div class ="fast-order__name" >
                                <span class = "name"></span><span class = "var"></span>
                            </div>
                            <div class ="fast-order__quantity" >
                                Количество: <span></span> шт
                            </div>
                        </div>
                        <div class ="fast-order__img" >
                            <img>
                        </div>
                        <div class ="fast-order__price" >
                            Цена: <span></span>
                        </div>
                    </div>
                    <a class = "checkout-button button" href = "#"> Оформить заказ</a>
                </div>
            </div>
        </div>

        <div class = "city-select popup-window  ">
            <span class = "popup-window__close"></span>
                <div class="popup-window__title">
                    Выберите регион
                </div>
                <input class="city-select__input "type="text" placeholder="Поиск..">
                <div class="city-select__overflowdiv">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-city',
                            'menu_id'        => 'menu-city',
                            'menu_class' => 'menu-city',
                        )
                    );

                    ?>
                </div>
        </div>


        <div class = "form-consultation-popup form-popup popup-window">
            <span class = "popup-window__close"></span>
            <div class ="cf-form-parent d-flex justify-center">
                <?php
                echo do_shortcode('[consultation_tag title="Бесплатная консультация специалиста!" description="Оставьте ваш номер телефона, мы свяжемся с вами через несколько минут."]');
                ?>
            </div>
        </div>

        <div class = "form-discount-popup form-popup popup-window">
            <span class = "popup-window__close"></span>
            <div class ="cf-form-parent d-flex justify-center">
                <?php
                echo do_shortcode('[contact-form-7 id="183" title="Форма скидки"]');
                ?>
            </div>
        </div>

        <div class = "popup-window order-success">
            <span class = "popup-window__close"></span>

            <div class = "popup-window__content">
                <div class = "order-msg__title">Ваш заказ успешно оформлен <i class="fa fa-check"></i></div>
                <div class = "order-msg__order">Номер вашего заказа: <span class = "order-msg__number"></span></div>
                <div class = "order-msg__manager">Наш менеджер свяжется с Вами в ближайшее время</div>
                <div class = "order-msg__thanks">Благодарим, что выбрали нас!</div>
            </div>
        </div>

        <div class = "popup-window phone-success">
            <span class = "popup-window__close"></span>
            <div class = "popup-window__content">
                <p>Спасибо за ваше обращение!</p>
                <p>Мы скоро перезвоним!</p>
            </div>
        </div>

        <div class = "product-payment popup-window standard-popup ">
            <span class = "popup-window__close"></span>
            <div class = "popup-window__title">
                Способы оплаты
            </div>
            <div class = "popup-window__content">
                Способы оплаты<br>
                Оплата при получении заказа<br>
                При этом Вы получаете препараты в почтовом отделении или по указанному Вами адресу при доставке нашими курьерами.<br>
                <br>
                При получении на почте России, после ознакомления с Вашим заказом, Вам необходимо оплатить наложенный платеж, оплата производится оператору в виде денежного перевода, мы предоставляем все заполненные документы, Вам нужно оплатить полную сумму указанную в квитанции и почтовый сбор от 1% до 4%.<br>
                <br>
                Оплата производится только наличными.<br>
                100% предоплата за заказ с получением в почтовом отделении<br>
                При получении у наших курьеров, оплата производится после ознакомления с препаратами и документами, после оплаты в присутствии курьера Вы можете вскрыть все защитные пленки и голограммы, чтобы ознакомиться с содержимым упаковки.<br>
                <br>
                Оплата производится наличными в рублях. Для оплаты по безналичному расчету предупредите нас заранее.<br>
            </div>
            <a class = "popup-window__more button" href = "#">Подробнее</a>
        </div>

        <div class = "product-guarantee popup-window standard-popup ">
            <span class = "popup-window__close"></span>
            <div class = "popup-window__title">
                Гарантии
            </div>
            <div class = "popup-window__content">
                Способы оплаты<br>
                Оплата при получении заказа<br>
                При этом Вы получаете препараты в почтовом отделении или по указанному Вами адресу при доставке нашими курьерами.<br>
                <br>
                При получении на почте России, после ознакомления с Вашим заказом, Вам необходимо оплатить наложенный платеж, оплата производится оператору в виде денежного перевода, мы предоставляем все заполненные документы, Вам нужно оплатить полную сумму указанную в квитанции и почтовый сбор от 1% до 4%.<br>
                <br>
                Оплата производится только наличными.<br>
                100% предоплата за заказ с получением в почтовом отделении<br>
                При получении у наших курьеров, оплата производится после ознакомления с препаратами и документами, после оплаты в присутствии курьера Вы можете вскрыть все защитные пленки и голограммы, чтобы ознакомиться с содержимым упаковки.<br>
                <br>
                Оплата производится наличными в рублях. Для оплаты по безналичному расчету предупредите нас заранее.<br>
            </div>
            <a class = "popup-window__more button" href = "#">Подробнее</a>
        </div>

        <div class = "product-shipping popup-window standard-popup ">
            <span class = "popup-window__close"></span>
            <div class = "popup-window__title">
                Доставка
            </div>
            <div class = "popup-window__content">
                Способы оплаты<br>
                Оплата при получении заказа<br>
                При этом Вы получаете препараты в почтовом отделении или по указанному Вами адресу при доставке нашими курьерами.<br>
                <br>
                При получении на почте России, после ознакомления с Вашим заказом, Вам необходимо оплатить наложенный платеж, оплата производится оператору в виде денежного перевода, мы предоставляем все заполненные документы, Вам нужно оплатить полную сумму указанную в квитанции и почтовый сбор от 1% до 4%.<br>
                <br>
                Оплата производится только наличными.<br>
                100% предоплата за заказ с получением в почтовом отделении<br>
                При получении у наших курьеров, оплата производится после ознакомления с препаратами и документами, после оплаты в присутствии курьера Вы можете вскрыть все защитные пленки и голограммы, чтобы ознакомиться с содержимым упаковки.<br>
                <br>
                Оплата производится наличными в рублях. Для оплаты по безналичному расчету предупредите нас заранее.<br>
            </div>
            <a class = "popup-window__more button" href = "#">Подробнее</a>
        </div>
    </div>
    </div>
<?php }?>
