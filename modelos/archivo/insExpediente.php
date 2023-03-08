<?php

session_start();

require_once "../extend/scripts.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    if (!isset($_SESSION['idusuario'])) {
        header("Location: ../../index.php");
    }

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $nombrep = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['nombrep']));
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $tipopaciente = mysqli_real_escape_string($con, $_POST['tipopaciente']);
        $estado = mysqli_real_escape_string($con, $_POST['estado']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $idusuario = $_SESSION['idusuario'];



        //==========================================================================================

        //Realizamos la inserción de los datos
        $sql = "INSERT INTO exparchivo(nombrep, curp, tipopaciente, estado, observaciones, idusuario, fechaalta) VALUES ('$nombrep','$curp','$tipopaciente','$estado','$observaciones','$idusuario', NOW())";

        $resultado = $con->query($sql);

        if ($resultado > 0) {

            header('location:../extend/alerta.php?msj=EL paciente a sido registrado&c=rec&p=pr&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al registrar al paciente&c=pac&p=in&t=error');
        }

        $con->close();
    }
}
