//Primera redimension pantalla completa contenedor Parallax-Container
//   $("#padreParallax").css("height", $(window).height());



$(document).ready(function() {

    $('.parallax').parallax();

    var texto1 = 'Una academia de gimnasia con mas de 19 años de experiencia';
    var texto2 = 'No solo enseñamos gimnasia, enseñamos un estilo de vida';
    var texto3 = 'La constancia y la perseveracia son la clave del éxito';

    var x = 0;
    var alturaHijo = $('#hijoParallax').height();
    var alturaPadre = $('#padreParallax').height();
    var redimension;
    var paralAl = alturaPadre / 2;



    $("#paral").css("height", paralAl);


    function cambiarTexto() {
        var texto = $('#fade').text();

        if (texto == texto1) {
            $('#fade').fadeOut("slow", function() {
                $('#fade').text(texto2);
            });
            $('#fade').fadeIn("slow", function() {});
        } else if (texto == texto2) {
            $('#fade').fadeOut("slow", function() {
                $('#fade').text(texto3);
            });
            $('#fade').fadeIn("slow", function() {});
        } else if (texto == texto3) {
            $('#fade').fadeOut("slow", function() {
                $('#fade').text(texto1);
            });
            $('#fade').fadeIn("slow", function() {});
        }
    }

    setInterval(cambiarTexto, 4000);

    //  Que es gimnasia
    var wid = $(window).width();

    if (wid < 920) {
        $('.queEs').removeClass("container");

    }


    //Centrado Horizonatal del DivHijo 
    redimension = (alturaPadre - alturaHijo) / 2;
    redimension = redimension + 'px';
    $('#hijoParallax').css('margin-top', redimension);


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





    //-------------------- WAYPOINT FIRED------------------------------------------------------------
    // $('.programDiv:nth-child(1)').waypoint(function(direction) {
    //   if (direction == 'down') {
    //       $('.programDiv:nth-child(1)').removeClass('hidden');      
    //   } else {
    //       $('.programDiv:nth-child(1)').addClass('hidden');
    //   }
    // }, { offset: '90%' });

    $('#last_not_title').waypoint(function(direction) {
        waypointGeneric('#last_not_title', direction, 'fadeInUp');

    }, { offset: '100%' });

    $('.blogContent').waypoint(function(direction) {
        waypointGeneric('.blogContent', direction, 'slideInLeft');
    }, { offset: '100%' });

    $('#queEsLaGimnasia').waypoint(function(direction) {
        waypointGeneric('#queEsLaGimnasia', direction, 'fadeInUp');
    }, { offset: '100%' });

    $('#ubicationTitle').waypoint(function(direction) {
        waypointGeneric('#ubicationTitle', direction, 'slideInLeft');
    }, { offset: '100%' });

    $('#ubicationDescription').waypoint(function(direction) {

        waypointGeneric('#ubicationDescription', direction, 'fadeIn');

    }, { offset: '100%' });

    $('#schedule').waypoint(function(direction) {
        waypointGeneric('#schedule', direction, 'fadeInUp');
    }, { offset: '100%' });

});

function waypointGeneric(element, direction, string) {
    if (direction == 'down') {
        $(element).addClass('animated');
        $(element).addClass(string);
    } else {
        $(element).removeClass('animated');
        $(element).removeClass(string);
    }
}