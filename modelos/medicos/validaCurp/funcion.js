function busqueda(){

    let texto = document.getElementById("curp").value;
    let parametros = {

        "texto" : texto

    };

    $.ajax({

        data: parametros,
        url: "validaCurp/valida.php",
        type: "POST",
        success: function(response){
            $("#datosCurp").html(response);
        }

    });

}