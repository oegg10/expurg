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

    $bloqueo = "UPDATE recepciones SET condicion = 3 WHERE idrecepcion = '$id'";
    $bloqueado = $con->query($bloqueo);

    if ($bloqueado > 0) {

        header('location:../extend/alerta.php?msj=La recepcion fue catalogada como N.S.P.&c=rec&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=La recepcion no se pudo realizar&c=rec&p=in&t=error');
    }

    $con->close();
}
