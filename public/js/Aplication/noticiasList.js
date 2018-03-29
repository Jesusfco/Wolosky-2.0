function eliminar(n, name) {

    swal({
            title: name,
            text: "¿Estas seguro de eliminar esta noticia?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#b60909",
            confirmButtonText: "Eliminar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true
        },
        function () {

            $.ajax({
                type: "GET",
                url: "destroy",
                async: true,
                data: {
                    id: n
                },
                success: function (data) {
//                alert(data);
                    setTimeout(function () {
                        swal({
                            title: "Noticia Eliminada",
                            text: "La noticia ha sido eliminada",
                            timer: 1500,
                            type: 'success',
                            showConfirmButton: false,
                            allowEscapeKey: true,
                            allowOutsideClick: true
                        });
                    });
                    $('#noticia' + n).remove();
                },
                error: function (xhr, ajaxOptions, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
                    setTimeout(function () {
                        swal({
                            title: "Error: " + thrownError,
                            text: "No se ha podido eliminar el Cliente",
                            timer: 3000,
                            type: 'error',
                            showConfirmButton: false,
                            allowEscapeKey: true,
                            allowOutsideClick: true
                        });
                    });
                }//Error
            });//AJAX
        });//swal
}
