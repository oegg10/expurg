<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 1) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    $id = $_GET['id'];

    $bloqueo = "UPDATE usuarios SET condicion = 1 WHERE idusuario = '$id'";
    $bloqueado = $con->query($bloqueo);

    if ($bloqueado > 0) {

        header('location:../extend/alerta.php?msj=EL usuario a sido desbloqueado&c=us&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=EL usuario NO ha podido ser desbloqueado&c=us&p=in&t=error');
    }

    $bloqueado->close();
    $con->close();
}
