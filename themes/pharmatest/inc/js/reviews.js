

jQuery( function( $ ) {
    /* if you add some code here, you will have to use "jQuery" as a selector */


    var container = [];

    // Loop over gallery items and push it to the array

    $('.review-photo').find('figure').each(function() {
        var image_width = $(this).find('a').data('width');
        var image_height = $(this).find('a').data('height');
        var $link = $(this).find('a'),
            item = {
                src: $link.attr('href'),
                w: image_width,
                h: image_height,
            };
        container.push(item);
    });

    $('.review-photo a').click(function(event) {

        // Prevent location change
        event.preventDefault();

        // Define object and gallery options
        var $pswp = $('.pswp')[0],
            options = {
                index: $(this).parent('figure').data('number'),
                bgOpacity: 0.85,
                showHideOpacity: true
            };

        // Initialize PhotoSwipe
        var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
        gallery.init();
    });

    $('.filter-select').change(function(){
        let val = $(this).children("option:selected").val();
        let key = $(this).data('name');
        let link = $(this).data('src');
        let re = new RegExp(key+'=[0-9]');
        console.log(re);
        link = link.replace(re,key+'='+val);
        console.log(key);
        console.log(val);
        console.log(link);
        window.location.href = link;
    });
});