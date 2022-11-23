$(buscar_paciente());

function buscar_paciente(consulta){
    $.ajax({
        url: 'buscarpaciente.php',
        type: 'POST',
        dataType: 'html',
        data:{consulta: consulta},
    })

    .done(function(respuesta){
        $("#datos").html(respuesta);
    })

    .fail(function(){
        console.log("error");
    });

}