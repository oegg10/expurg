<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
}else{

    if ($_SESSION['idrol'] != 6) {
        header("Location: ../../index.php");
    }

include "../../conexion/conexion.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
}

if (!empty($_POST)) {
    
    $expediente = mysqli_real_escape_string($con,$_POST['expediente']);
    $nombre = mysqli_real_escape_string($con,$_POST['nombre']);
    $curp = mysqli_real_escape_string($con,$_POST['curp']);
    $fechanac = mysqli_real_escape_string($con,$_POST['fechanac']);
    $entidadnac = mysqli_real_escape_string($con,$_POST['entidadnac']);
    $sexo = mysqli_real_escape_string($con,$_POST['sexo']);
    $edocivil = mysqli_real_escape_string($con,$_POST['edocivil']);
    $afiliacion = mysqli_real_escape_string($con,$_POST['afiliacion']);
    $numafiliacion = mysqli_real_escape_string($con,$_POST['numafiliacion']);
    $domicilio = mysqli_real_escape_string($con,$_POST['domicilio']);
    $colonia = mysqli_real_escape_string($con,$_POST['colonia']);
    $cp = mysqli_real_escape_string($con,$_POST['cp']);
    $municipio = mysqli_real_escape_string($con,$_POST['municipio']);
    $localidad = mysqli_real_escape_string($con,$_POST['localidad']);
    $entidaddom = mysqli_real_escape_string($con,$_POST['entidaddom']);
    $telefono = mysqli_real_escape_string($con,$_POST['telefono']);
    //$idpaciente = "";
    //$fechaalta = "";

    $verpaciente = "SELECT idpaciente, curp FROM pacientes WHERE curp = '$curp'";

    $existepaciente = $con->query($verpaciente);
    $fila = $existepaciente->num_rows;

    if ($fila > 0) {
        echo "<script>
                alert('El paciente ya está registrado');
                window.location = 'index.php';
            </script>";
    }else{

        //Realizamos la inserción de los datos
        $sql = "INSERT INTO pacientes(expediente, nombre, curp, fechanac, entidadnac, sexo, edocivil, afiliacion, numafiliacion, domicilio, colonia, cp, municipio, localidad, entidaddom, telefono) VALUES ('$expediente','$nombre','$curp','$fechanac','$entidadnac','$sexo','$edocivil','$afiliacion','$numafiliacion','$domicilio','$colonia','$cp','$municipio','$localidad','$entidaddom','$telefono')";

        $resultado = $con->query($sql);

        if ($resultado > 0) {
            
            echo "<script>
                alert('El paciente a sido registrado');
                window.location = 'index.php';
            </script>";

        }else{

            echo "<script>
                alert('Error al registrar paciente');
                window.location = 'index.php';
            </script>";

        }

    }
}

}
