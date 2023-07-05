//SELECCION DE CAMPOS
var Escolaridad = document.querySelector("[name=escolaridad]");
var leerEscribir = document.querySelector("[name=leerescribir]");
var Discapacidad = document.querySelector("[name=discapacidad]");
var referidoPor = document.querySelector("[name=referidopor]");
var fechaOcurrencia = document.querySelector("[name=fecha_ocurrencia]");
var diaFestivo = document.querySelector("[name=diafestivo]");
var sitioOcurrencia = document.querySelector("[name=sitio_ocurrencia]");
var lesionEntidad = document.querySelector("[name=lesion_entidad]");
var lesionMunicipio = document.querySelector("[name=lesion_municipio]");
var lesionLocalidad = document.querySelector("[name=lesion_localidad]");
var lesionCp = document.querySelector("[name=lesion_cp]");
var lesionDomicilio = document.querySelector("[name=lesion_domicilio]");
var lesionColonia = document.querySelector("[name=lesion_colonia]");
var Intensionalidad = document.querySelector("[name=intensionalidad]");
var agenteLesion = document.querySelector("[name=agente_lesion]");
var Toxicomanias = document.querySelector("[name=toxicomanias]");
var Servicio = document.querySelector("[name=servicio]");
var tipoAtencion = document.querySelector("[name=tipoatencion]");
var areaAnatomica = document.querySelector("[name=areaanatomica]");
var consecResultante = document.querySelector("[name=consec_resultante]");
var causaExterna = document.querySelector("[name=causaexterna]");


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
Escolaridad.addEventListener("blur", validarCamposVacios);
leerEscribir.addEventListener("blur", validarCamposVacios);
Discapacidad.addEventListener("blur", validarCamposVacios);
referidoPor.addEventListener("blur", validarCamposVacios);
fechaOcurrencia.addEventListener("blur", validarCamposVacios);
diaFestivo.addEventListener("blur", validarCamposVacios);
sitioOcurrencia.addEventListener("blur", validarCamposVacios);
lesionEntidad.addEventListener("blur", validarCamposVacios);
lesionMunicipio.addEventListener("blur", validarCamposVacios);
lesionLocalidad.addEventListener("blur", validarCamposVacios);
//lesionCp.addEventListener("blur", validarCamposVacios);
lesionDomicilio.addEventListener("blur", validarCamposVacios);
lesionColonia.addEventListener("blur", validarCamposVacios);
Intensionalidad.addEventListener("blur", validarCamposVacios);
agenteLesion.addEventListener("blur", validarCamposVacios);
Toxicomanias.addEventListener("blur", validarCamposVacios);
Servicio.addEventListener("blur", validarCamposVacios);
tipoAtencion.addEventListener("blur", validarCamposVacios);
areaAnatomica.addEventListener("blur", validarCamposVacios);
consecResultante.addEventListener("blur", validarCamposVacios);
causaExterna.addEventListener("blur", validarCamposVacios);


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


var error = document.getElementById("error");
error.style.color = "red";

function enviarFormulario() {

    var mensajesError = [];

    if (escolaridad.value === null || escolaridad.value === "") {

        mensajesError.push("La escolaridad no puede estar vacía");

    }

    if (leerescribir.value === null || leerescribir.value === "") {

        mensajesError.push("Leer y escribir no puede estar vacío");

    }

    if (discapacidad.value === null || discapacidad.value === "") {

        mensajesError.push("Discapacidad no puede estar vacío");

    }

    if (referidopor.value === null || referidopor.value === "") {

        mensajesError.push("Referido por: no puede estar vacío");

    }

    if (fecha_ocurrencia == "") {
        mensajesError.push("La fecha de no debe estar vacía");
    }

    if (diafestivo.value === null || diafestivo.value === "") {

        mensajesError.push("Día festivo no puede estar vacío");

    }

    if (sitio_ocurrencia.value === null || sitio_ocurrencia.value === "") {

        mensajesError.push("Sitio de ocurrencia no puede estar vacío");

    }

    if (lesion_entidad.value === null || lesion_entidad.value === "") {

        mensajesError.push("La entidad de ocurrencia no puede estar vacía");

    }

    if (lesion_municipio.value === null || lesion_municipio.value === "") {

        mensajesError.push("Municipio de ocurrencia no puede estar vacío");

    }

    if (lesion_localidad.value === null || lesion_localidad.value === "") {

        mensajesError.push("Localidad de ocurrencia no puede estar vacío");

    }

    if (lesion_domicilio.value === null || lesion_domicilio.value === "") {

        mensajesError.push("Domicilio de ocurrencia no puede estar vacío");

    }

    if (lesion_colonia.value === null || lesion_colonia.value === "") {

        mensajesError.push("Colonia de ocurrencia no puede estar vacía");

    }

    if (intensionalidad.value === null || intensionalidad.value === "") {

        mensajesError.push("La intencionalidad no puede estar vacía");

    }

    if (agente_lesion.value === null || agente_lesion.value === "") {

        mensajesError.push("Agente de lesión no puede estar vacía");

    }

    if (toxicomanias.value === null || toxicomanias.value === "") {

        mensajesError.push("La sospecha que el paciente bajo efectos de: no puede estar vacía");

    }

    if (servicio.value === null || servicio.value === "") {

        mensajesError.push("El servicio no puede estar vacía");

    }

    if (tipoatencion.value === null || tipoatencion.value === "") {

        mensajesError.push("El tipo de atención no puede estar vacío");

    }

    if (areaanatomica.value === null || intensionalidad.value === "") {

        mensajesError.push("El área anatómica no puede estar vacía");

    }

    if (consec_resultante.value === null || consec_resultante.value === "") {

        mensajesError.push("La consecuencia resultante no puede estar vacía");

    }

    if (causaexterna.value === null || causaexterna.value === "") {

        mensajesError.push("La causa externa no puede estar vacía");

    }


    error.innerHTML = mensajesError.join(", ");

    return false;

}