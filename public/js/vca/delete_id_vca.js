//Escuchamos el evento click del boton reset
$(document).on("click", "#delete_id_vca", function () {
    Swal.fire({
        title: "Eliminando...",
        text: "Por favor, espere.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    var id = $(this).data("id"); //extraemos el id
    var clave = $(this).data("clave"); //extraemos la clave

        var url ="/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/index.php/delete_id_vca"; //nos dirijmos a esta url donde se elimina

        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id,
                clave: clave,
            },
            success: function (response) {
                Swal.close();
                var tabla = $("#resultados_vca tbody"); //mostramos la tabla vca con el registro ya eliminado
                tabla.html(response.tabla);
            },
            error: function (xhr, status, error) {
                // console.log(error);
                Swal.fire({
                    title: "Error",
                    text: "Error de comunicacion comuniquese con soporte",
                    icon: "error",
                    showConfirmButton: true,
                });
            },
        });
});

// $(document).ready(function() {
//     $('#cargarTablaBtn').click(function() {
//         var parametro = $(this).data('id');
//         cargarR(parametro);
//     });
// });

// function cargarR(parametro) {
//     $.ajax({
//         url: '{{ route('tablaR', ['parametro' => ':parametro']) }}'.replace(':parametro', parametro),
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             // Rellena el contenedor con el HTML de la tabla
//             $('#tabla-resultados-reporte').html(response.tabla);
//         },
//         error: function(xhr, status, error) {
//             console.log(error);
//         }
//     });
// }
