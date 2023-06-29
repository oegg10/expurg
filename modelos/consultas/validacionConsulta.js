//https://www.youtube.com/watch?v=h_nl7mHCL5c
//SELECCION DE CAMPOS
var fechaIngreso = document.querySelector("[name=fechaingreso]");
var fechaAlta = document.querySelector("[name=fechaalta]");
var notaIngresoUrg = document.querySelector("[name=notaingresourg]");
var attPreHosp = document.querySelector("[name=atnprehosp]");
var tipoUrgencia = document.querySelector("[name=tipourgencia]");
var traslTrans = document.querySelector("[name=trastrans]");
var motivoAtencion = document.querySelector("[name=motivoatencion]");
var tipoCama = document.querySelector("[name=tipocama]");
var altaPor = document.querySelector("[name=altapor]");
var ministerioPublico = document.querySelector("[name=ministeriopublico]");
var afeccionPrincipal = document.querySelector("[name=afecprincipal]");
var Lesiones = document.querySelector("[name=lesiones]");

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
fechaIngreso.addEventListener("blur", validarCamposVacios);
fechaAlta.addEventListener("blur", validarCamposVacios);
notaIngresoUrg.addEventListener("blur", validarCamposVacios);
attPreHosp.addEventListener("blur", validarCamposVacios);
tipoUrgencia.addEventListener("blur", validarCamposVacios);
traslTrans.addEventListener("blur", validarCamposVacios);
motivoAtencion.addEventListener("blur", validarCamposVacios);
tipoCama.addEventListener("blur", validarCamposVacios);
altaPor.addEventListener("blur", validarCamposVacios);
ministerioPublico.addEventListener("blur", validarCamposVacios);
afeccionPrincipal.addEventListener("blur", validarCamposVacios);
Lesiones.addEventListener("blur", validarCamposVacios);

//========= FIN CAMPOS A VALIDAR ======================================================

//Declaración de variables
var sexo = document.getElementById("sexo");
var mujeredadfertil = document.getElementById("mujeredadfertil");
var fecharecepcion = document.getElementById("fecharecepcion");
var fechaingreso = document.getElementById("fechaingreso");
var fechaalta = document.getElementById("fechaalta");
var notaingresourg = document.getElementById("notaingresourg");
var atnprehosp = document.getElementById("atnprehosp");
var tipourgencia = document.getElementById("tipourgencia");
var motivoatencion = document.getElementById("motivoatencion");
var tipocama = document.getElementById("tipocama");
var altapor = document.getElementById("altapor");
var ministeriopublico = document.getElementById("ministeriopublico");
var afecprincipal = document.getElementById("afecprincipal");
var lesiones = document.getElementById("lesiones");

//===============  FIN VARIABLES DE FORMULARIO ==============================

var error = document.getElementById("error");
error.style.color = "red";


function enviarFormulario() {

    var mensajesError = [];

    var fecharecepcion1 = new Date(fecharecepcion.value);
    var fechaR = fecharecepcion1.getTime();
    //console.log(fechaR);
    var fechaingreso1 = new Date(fechaingreso.value);
    var fechaI = fechaingreso1.getTime();
    //console.log(fechaI);
    var fechaalta1 = new Date(fechaalta.value);
    var fechaA = fechaalta1.getTime();
    //console.log(fechaA);
    //var difFechaRfechaI = fechaI - fechaR;
    //console.log(difFechaRfechaI);
    

    if (fechaingreso.value == null || fechaingreso.value == "") {
        mensajesError.push("La fecha de inicio no debe estar vacía");
    }

    if (fechaalta.value == null || fechaalta.value == "") {
        mensajesError.push("La fecha de alta no debe estar vacía");
    }

    if (fechaI < fechaR || fechaI == fechaR) {
        mensajesError.push("La fecha de inicio es menor o igual a la de recepción");
    }

    if (fechaA < fechaI || fechaA == fechaI) {
        mensajesError.push("La fecha de alta es menor o igual a la de inicio");
    }

    if (notaingresourg.value === null || notaingresourg.value === "" || notaingresourg.value === "                                        ") {

        //console.log("El textarea esta vacío");
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

    if (lesiones.value === null || lesiones.value === "") {

        mensajesError.push("Se debe elegir la opción de lesiones");

    }


    error.innerHTML = mensajesError.join(", ");

    return false;

}
