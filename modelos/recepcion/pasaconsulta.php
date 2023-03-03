<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location: ../../index.php");
    }

    require_once "../../conexion/conexion.php";

    $id = $_GET['id'];
    $sala = $_GET['sala'];

    date_default_timezone_set('America/Mexico_City');
    $hoy = date("Y-m-d H:i:s");

    //Condición para pasar a consulta al paciente a consultorio 1
    if ($sala != "CONSULTA GENERAL DE URGENCIAS") {
        
        $pasaurg = "UPDATE recepciones SET condicion = 2, fechamod = '$hoy' WHERE idrecepcion = '$id'";
        $pasa = $con->query($pasaurg);

    }else{

        $pasaurg = "UPDATE recepciones SET condicion = 4, fechamod = '$hoy' WHERE idrecepcion = '$id'";
        $pasa = $con->query($pasaurg);

    }

    if ($pasa > 0) {

        header('location:../extend/alerta.php?msj=El paciente fue pasado a consulta&c=rec&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=El paciente NO pudo ser pasado a consulta&c=rec&p=in&t=error');
    }

    $con->close();
}
