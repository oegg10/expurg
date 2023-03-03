<?php

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    if (!isset($_SESSION['idusuario'])) {
        header("Location: ../../index.php");
    }

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php      
        $idpaciente = mysqli_real_escape_string($con, $_POST['idpaciente']);
        $expediente = mysqli_real_escape_string($con,$_POST['expediente']);
        $nombre = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['nombre']));
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $fechanac = mysqli_real_escape_string($con, $_POST['fechanac']);
        $entidadnac = mysqli_real_escape_string($con, $_POST['entidadnac']);
        $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
        $edocivil = mysqli_real_escape_string($con, $_POST['edocivil']);
        $afiliacion = mysqli_real_escape_string($con, $_POST['afiliacion']);
        $numafiliacion = mysqli_real_escape_string($con, $_POST['numafiliacion']);
        $domicilio = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['domicilio']));
        $colonia = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['colonia']));
        $cp = mysqli_real_escape_string($con, $_POST['cp']);
        $municipio = mysqli_real_escape_string($con, $_POST['municipio']);
        $localidad = mysqli_real_escape_string($con, $_POST['localidad']);
        $entidaddom = mysqli_real_escape_string($con, $_POST['entidaddom']);
        $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
        $observaciones = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['observaciones']));
        $estado = mysqli_real_escape_string($con, $_POST['estado']);

        $idusuario = $_SESSION['idusuario'];

        $editar = "UPDATE pacientes SET expediente='$expediente',
                                    nombre='$nombre',
                                    curp='$curp',
                                    fechanac='$fechanac',
                                    entidadnac='$entidadnac',
                                    sexo='$sexo',
                                    edocivil='$edocivil',
                                    afiliacion='$afiliacion',
                                    numafiliacion='$numafiliacion',
                                    domicilio='$domicilio',
                                    colonia='$colonia',
                                    cp='$cp',
                                    municipio='$municipio',
                                    localidad='$localidad',
                                    entidaddom='$entidaddom',
                                    telefono='$telefono',
                                    observaciones='$observaciones',
                                    estado='$estado',
                                    idusuario='$idusuario' WHERE idpaciente = '$idpaciente'";

        $editado = $con->query($editar);

        if ($editado > 0) {
            header('location:../extend/alerta.php?msj=EL paciente a sido actualizado&c=pac&p=in&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar paciente&c=pac&p=in&t=error');
        }

    }

    $con->close();
}

ob_end_flush();
