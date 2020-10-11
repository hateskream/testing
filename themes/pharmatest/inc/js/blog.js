jQuery( function( $ ) {

    let $title  = $('.kc__title')
    let showtxt = '[показать]'
    let hidetxt = '[скрыть]'
    let $but    = $('<span class="kc-show-hide" style="cursor:pointer;margin-left:.5em;font-size:80%;">'+ hidetxt +'</span>')

    $but.on( 'click', function(){

        let $the = $(this)
        let $cont = $the.parent().next('.contents')

        if( $the.text() === hidetxt ){
            $the.text( showtxt )
            $cont.slideUp()
        }
        else{
            $the.text( hidetxt )
            $cont.slideDown()
        }
    })
    $title.append( $but )


    $('.like__btn').on('click', function(e){
        e.preventDefault();
        if ($(this).attr('disabled')) return;
        $(this).addClass('clicked');
        // AJAX call goes to our endpoint url
        $.ajax({
            url: bloginfo.site_url + '/wp-json/medikafarm/v2/likes/' + bloginfo.post_id.ID,
            type: 'post',
            success: function() {
                console.log('asdf');
            },
            error: function() {
                console.log('wtf');
            }

        });

        // Change the like number in the HTML to add 1
        var updated_likes = parseInt($('.like__number').html()) + 1;

        $('.like__number').html(updated_likes);
        // Make the button disabled
        $(this).attr('disabled', true);
        $('.dislike__btn').attr('disabled', true);
    });

    $('.dislike__btn').on('click', function(e){
        e.preventDefault();
        if ($(this).attr('disabled')) return;
        $(this).addClass('clicked');
        // AJAX call goes to our endpoint url
        $.ajax({
            url: bloginfo.site_url + '/wp-json/medikafarm/v2/dislikes/' + bloginfo.post_id.ID,
            type: 'post',
            success: function() {
                console.log('asdf');
            },
            error: function() {
                console.log('wtf');
            }

        });

        // Change the like number in the HTML to add 1
        var updated_likes = parseInt($('.dislike__number').html()) + 1;

        $('.dislike__number').html(updated_likes);
        // Make the button disabled
        $(this).attr('disabled', true);
        $('.like__btn').attr('disabled', true);
    });
});