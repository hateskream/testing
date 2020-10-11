jQuery( function( $ ) {

   $('.side-menu__header').click(function(){
       $(this).toggleClass('active');
       let list =$(this).next();
       if (list.is(':visible'))
       {
           list.slideUp(500);
       }
       else list.slideDown(500);
   });

});
