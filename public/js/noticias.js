$(document).ready(function(){
    
re();
   setInterval(re,1500);
   $(window).resize(function() {
        re();
   });
   
});


    function re() { 
        var heightTitulo = $('.notaPrincipal-titulo').height();
        var not1 = $('#not1').height();
//        var heightImg = $('.notaPrincipal-img').top();  
        var widthImg = $('.notaPrincipal-img').width();        
        $('.notaPrincipal-img').height(not1);
        $('.notaPrincipal-titulo').width(widthImg);
        $('.notaPrincipal-titulo').css('margin-top' , -heightTitulo);
        
        
       
    }
    
   