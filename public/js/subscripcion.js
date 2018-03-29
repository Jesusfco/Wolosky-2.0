$(document).ready(function() {
    
    initCB();
    
    $('select').material_select();
    
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 120, // Creates a dropdown of 15 years to control year
    format: 'yyyy/mm/dd'
  });
    
});

function initCB() {
    
    for (var i = 6; i <= 100; i++) {
        
        $("#years").append($('<option>', {
            value: i,
            text: i
        }));
        
    }
    
    $("select#years option").filter(function() {
        return $(this).text() === "Seleccionar edad"; 
    }).prop('selected', true);
    
}

$(function(){
    
    $("#w-form").on("submit", function(e) {
        
        e.preventDefault();
        
        if (check()) {
            
            $.ajax({
                type: 'POST',
                url: "insert.php",
                async: true,
                data: {
                    action: "insert",
                    name:   $("#first_name").val() + " " + $("#last_name").val(),
                    email:  $("#email").val(),
                    gender: $("#gender").val(),
                    phone:  $("#cellphone").val(),
                    years:  $("#years").val(),
                    type:   $("#type").val(),
                    message: $("#messageTA").val()
                },
                success: function (result) {
                    
                    if (result === "true") {
                        
                        swal("Correcto!", "Datos enviados!", "success");
                        
                    } else {
                        
                        swal("Incorrecto!", "Datos no enviados!", "error");
                        
                    }
                    
                }
            });
            
        } else {
            
            sweetAlert("Oops...", "Por favor de completar los campos faltantes!", "error");
           
        }
        
    });
    
});

function check() {
    
    var inputs = [
        $("#gender"),
        $("#years"),
        $("#type")    
    ];
    
    for (var i = 0; i < inputs.length; i++) {
                
        if ($.trim(inputs[i].val()).length === 0){
            
            return false;
            
        }
        
    }
    
    return true;
    
}