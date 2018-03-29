//Primera redimension pantalla completa contenedor Parallax-Container

$(document).ready(function(){
    var ventanaAltura = $(window).height();
    var ventanaAnchura = $(window).width();
    
    marginContenedorPrincipal();
    
    $('.materialboxed').materialbox();
    $('.collapsible').collapsible();
    
    
    

    //Cuando la pantalle se redimensiona
    $(window).resize(function() {        
         marginContenedorPrincipal();
    }); 
  
});


function marginContenedorPrincipal() {     
    var fondoQuienesHeigh = $('#fondoquienes').height();    
    $('#contenedorPrincipal').css('margin-top', fondoQuienesHeigh);
}
