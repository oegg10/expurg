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

    $idconsulta = $_GET['idq'];


    $idusuario = $_SESSION['idusuario'];

    $editar = "UPDATE consultas SET lesiones='NO' WHERE idconsulta = '$idconsulta'";

    $editado = $con->query($editar);

    if ($editado > 0) {
        header('location:../extend/alerta.php?msj=Consulta actualizada&c=cons1&p=in&t=success');
    } else {

        header('location:../extend/alerta.php?msj=Error al actualizar consulta&c=cons1&p=in&t=error');
    }

    $con->close();
}

ob_end_flush();
