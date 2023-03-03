<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
}else{

    if ($_SESSION['idrol'] != 5) {
        header("Location: ../../index.php");
    }

include "../../conexion/conexion.php";

$id = $_GET['idrecep'];
$idusuario = $_SESSION['idusuario'];

$bloqueo = "INSERT INTO triages(idrecepcion, condicion, idusuario) VALUES ('$id','2','$idusuario')";
$bloqueado = $con->query($bloqueo);

if ($bloqueado > 0) {
    echo "<script>
        alert('No se realizó el TRIAGE');
        window.location = 'index.php';
    </script>";
}else{
    echo "<script>
        alert('No se pudo realizar la acción');
        window.location = 'index.php';
    </script>";
}

}
