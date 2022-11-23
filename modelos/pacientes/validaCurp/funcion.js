function busqueda(){

    var texto = document.getElementById("curp").value;
    var parametros = {

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