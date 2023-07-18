//Declaración de variables
var escolaridad = document.getElementById("escolaridad");
var leerescribir = document.getElementById("leerescribir");
var discapacidad = document.getElementById("discapacidad");
var referidopor = document.getElementById("referidopor");
var fecha_ocurrencia = document.getElementById("fecha_ocurrencia");
var diafestivo = document.getElementById("diafestivo");
var sitio_ocurrencia = document.getElementById("sitio_ocurrencia");
var lesion_entidad = document.getElementById("lesion_entidad");
var lesion_municipio = document.getElementById("lesion_municipio");
var lesion_localidad = document.getElementById("lesion_localidad");
var lesion_domicilio = document.getElementById("lesion_domicilio");
var lesion_colonia = document.getElementById("lesion_colonia");
var intensionalidad = document.getElementById("intensionalidad");
var agente_lesion = document.getElementById("agente_lesion");
var toxicomanias = document.getElementById("toxicomanias");
var servicio = document.getElementById("servicio");
var tipoatencion = document.getElementById("tipoatencion");
var areaanatomica = document.getElementById("areaanatomica");
var consec_resultante = document.getElementById("consec_resultante");
var causaexterna = document.getElementById("causaexterna");

//VALIDACION CON EVENTOS
const validarCamposVacios = (e) => {

    var campo = e.target;
    var valorcampo = e.target.value;

    if (valorcampo.trim().length == 0) {
        campo.classList.add("invalido");
        campo.nextElementSibling.classList.add("errorSpan");
        campo.nextElementSibling.innerText = "Este campo es requerido";
    }else{
        campo.classList.add("valido");
        campo.nextElementSibling.classList.remove("errorSpan");
        campo.nextElementSibling.innerText = "";
    }

}

//CAMPOS A VALIDAR:
escolaridad.addEventListener("blur", validarCamposVacios);
leerescribir.addEventListener("blur", validarCamposVacios);
discapacidad.addEventListener("blur", validarCamposVacios);
referidopor.addEventListener("blur", validarCamposVacios);
fecha_ocurrencia.addEventListener("blur", validarCamposVacios);
diafestivo.addEventListener("blur", validarCamposVacios);
sitio_ocurrencia.addEventListener("blur", validarCamposVacios);
lesion_entidad.addEventListener("blur", validarCamposVacios);
lesion_municipio.addEventListener("blur", validarCamposVacios);
lesion_localidad.addEventListener("blur", validarCamposVacios);
//lesionCp.addEventListener("blur", validarCamposVacios);
lesion_domicilio.addEventListener("blur", validarCamposVacios);
lesion_colonia.addEventListener("blur", validarCamposVacios);
intensionalidad.addEventListener("blur", validarCamposVacios);
agente_lesion.addEventListener("blur", validarCamposVacios);
toxicomanias.addEventListener("blur", validarCamposVacios);
servicio.addEventListener("blur", validarCamposVacios);
tipoatencion.addEventListener("blur", validarCamposVacios);
areaanatomica.addEventListener("blur", validarCamposVacios);
consec_resultante.addEventListener("blur", validarCamposVacios);
causaexterna.addEventListener("blur", validarCamposVacios);

//causaexterna = $.trim(causaexterna);


var error = document.getElementById("error");
error.style.color = "red";

function enviarFormulario() {

    var mensajesError = [];

    if (escolaridad.value == "") {

        mensajesError.push("La escolaridad no puede estar vacía");

    }

    if (leerescribir.value == "") {

        mensajesError.push("Leer y escribir no puede estar vacío");

    }

    if (discapacidad.value == "") {

        mensajesError.push("Discapacidad no puede estar vacío");

    }

    if (referidopor.value == "") {

        mensajesError.push("Referido por: no puede estar vacío");

    }

    if (fecha_ocurrencia == "") {
        mensajesError.push("La fecha de no debe estar vacía");
    }

    if (diafestivo.value == "") {

        mensajesError.push("Día festivo no puede estar vacío");

    }

    if (sitio_ocurrencia.value == "") {

        mensajesError.push("Sitio de ocurrencia no puede estar vacío");

    }

    if (lesion_entidad.value == "") {

        mensajesError.push("La entidad de ocurrencia no puede estar vacía");

    }

    if (lesion_municipio.value == "") {

        mensajesError.push("Municipio de ocurrencia no puede estar vacío");

    }

    if (lesion_localidad.value == "") {

        mensajesError.push("Localidad de ocurrencia no puede estar vacío");

    }

    if (lesion_domicilio.value === null || lesion_domicilio.value === "") {

        mensajesError.push("Domicilio de ocurrencia no puede estar vacío");

    }

    if (lesion_colonia.value == "") {

        mensajesError.push("Colonia de ocurrencia no puede estar vacía");

    }

    if (intensionalidad.value == "") {

        mensajesError.push("La intencionalidad no puede estar vacía");

    }

    if (agente_lesion.value == "") {

        mensajesError.push("Agente de lesión no puede estar vacía");

    }

    if (toxicomanias.value == "") {

        mensajesError.push("La sospecha que el paciente bajo efectos de: no puede estar vacía");

    }

    if (servicio.value == "") {

        mensajesError.push("El servicio no puede estar vacía");

    }

    if (tipoatencion.value == "") {

        mensajesError.push("El tipo de atención no puede estar vacío");

    }

    if (intensionalidad.value == "") {

        mensajesError.push("El área anatómica no puede estar vacía");

    }

    if (consec_resultante.value == "") {

        mensajesError.push("La consecuencia resultante no puede estar vacía");

    }

    if (causaexterna.value == "") {

        alert("La causa externa no puede estar vacía");
        mensajesError.push("La causa externa no puede estar vacía");
        //console.log("Causa externa = " . causaexterna);

    }


    error.innerHTML = mensajesError.join(", ");

    return false;

}