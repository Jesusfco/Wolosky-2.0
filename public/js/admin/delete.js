function eliminar(id) {

    swal({
            title: 'Eliminación de Registro',
            text: "¿Estas seguro de eliminar este registro? #" + id,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#b60909",
            confirmButtonText: "Eliminar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true
        },
        function() {

            let actualUrl = window.location.href;
            actualUrl = actualUrl.split('?')[0]            

            $.ajax({
                type: "GET",
                url: actualUrl + "/delete/" + id,
                async: true,

                success: function(data) {
                    //                alert(data);
                    setTimeout(function() {
                        swal({
                            title: "Registro Eliminado",
                            text: "El Registro ha sido eliminado",
                            timer: 1500,
                            type: 'success',
                            showConfirmButton: false,
                            allowEscapeKey: true,
                            allowOutsideClick: true
                        });
                    });
                    $('#id' + id).remove();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                        //                                alert(xhr.status);
                        //                                alert(thrownError);
                        setTimeout(function() {
                            swal({
                                title: "Error: " + thrownError,
                                text: "No se ha podido eliminar el registro",
                                timer: 3000,
                                type: 'error',
                                showConfirmButton: false,
                                allowEscapeKey: true,
                                allowOutsideClick: true
                            });
                        });
                    } //Error
            }); //AJAX
        }); //swal
}