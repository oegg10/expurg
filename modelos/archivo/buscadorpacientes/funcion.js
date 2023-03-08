function busqueda(){

    var texto = document.getElementById("nombre").value;
    var parametros = {

        "texto" : texto

    };

    $.ajax({

        data: parametros,
        url: "buscadorpacientes/valida.php",
        type: "POST",
        success: function(response){
            $("#datosPaciente").html(response);
        }

    });

}