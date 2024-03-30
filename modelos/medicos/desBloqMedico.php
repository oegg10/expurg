<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    $id = $_GET['id'];

    $bloqueo = "UPDATE medicos SET condicion = 1 WHERE idmedico = '$id'";
    $bloqueado = $con->query($bloqueo);

    if ($bloqueado > 0) {

        header('location:../extend/alerta.php?msj=EL Medico a sido desbloqueado&c=medicos&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=EL Medico NO ha podido ser desbloqueado&c=medicos&p=in&t=error');
    }

    $bloqueado->close();
    $con->close();
}
