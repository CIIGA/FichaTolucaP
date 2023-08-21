
// Espera a que la vista se cargue completamente
document.addEventListener("DOMContentLoaded", function() {
$(document).ready(function() {
    //cargamos la tabla reporte con los datos que ya tiene
    var clave = document.getElementById("clave").value;
        $.ajax({
            url: '/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/index.php/tabla_vca/'+clave, //nos redirijimos a esta ruta
            type: 'GET', //por el metodo get
            dataType: 'json', //se recibira un dato json
            success: function(response) { //si se recibio la respuesta
                var tabla = $("#resultados_vca tbody"); //mostramos la tabla reporte con el registro ya eliminado
                tabla.html(response.tabla);
            },
            error: function(xhr, status, error) {
                // console.log(error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error de comunicacion comuniquese con soporte',
                    icon: 'error',
                    showConfirmButton: true
                    
                });
            }
        });
   
});
});