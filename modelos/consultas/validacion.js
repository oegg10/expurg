
//Declaración de variables
var fechaingreso = document.getElementById("fechaingreso");
var fechaalta = document.getElementById("fechaalta");
var notaingresourg = document.getElementById("notaingresourg");
var atnprehosp = document.getElementById("atnprehosp");
var tipourgencia = document.getElementById("tipourgencia");
var motivoatencion = document.getElementById("motivoatencion");
var tipocama = document.getElementById("tipocama");
var altapor = document.getElementById("altapor");
var afecprincipal = document.getElementById("afecprincipal");

var error = document.getElementById("error");
error.style.color = "red";

function enviarFormulario() {

    var mensajesError = [];
    
    if (fechaingreso == "" || fechaalta == "" || fechaingreso >= fechaalta) {
        mensajesError.push("La fecha de alta es menor o igual a la de ingreso o están vacías");
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

    if (afecprincipal.value === null || afecprincipal.value === "") {

        mensajesError.push("La afección principal no puede estar vacía");

    }


    error.innerHTML = mensajesError.join(", ");

    return false;

}