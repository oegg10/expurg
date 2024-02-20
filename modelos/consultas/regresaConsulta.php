<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    $id = $_GET['idr'];

    $regresa = "UPDATE recepciones SET condicion = 4 WHERE idrecepcion = '$id'";
    $regresado = $con->query($regresa);

    if ($regresado > 0) {

        header('location:../extend/alerta.php?msj=La consulta fue regresada&c=rec&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=La accion no se pudo realizar&c=rec&p=in&t=error');
    }

    $con->close();
}
