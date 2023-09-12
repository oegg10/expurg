//https://www.youtube.com/watch?v=h_nl7mHCL5c
//Declaración de variables
var sexo = document.getElementById("sexo");
var mujeredadfertil = document.getElementById("mujeredadfertil");
var fecharecepcion = document.getElementById("fecharecepcion");
var fechaingreso = document.getElementById("fechaingreso");
var fechaalta = document.getElementById("fechaalta");
var notaingresourg = document.getElementById("notaingresourg");
var atnprehosp = document.getElementById("atnprehosp");
var tipourgencia = document.getElementById("tipourgencia");
var trastrans = document.getElementById("trastrans");
var motivoatencion = document.getElementById("motivoatencion");
var tipocama = document.getElementById("tipocama");
var altapor = document.getElementById("altapor");
var ministeriopublico = document.getElementById("ministeriopublico");
var afecprincipal = document.getElementById("afecprincipal");
var lesion_es = document.getElementById("lesion_es");
var lesiones = document.getElementById("lesiones");

//===============  FIN VARIABLES DE FORMULARIO ==============================

//VALIDACION CAMPOS VACIOS
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
fechaingreso.addEventListener("blur", validarCamposVacios);
fechaalta.addEventListener("blur", validarCamposVacios);
notaingresourg.addEventListener("blur", validarCamposVacios);
atnprehosp.addEventListener("blur", validarCamposVacios);
tipourgencia.addEventListener("blur", validarCamposVacios);
trastrans.addEventListener("blur", validarCamposVacios);
motivoatencion.addEventListener("blur", validarCamposVacios);
tipocama.addEventListener("blur", validarCamposVacios);
altapor.addEventListener("blur", validarCamposVacios);
ministeriopublico.addEventListener("blur", validarCamposVacios);
afecprincipal.addEventListener("blur", validarCamposVacios);
lesion_es.addEventListener("blur", validarCamposVacios);
lesiones.addEventListener("blur", validarCamposVacios);

//========= FIN CAMPOS A VALIDAR ======================================================

var error = document.getElementById("error");
error.style.color = "red";


function enviarFormulario() {

    var mensajesError = [];

    var fecharecepcion1 = new Date(fecharecepcion.value);
    var fechaR = fecharecepcion1.getTime();
    var fechaingreso1 = new Date(fechaingreso.value);
    var fechaI = fechaingreso1.getTime();
    var fechaalta1 = new Date(fechaalta.value);
    var fechaA = fechaalta1.getTime();

    if (fechaingreso.value == null || fechaingreso.value == "") {
        mensajesError.push("La fecha de inicio no debe estar vacía");
    }

    if (fechaI <= fechaR) {
        mensajesError.push("La fecha de inicio es menor o igual a la de recepción");
        //console.log(fechaR);
        //console.log(fechaI);
    }

    if (fechaalta.value === null || fechaalta.value === "") {
        mensajesError.push("La fecha de alta no debe estar vacía");
    }

    if (fechaA <= fechaI) {
        mensajesError.push("La fecha de alta es menor o igual a la de inicio");
    }

    if (notaingresourg.value === null || notaingresourg.value === "" || notaingresourg.value === "                                        ") {

        mensajesError.push("La nota de urgencias no puede estar vacía");

    }

    if (atnprehosp.value === null || atnprehosp.value === "") {

        mensajesError.push("La atención pre-hospitalaria no puede estar vacía");

    }

    if (tipourgencia.value === null || tipourgencia.value === "") {

        mensajesError.push("El tipo de urgencia no puede estar vacío");

    }

    if (motivoatencion.value === null || motivoatencion.value === "") {

        mensajesError.push("El motivo de atención no puede estar vacío");

    }

    if (tipocama.value === null || tipocama.value === "") {

        mensajesError.push("El tipo de cama no puede estar vacío");

    }

    if (altapor.value === null || altapor.value === "") {

        mensajesError.push("Alta por: no puede estar vacío");

    }

    if (ministeriopublico.value === null || ministeriopublico.value === "") {

        mensajesError.push("Ministerio público no puede ir vacío");

    }

    if (sexo.value == "Femenino") {

        //console.log("El campo dice Femenino");

        if (mujeredadfertil.value === null || mujeredadfertil.value === "") {

            mensajesError.push("El campo Mujer en edad fertil no puede estar vacío");

        }

    }

    if (afecprincipal.value === null || afecprincipal.value === "") {

        mensajesError.push("La afección principal no puede estar vacía");

    }

    if (lesion_es.value === null || lesion_es.value === "") {

        mensajesError.push("Se debe elegir la opción de si hay lesión");

    }

    if (lesiones.value === null || lesiones.value === "") {

        mensajesError.push("Se debe elegir la opción de lesiones");

    }


    error.innerHTML = mensajesError.join(", ");

    return false;

}
