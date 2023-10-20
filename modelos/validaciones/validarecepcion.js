//variables para almacenar los datos que se ingresan en los campos
//let mtvoconsulta, sala, medico, referencia, tipoConsulta, observaciones;
//Guardar el dato en las variables
/*mtvoconsulta = document.getElementById("mtvoconsulta").value;
sala = document.getElementById("sala").value;
medico = document.getElementById("medico").value;
referencia = document.getElementById("referencia").value;
tipoConsulta = document.getElementById("tipoconsulta");
observaciones = document.getElementById("observaciones").value;

let error = document.getElementById("error");
error.style.color = "red";

function enviarFormulario() {

    let mensajesError = [];

    if (mtvoconsulta === "" || mtvoconsulta === null) {
        mensajesError.push("El campo motivo de la consulta, está vacío");
    }
    
    if (sala.value === null || sala.value === "") {

        mensajesError.push("Seleccione una opción para el campo SALA");
        sala.focus();
    }
    
    if (medico === "") {
        mensajesError.push("El campo medico, está vacío");
        medico.focus();
    }
    
    if (mtvoconsulta.length > 100) {
        mensajesError.push("El motivo de la consulta, es muy largo");
    }
    
    if (medico.length > 80) {
        mensajesError.push("El nombre del medico, es muy largo");
    }
    
    if (referencia.length > 200) {
        mensajesError.push("La referencia, es muy larga");
    }

    if (tipoConsulta.value === null || tipoConsulta.value === "") {

        mensajesError.push("Se debe elegir la opción de primera vez o subsecuente");

    }

    if (tipoConsulta.value === "OTRO" && observaciones.value === "") {

        mensajesError.push("Si el tipo de consulta es OTRO especifique en observaciones");
        
    }

    if (observaciones.length > 250) {
        mensajesError.push("Las observaciones debe ser menor a 250 caracteres");
    }

    error.innerHTML = mensajesError.join(", ");

    return false;

}*/


/*function validar() {

    //variables para almacenar los datos que se ingresan en los campos
    let mtvoconsulta, sala, medico, referencia, tipoConsulta, observaciones;
    //Guardar el dato en las variables
    mtvoconsulta = document.getElementById("mtvoconsulta").value;
    sala = document.getElementById("sala");
    medico = document.getElementById("medico").value;
    referencia = document.getElementById("referencia").value;
    tipoConsulta = document.getElementById("tipoconsulta");
    observaciones = document.getElementById("observaciones").value;

    let error = document.getElementById("error");
    error.style.color = "red";

    //Evaluaciones
    if (mtvoconsulta === "") {
        alert("El campo motivo de la consulta, está vacío");
        return false;

    }
    else if (sala.value == "0" ||
        sala.length <= 2 ||
        sala.value == "") {

        alert("Seleccione una opción para el campo SALA");
        sala.focus();
        return false;

    }
    else if (medico === "") {
        alert("El campo medico, está vacío");
        medico.focus();
        return false;

    } else if (mtvoconsulta.length > 100) {
        alert("El motivo de la consulta, es muy largo");
        return false;

    } else if (medico.length > 80) {
        alert("El nombre del medico, es muy largo");
        return false;

    } else if (referencia.length > 200) {
        alert("La referencia, es muy larga");
        return false;

    } else if (observaciones.length > 250) {
        alert("Las observaciones, son muy largas");
        return false;

    }



}*/