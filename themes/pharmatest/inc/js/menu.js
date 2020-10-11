jQuery( function( $ ) {


    $('.header__cart').hover(function () {
        let cont =$('.mini-cart-container');
        if (! cont.find('.woocommerce-mini-cart__empty-message').length) {


            let ww = $(window).width() - cont.width();
            $('.woocommerce-mini-cart__total strong').text('Итого:');
            cont.css('top', $(this).offset().top + 20);
            cont.css('left', Math.min($(this).offset().left - 150, ww));
            cont.addClass('open');
            $('.widget_shopping_cart').slideDown(200);

        }
    }, function () {
        $('.header__cart').data('timer', setTimeout(function () {
            $('.widget_shopping_cart').slideUp(200, function() {
                $('.mini-cart-container').removeClass('open');
            });
        }, 200));
    });


      $('.city-select-link ').click(function(){
          $('.city-select').fadeIn(200);
          $('.popup-back').fadeIn(200);
      }) ;

    $(".city-select__input").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $('.menu-city li').hide();
        $('.menu-city li').filter(function() {
            return ($(this).text().toLowerCase().indexOf(value) > -1);
        }).show();

    });


    $(".menu-city li a").click(function(e)
    {
        let d = new Date();
        d.setTime(d.getTime() + (30*24*60*60*1000));
        document.cookie = "mfarm_city="+$(this).text()+"; expires="+d.toUTCString()+"; path=/";
    });

    $('.header3__mobile-left i ').click(function(){
        $('.mobile-menu-wrapper').addClass('open');
        $('.mobile-popup-back').fadeIn(200);
    }) ;

      $('.menu-close, .mobile-popup-back').click(function(){
          $('.mobile-menu-wrapper').removeClass('open');
          $('.mobile-popup-back').fadeOut(200);
      });

      $('.mobile-menu .menu-item-has-children>a').click(function(e){
          e.preventDefault();
            $(this).parent().find('.sub-menu').toggle();
            $(this).toggleClass('open');
      })

    function show_popup(popup){
        popup.css('height','auto');
        let margin = 'calc(max(0px,(50vh - '+popup.innerHeight()/2+'px)))';
        let height = 'calc(min(100vh,'+popup.innerHeight()+'px))';
        popup.css('height',height);
        popup.css('margin-top',margin);
        $('.popup-back').fadeIn(500);
        popup.fadeIn(500);
    }

    $('.product-info-button.guarantee').click(function(e){
        e.preventDefault();
        $('.popup-back').fadeIn(500);
        let popup_window =$('.product-guarantee ');
        show_popup(popup_window);

    });
    $('.product-info-button.payment').click(function(e){
        e.preventDefault();
        $('.popup-back').fadeIn(500);
        let popup_window =$('.product-payment ');
        show_popup(popup_window);
    });
    $('.product-info-button.shipping').click(function(e){
        e.preventDefault();
        $('.popup-back').fadeIn(500);
        let popup_window =$('.product-shipping ');
        show_popup(popup_window);
    });

      $('.header2__free-button, .header3 .free-button ,.order-phone-btn').click(function(e){
         e.preventDefault();
          $('.popup-back').fadeIn(500);
          let popup_window =$('.form-consultation-popup ');
          show_popup(popup_window);
      });

    $('.index1__button1').click(function(e){
        e.preventDefault();
        $('.popup-back').fadeIn(500);
        let popup_window =$('.form-discount-popup ');
        show_popup(popup_window);
    });

    $('.one-click-button').click(function(e){
        e.preventDefault();
        let block;

        let page =$(this).next().find('.hidden-attrs__page').text();
        let name = $(this).next().find('.hidden-attrs__name').text();
        let id; let quantity; let src; let price;

        let variation = $(this).next().find('.hidden-attrs__variation').text();

        if (page =='archive')
        {
            quantity = 1;
            src = $(this).parents('li.product').find('img').attr('src');
            block = $(this).parents('li.product').find('.product-variations-container .selected');
        }

        else
        {
            quantity = $(this).parents('.product-buy-container').find('.quantity .qty').val();
            src = $('.flex-control-thumbs').first().find('img').attr('src');

            block = $(this).parents('.product-attributes-container').find('.product-variations-container .selected');
        }

        if (!variation) {
            id = $(this).next().find('.hidden-attrs__id').text();
            price = $(this).next().find('.hidden-attrs__price').text()
        }
        else{
            id = block.attr('data-id');
            price = block.attr('data-price')
            variation = ' - '+block.text();
        }
        price = parseInt(price)*parseInt(quantity);

        let details = $('.fast-order__details');

        details.find('.fast-order__name .name').text(name);
        details.find('.fast-order__name .var').text(variation);
        details.find('.fast-order__quantity span').text(quantity);
        details.find('.fast-order__img img').attr('src',src);
        details.find('.fast-order__price span').text(price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")+' руб.');

        $('.fast-order .wpcf7 #cf__id').val(id);
        $('.fast-order .wpcf7 #cf__quantity').val(quantity);
        $('.fast-order .wpcf7 #cf__type').val('product');



        $('.popup-back').fadeIn(500);
        $('.fast-order').fadeIn(500);
    })

    $('.popup-window__close').click(function(){
        $(this).parent().hide();
        $('.popup-back').hide();
    });

    $('.cf-form-fake').click(function(e){
        e.preventDefault();
        $(this).addClass('loading');
        let cfparent = $(this).parents('.cf-form-parent');
        let btn = cfparent.find('.wpcf7 .cf-form-submit');
        btn.click();
        cfparent[0].addEventListener( 'wpcf7submit', function() {
            $(this).removeClass('loading');
        }.bind(this));
        cfparent[0].addEventListener( 'wpcf7mailsent', function() {

            if ($(this).hasClass('qa-btn')) {
                $('.phone-success .popup-window__content p:last-child').text('Мы скоро ответим!')
            }
            else if ($(this).hasClass('review-btn')) {
                $('.phone-success .popup-window__content p:first-child').text('Спасибо за ваш отзыв!')
                $('.phone-success .popup-window__content p:last-child').text('')
            }
            else
            {
                $('.phone-success .popup-window__content p:last-child').text('Мы скоро перезвоним!');
            }

            $('.popup-back').children().hide();
            $('.popup-back').fadeIn(500);
            show_popup($('.phone-success'));


        }.bind(this));
    })


    $('.checkout-button').click(function(e){
        e.preventDefault();
        $(this).attr('href','');
        if ($(this).hasClass('wc-forward'))
        {
            $('.wpcf7 #cf__type').val('cart');
        }
        $(this).addClass('loading');
        $('#cf__submit').click();
    });

    let formparent = document.querySelector( '.order-form-parent' );
    if (formparent)
    {
    formparent.addEventListener( 'wpcf7invalid', function( event ) {
        $('.checkout-button').removeClass('loading');
    }, false );

    formparent.addEventListener( 'wpcf7mailsent', function( event ) {
        var data = {
            action: 'post_order',
            nonce_code : myajax.nonce,
            name: $('#cf__name').val(),
            phone: $('#cf__tel').val(),
            address: $('#cf__address').val(),
            comment:$('#cf__comment').val(),
            type:$('#cf__type').val(),
            id:$('#cf__id').val(),
            quantity:$('#cf__quantity').val()

        };

        // 'ajaxurl' не определена во фронте, поэтому мы добавили её аналог с помощью wp_localize_script()
        jQuery.post( myajax.url, data, function(response) {
            $('.checkout-button').removeClass('loading');
            let type = $('.wpcf7 #cf__type').val();
            if (type == 'cart') {
                $('.woocommerce').fadeOut(500,
                    function () {
                        $('.order-msg__number').text(response);
                        $('.order-msg').fadeIn(1000).css("display", "inline-block");
                    });
            }
            if (type == 'product') {
                $('.order-msg__number').text(response);
                $('.fast-order').fadeOut(500);
                show_popup($('.order-success'));
            }
        });
    }, false );
    }

    function on_resize(c,t){onresize=function(){clearTimeout(t);t=setTimeout(c,100)};return c};
    let more_menu = '<li class = "menu-item menu-item-has-children" id = "#more"><a href = "#">Еще...</a><ul class ="sub-menu" id = "overflow"></ul></li>';
    $('.main-menu').append(more_menu);
    $('#more').hide();

    function resize_menu(){
        if ($(window).width()>1024)
        {
            let navSpace = $('#main-menu').outerWidth();

            let linksWidth = 0;
            $('#main-menu > .menu-item').each(function() {
                if ((!$(this).parent().hasClass('sub-menu'))&&($(this).attr('id')!='more'))
                    linksWidth += $(this).outerWidth();
            });
            console.log('start');
            console.log(linksWidth);
            console.log(navSpace);
            if( linksWidth > (navSpace-50) ) {

                while( linksWidth > (navSpace-50) ) {
                    let lastLink = $('#main-menu > .menu-item').eq(-2);
                    let lastLinkWidth = lastLink.outerWidth();
                    console.log('>')
                    console.log(lastLinkWidth);
                    $(lastLink).data( 'foo', lastLinkWidth );
                    $('#overflow').prepend(lastLink);
                    linksWidth = linksWidth - lastLinkWidth;
                }

                $('#more').show();
                $('#more-label').text( $('#overflow > .menu-item').length + ' More...' );

            } else {

                while (linksWidth <= (navSpace-50)) {

                    let firstOverflowLink = $('#overflow > .menu-item').first();
                    let firstOverflowLinkWidth = firstOverflowLink.data('foo');

                    if ((navSpace-50) - linksWidth > firstOverflowLinkWidth) {
                        // console.log('asdf');
                        $('#main-menu > .menu-item').eq(-2).after(firstOverflowLink);
                    }
                    linksWidth = linksWidth + firstOverflowLinkWidth;
                }
                //$('#more a').text($('#overflow > .menu-item').length + ' More...');
                if ($('#overflow > .menu-item').length == 0) {
                    $('#more').hide();
                }
            }
        }
        $('#overflow').height('auto');
    }
    resize_menu();
    on_resize( resize_menu);





    $('.contents a[href *= "#"], .scrollto').on('click.smoothscroll', function( e ){

        let hash    = this.hash
        let _hash   = hash.replace( /#/, '' )
        let theHref = $(this).attr('href').replace( /#.*/, '' )

        if( theHref && location.href.replace( /#.*/, '' ) !== theHref )
            return

        let $target = (_hash === '') ? $('body:first') : $( hash + ', a[name="'+ _hash +'"]').first()

        if( ! $target.length )
            return

        e.preventDefault()

        $('html:first, body:first').stop()
            .animate({ scrollTop: $target.offset().top - 100 }, 400, 'swing', function(){
                window.history.replaceState( null, document.title, hash )
            })
    })







    $('.main-menu li, #more').hover(function() {

        if ($(this).hasClass('hovered')) {
            $(this).children('.sub-menu').stop().slideToggle(250);
            //$(this).removeClass('hovered');
        } else {
            $(this).children('.sub-menu').stop().slideToggle(250);
            $(this).addClass('hovered');
        }
    });
});
