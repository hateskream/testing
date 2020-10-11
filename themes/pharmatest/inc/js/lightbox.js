

jQuery( function( $ ) {
    /* if you add some code here, you will have to use "jQuery" as a selector */


    var container = [];

    // Loop over gallery items and push it to the array
    $('#gallery').find('figure').each(function() {
        var $link = $(this).find('a'),
            item = {
                src: $link.attr('href'),
                w: 828,
                h: 1200,
            };
        container.push(item);
    });


    // Define click event on gallery item
    $('#gallery a').click(function(event) {

        // Prevent location change
        event.preventDefault();

        // Define object and gallery options
        var $pswp = $('.pswp')[0],
            options = {
                index: $(this).parent('figure').index(),
                bgOpacity: 0.85,
                showHideOpacity: true
            };

        // Initialize PhotoSwipe
        var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
        gallery.init();
    });
});