$(document).on("click", "#insert_vca", function () {
    var tipologia = document.getElementById("tipologias").value;
    var superficie = document.getElementById("superficie").value;
    var edad = document.getElementById("edad").value;
    var nivel = document.getElementById("niveles").value;
    var gc = document.getElementById("gc").value;
    var color = document.getElementById("Acolores").value;
    var clave = document.getElementById("clave").value;

    // Realiza la validación
    if (
        tipologia === "" ||
        superficie === "" ||
        edad === "" ||
        nivel === "" ||
        gc === "" ||
        color === "" ||
        clave === ""
    ) {
        // alert("Por favor, completa todos los campos antes de continuar.");
        Swal.fire({
            title: "Error...",
            text: "Por favor, completa todos los campos antes de continuar.",
            icon: "error",
            showConfirmButton: true,
            allowOutsideClick: true,
        });
        return; // Detener la ejecución si algún campo está vacío
    }
    Swal.fire({
        title: "Agregando...",
        text: "Por favor, espere.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var url = "/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/index.php/add_vca";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            tipologia: tipologia,
            superficie: superficie,
            edad: edad,
            nivel: nivel,
            gc: gc,
            color: color,
            clave: clave,
        },
        success: function (response) {
            Swal.close();
            if (response.tabla) {
                superficie = document.getElementById("superficie").value="";
                edad = document.getElementById("edad").value="";
                var tabla = $("#resultados_vca tbody"); //mostramos la tabla reporte con el registro ya eliminado
                tabla.html(response.tabla);
            } else {
                Swal.fire({
                    title: "Error al Agregar",
                    text: "Intentelo de nuevo y si el problema persiste comuniquese con soporte",
                    icon: "error",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 2000,
                });
            }
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
