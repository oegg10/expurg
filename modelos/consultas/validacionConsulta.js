//https://www.youtube.com/watch?v=h_nl7mHCL5c
//Declaración de variables
/*let sexo = document.getElementById("sexo");
let mujeredadfertil = document.getElementById("mujeredadfertil");
//let fecharecepcion = document.getElementById("fecharecepcion");
let fechaingreso = document.getElementById("fechaingreso");
let fechaalta = document.getElementById("fechaalta");
let notaingresourg = document.getElementById("notaingresourg");
let atnprehosp = document.getElementById("atnprehosp");
let tipourgencia = document.getElementById("tipourgencia");
let trastrans = document.getElementById("trastrans");
let motivoatencion = document.getElementById("motivoatencion");
let tipocama = document.getElementById("tipocama");
let altapor = document.getElementById("altapor");
let ministeriopublico = document.getElementById("ministeriopublico");
let afecprincipal = document.getElementById("afecprincipal");
let lesion_es = document.getElementById("lesion_es");
let lesiones = document.getElementById("lesiones");

//===============  FIN VARIABLES DE FORMULARIO ==============================

//VALIDACION CAMPOS VACIOS
const validarCamposVacios = (e) => {

    let campo = e.target;
    let valorcampo = e.target.value;

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

let error = document.getElementById("error");
error.style.color = "red";


function enviarFormulario() {

    let mensajesError = [];

    let fecharecepcion1 = new Date(fecharecepcion.value);
    let fechaR = fecharecepcion1.getTime();
    let fechaingreso1 = new Date(fechaingreso.value);
    let fechaI = fechaingreso1.getTime();
    let fechaalta1 = new Date(fechaalta.value);
    let fechaA = fechaalta1.getTime();

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

}*/
