jQuery( function( $ ) {
    $('.slider1').slick({
        arrows:true,
        dots:false,
        adaptiveHeight: false,
        slidesToShow: 5,
        speed:500,
        swipeToSlide: true,
        easing:'linear',
        prevArrow:"<i class='slick-prev fa fa-angle-left'> </i>",
        nextArrow:"<i class='slick-next fa fa-angle-right'> </i>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 520,
                settings:{
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.slider2').slick({
        arrows:true,
        dots:false,
        adaptiveHeight: false,
        slidesToShow: 2,
        speed:500,
        swipeToSlide: true,
        easing:'linear',
        prevArrow:"<i class='slick-prev fa fa-angle-left'> </i>",
        nextArrow:"<i class='slick-next fa fa-angle-right'> </i>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 575,
                settings:{
                    slidesToShow: 1
                }
            }
        ]
    });

    let id = 1;

    $( ".faq__title").mousedown( function(e) {
        e.preventDefault();
        $(this).parents('.faq').find('.selected').removeClass('selected');
        $(this).addClass('selected');
    });


    $('.accordeon .acc-head').on('click', function(e){
        e.preventDefault();
        $('.accordeon' + id.toString() + ' .acc-body').not($(this).next()).slideUp(500);
        $(this).next().slideToggle(500);
        $(this).find('.fa').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
        $('.accordeon' + id.toString() + ' .acc-head').not($(this)).find('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
    });

    $('.faq__title').on('click', function(e){
        id = $(this).attr('data-id');
        $('.accordeon').hide();
        $('.accordeon'+id.toString()).show();
        e.preventDefault();
    });

    $( ".category-tabs__tab").mousedown( function(e) {

        let container = $(this).parents('.category-tabs')
        container.find('.selected').removeClass('selected');
        $(this).addClass('selected');
        container = container.parents('.index-products').find('.woocommerce');
        container.find('.active').removeClass('active');
        container = container.find('.'+$(this).attr('data-slug')+'-wrapper');
        container.addClass('active');

    });
});




