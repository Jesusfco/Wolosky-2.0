

//Primera redimension pantalla completa contenedor Parallax-Container
//   $("#padreParallax").css("height", $(window).height());
  
  

$(document).ready(function(){
    
  $('.parallax').parallax();

  var texto1='Una academia de gimnasia con mas de 19 años de experiencia';
  var texto2='No solo enseñamos gimnasia, enseñamos un estilo de vida';
  var texto3='La constancia y la perseveracia son la clave del éxito';
  
  var x = 0;
  var alturaHijo = $('#hijoParallax').height();
  var alturaPadre = $('#padreParallax').height();
  var redimension;
  var paralAl = alturaPadre/2;
  


  $("#paral").css("height", paralAl);


    function cambiarTexto() {
      var texto = $('#fade').text();

      if (texto == texto1) {
        $('#fade').fadeOut( "slow", function() {
            $('#fade').text(texto2);
        });
        $('#fade').fadeIn( "slow", function() {
        });
      }

      else if (texto == texto2) {
        $('#fade').fadeOut( "slow", function() {
            $('#fade').text(texto3);
        });
        $('#fade').fadeIn( "slow", function() {});
      }

      else if (texto == texto3) {
        $('#fade').fadeOut( "slow", function() {
            $('#fade').text(texto1);
        });
        $('#fade').fadeIn( "slow", function() {});
      }      
  }

  setInterval(cambiarTexto,4000);
  
//  Que es gimnasia
   var wid = $(window).width();
  
    if(wid < 920) { 
        $('.queEs').removeClass("container");
       
    }


   //Centrado Horizonatal del DivHijo 
  redimension = (alturaPadre-alturaHijo)/2;
  redimension = redimension + 'px';
  $('#hijoParallax').css('margin-top', redimension );


////Cuando la pantalle se redimensiona
//  $(window).resize(function() {
//
//    //Parrallax container adapta su Heigt segun la pantalla
//    $(".parallax-container").css("height", $(window).height());
//
//    //Obtenemos altura de los Div
//    alturaPadre = $('#padreParallax').height();
//    alturaHijo = $('#hijoParallax').height();    
//
//    redimension = (alturaPadre-alturaHijo)/2;
//    redimension = redimension - 50;
//    
//    $('#hijoParallax').css('top', redimension );
//    
//
//  }); //Fin de Window Resize function
});
