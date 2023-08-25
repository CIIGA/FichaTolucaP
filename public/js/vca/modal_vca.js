$(document).on("click", "#btn_edit_vca", function () {
    var id = $(this).data("id");
    var clave = $(this).data("clave");
    var tipologia = $(this).data("tipologia");
    var superficie = $(this).data("superficie");
    var nivel = $(this).data("nivel");
    var edad = $(this).data("edad");
    var gc = $(this).data("gc");
    
    // console.log(id,' - ',tipologia,' - ',superficie,' - ',nivel,' - ',edad,' - ',gc,' - ');
    $("#idM").val(id);
    $("#claveM").val(clave);
    $("#tipologiaM").val(tipologia);
    $("#superficieM").val(superficie);
    $("#nivelM").val(nivel);
    $("#edadM").val(edad);
    $("#gcM").val(gc);
  
       
        // var url ='/cartomaps/erdmcarto/fichaCataTolucaP/FichaTolucaP/public/index.php/modal_edit_vca/' + itemId;
        // $.ajax({
        //     url: url,
        //     method: 'GET',
        //     success: function(response) {
        //         var tabla = $("#modalContainer"); //mostramos la tabla vca con el registro ya eliminado
        //         tabla.html(response.modal);
        //     }
        // });
    });

  

