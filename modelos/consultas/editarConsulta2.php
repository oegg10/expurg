<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    if (!isset($_SESSION['idusuario'])) {
        header("Location: ../../index.php");
    }

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $idconsulta = isset($_POST["idconsulta"]) ? mysqli_real_escape_string($con, $_POST['idconsulta']) : "";
        //$idrecepcion = isset($_POST["idrecepcion"]) ? mysqli_real_escape_string($con, $_POST['idrecepcion']) : "";
        //$fechaingreso = isset($_POST["fechaingreso"]) ? mysqli_real_escape_string($con, $_POST['fechaingreso']) : "";

        //NOTA DE INGRESO DE URGENCIAS
        $fc = isset($_POST["fc"]) ? mysqli_real_escape_string($con, $_POST['fc']) : "";
        $fr = isset($_POST["fr"]) ? mysqli_real_escape_string($con, $_POST['fr']) : "";
        $ta = isset($_POST["ta"]) ? mysqli_real_escape_string($con, $_POST['ta']) : "";
        $temperatura = isset($_POST["temperatura"]) ? mysqli_real_escape_string($con, $_POST['temperatura']) : "";
        $glucosa = isset($_POST["glucosa"]) ? mysqli_real_escape_string($con, $_POST['glucosa']) : "";
        $talla = isset($_POST["talla"]) ? mysqli_real_escape_string($con, $_POST['talla']) : "";
        $peso = isset($_POST["peso"]) ? mysqli_real_escape_string($con, $_POST['peso']) : "";
        $pabdominal = isset($_POST["pabdominal"]) ? mysqli_real_escape_string($con, $_POST['pabdominal']) : "";
        $imc = isset($_POST["imc"]) ? mysqli_real_escape_string($con, $_POST['imc']) : "";
        $notaingresourg = isset($_POST["notaingresourg"]) ? mysqli_real_escape_string($con, $_POST['notaingresourg']) : "";

        //HOJA DE URGENCIAS
        $atnprehosp = isset($_POST["atnprehosp"]) ? mysqli_real_escape_string($con, $_POST['atnprehosp']) : "";
        $tipourgencia = isset($_POST["tipourgencia"]) ? mysqli_real_escape_string($con, $_POST['tipourgencia']) : "";
        $tiempotraslado = isset($_POST["tiempotraslado"]) ? mysqli_real_escape_string($con, $_POST['tiempotraslado']) : "";
        $nombreunidad = isset($_POST["nombreunidad"]) ? mysqli_real_escape_string($con, $_POST['nombreunidad']) : "";
        $trastrans = isset($_POST["trastrans"]) ? mysqli_real_escape_string($con, $_POST['trastrans']) : "";
        $motivoatencion = isset($_POST["motivoatencion"]) ? mysqli_real_escape_string($con, $_POST['motivoatencion']) : "";
        $tipocama = isset($_POST["tipocama"]) ? mysqli_real_escape_string($con, $_POST['tipocama']) : "";
        //$altapor = isset($_POST["altapor"]) ? mysqli_real_escape_string($con, $_POST['altapor']) : "";
        $otraunidad = isset($_POST["otraunidad"]) ? mysqli_real_escape_string($con, $_POST['otraunidad']) : "";
        $ministeriopublico = isset($_POST["ministeriopublico"]) ? mysqli_real_escape_string($con, $_POST['ministeriopublico']) : "";
        $mujeredadfertil = isset($_POST["mujeredadfertil"]) ? mysqli_real_escape_string($con, $_POST['mujeredadfertil']) : "";
        $afecprincipal = isset($_POST["afecprincipal"]) ? mysqli_real_escape_string($con, $_POST['afecprincipal']) : "";
        $comorbilidad1 = isset($_POST["comorbilidad1"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad1']) : "";
        $comorbilidad2 = isset($_POST["comorbilidad2"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad2']) : "";
        $comorbilidad3 = isset($_POST["comorbilidad3"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad3']) : "";
        $interconsulta1 = isset($_POST["interconsulta1"]) ? mysqli_real_escape_string($con, $_POST['interconsulta1']) : "";
        $interconsulta2 = isset($_POST["interconsulta2"]) ? mysqli_real_escape_string($con, $_POST['interconsulta2']) : "";
        $interconsulta3 = isset($_POST["interconsulta3"]) ? mysqli_real_escape_string($con, $_POST['interconsulta3']) : "";
        $procedim1 = isset($_POST["procedim1"]) ? mysqli_real_escape_string($con, $_POST['procedim1']) : "";
        $procedim2 = isset($_POST["procedim2"]) ? mysqli_real_escape_string($con, $_POST['procedim2']) : "";
        $procedim3 = isset($_POST["procedim3"]) ? mysqli_real_escape_string($con, $_POST['procedim3']) : "";
        $procedim4 = isset($_POST["procedim4"]) ? mysqli_real_escape_string($con, $_POST['procedim4']) : "";
        $procedim5 = isset($_POST["procedim5"]) ? mysqli_real_escape_string($con, $_POST['procedim5']) : "";
        $medicamento1 = isset($_POST["medicamento1"]) ? mysqli_real_escape_string($con, $_POST['medicamento1']) : "";
        $medicamento2 = isset($_POST["medicamento2"]) ? mysqli_real_escape_string($con, $_POST['medicamento2']) : "";
        $medicamento3 = isset($_POST["medicamento3"]) ? mysqli_real_escape_string($con, $_POST['medicamento3']) : "";

        $notaingresourg = trim($notaingresourg);

        $idusuario = $_SESSION['idusuario'];

        $editar = "UPDATE consultas SET fc='$fc',
                                    fr='$fr',
                                    ta='$ta',
                                    temperatura='$temperatura',
                                    glucosa='$glucosa',
                                    talla='$talla',
                                    peso='$peso',
                                    pabdominal='$pabdominal',
                                    imc='$imc',
                                    notaingresourg='$notaingresourg',
                                    atnprehosp='$atnprehosp',
                                    tipourgencia='$tipourgencia',
                                    tiempotraslado='$tiempotraslado',
                                    nombreunidad='$nombreunidad',
                                    trastrans='$trastrans',
                                    motivoatencion='$motivoatencion',
                                    tipocama='$tipocama',
                                    otraunidad='$otraunidad',
                                    ministeriopublico='$ministeriopublico',
                                    mujeredadfertil='$mujeredadfertil',
                                    afecprincipal='$afecprincipal',
                                    comorbilidad1='$comorbilidad1',
                                    comorbilidad2='$comorbilidad2',
                                    comorbilidad3='$comorbilidad3',
                                    interconsulta1='$interconsulta1',
                                    interconsulta2='$interconsulta2',
                                    interconsulta3='$interconsulta3',
                                    procedim1='$procedim1',
                                    procedim2='$procedim2',
                                    procedim3='$procedim3',
                                    procedim4='$procedim4',
                                    procedim5='$procedim5',
                                    medicamento1='$medicamento1',
                                    medicamento2='$medicamento2',
                                    medicamento3='$medicamento3',
                                    fechaalta=NOW(),
                                    idusuario='$idusuario' WHERE idconsulta = '$idconsulta'";

        $editado = $con->query($editar);

        if ($editado > 0) {
            header('location:../extend/alerta.php?msj=Consulta actualizada&c=pac&p=in&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar consulta&c=pac&p=in&t=error');
        }
        
    }

    $con->close();
}

ob_end_flush();
