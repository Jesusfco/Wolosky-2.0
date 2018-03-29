$(document).ready(function(){
     
      
    var heightVenta = $(window).height();
    var y = $(window).width();
    
    if( y > 900  && y <= 1400) {
        var alturaCaption = $('.caption').height();
        var mitad = heightVenta/2;

        // mit
    //  alturaCaption = alturaCaption/2;
        alturaCaption = mitad;
        $('.caption').css("top", "66%");
        // $('.caption').css("bottom", 200);
    }
    else if( y > 1400 ) {
        $('.caption').css("top", "78%");
    }

    else if( y > 600 && y <= 900) {
        var alturaCaption = $('.caption').height();
        var mitad = heightVenta/2;
    //  alturaCaption = alturaCaption/2;
        alturaCaption = mitad;
        $('.caption').css("top", alturaCaption + 40);
    }
    
    
});
