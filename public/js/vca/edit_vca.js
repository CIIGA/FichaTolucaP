$("#editForm_vca").submit(function(event) {
    event.preventDefault();
    

    var id = document.getElementById("idM").value;
    var clave = document.getElementById("claveM").value;
    var tipologia = document.getElementById("tipologiaM").value;
    var superficie = document.getElementById("superficieM").value;
    var edad = document.getElementById("edadM").value;
    var nivel = document.getElementById("nivelM").value;
    var gc = document.getElementById("gcM").value;
    var color = document.getElementById("colorM").value;
    
    console.log(color);

    // Realiza la validación
    if (
        id === "" ||
        clave === "" ||
        tipologia === "" ||
        superficie === "" ||
        edad === "" ||
        nivel === "" ||
        gc === "" ||
        color === "" 
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
        title: "Editando...",
        text: "Por favor, espere.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var url = "/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/index.php/edit_vca";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id,
            clave: clave,
            tipologia: tipologia,
            superficie: superficie,
            edad: edad,
            nivel: nivel,
            gc: gc,
            color: color,
           
        },
        success: function (response) {
            Swal.close();
            if (response.tabla) {
                $("#modal_edit_vca").modal("hide");
                
                var tabla = $("#resultados_vca tbody"); //mostramos la tabla reporte con el registro ya eliminado
                tabla.html(response.tabla);
            } else {
                Swal.fire({
                    title: "Error al Editar",
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
