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

    $eliminar = "DELETE FROM recepciones WHERE idrecepcion = '$id'";
    $eliminado = $con->query($eliminar);

    if ($eliminado > 0) {

        header('location:../extend/alerta.php?msj=La recepcion fue eliminada&c=rec&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=La recepcion no se pudo eliminar&c=rec&p=in&t=error');
    }

    $con->close();
}
