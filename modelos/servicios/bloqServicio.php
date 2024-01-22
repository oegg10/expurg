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

    $bloqueo = "UPDATE servicios SET condicion = 0 WHERE idservicio = '$id'";
    $bloqueado = $con->query($bloqueo);

    if ($bloqueado > 0) {

        header('location:../extend/alerta.php?msj=EL servicio a sido bloqueado&c=servicios&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=EL servicio NO ha podido ser bloqueado&c=servicios&p=in&t=error');
    }

    $bloqueado->close();
    $con->close();
}
