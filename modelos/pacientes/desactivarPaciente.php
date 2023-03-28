<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    $id = $_GET['id'];

    $bloqueo = "UPDATE pacientes SET condicion = 0 WHERE idpaciente = '$id'";
    $bloqueado = $con->query($bloqueo);

    if ($bloqueado > 0) {

        header('location:../extend/alerta.php?msj=EL paciente a sido desactivado&c=pac&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=EL paciente NO ha podido ser desactivado&c=pac&p=in&t=error');
    }

    $bloqueado->close();
    $con->close();
}
