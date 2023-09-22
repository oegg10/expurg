function validar() {

    //variables para almacenar los datos que se ingresan en los campos
    let mtvoconsulta, sala, medico, referencia, observaciones;
    //Guardar el dato en las variables
    mtvoconsulta = document.getElementById("mtvoconsulta").value;
    sala = document.getElementById("sala");
    medico = document.getElementById("medico").value;
    referencia = document.getElementById("referencia").value;
    observaciones = document.getElementById("observaciones").value;

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



}