
$(document).ready(function(){
   // alinear();
   
   
    $("#menuBoton").click(function () {
        if(menu == 0) { 
        $('#panel').animate({left: 0},250);
        menu++;       
     } else  {
         $('#panel').animate({left: -330},250);
         menu = 0;
     }
    });
    
    

    
});
var menu = 0;
