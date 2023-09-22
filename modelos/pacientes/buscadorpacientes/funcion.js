function busqueda(){

    let texto = document.getElementById("nombre").value;
    let parametros = {

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