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

        $varAjax = $_POST['peticion'];
        echo $varAjax;
        /*$consulta = mysqli_query($con, "SELECT idmedico, diasconsulta, numpacientes FROM medicos WHERE idmedico = '$varAjax'");
        $array_data=array();
        while ($data=mysqli_fetch_assoc($consulta)) {
            $array_data[]=$data;
        }

        echo json_encode($array_data, JSON_UNESCAPED_UNICODE);*/

    }

}