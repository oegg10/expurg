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
        $expediente = mysqli_real_escape_string($con, $_POST['expediente']);
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

        //validación de campos
        $campos = array();

        //CURP
        if (substr($curp, 0, 4) == "XXXX") {
            array_push($campos, "El campo CURP no debe empezar con XXXX utilice el programa de RFC_CURPS que se encuentra en el escritorio de la PC para obtener la CURP");
        } elseif (empty($curp) || strlen($curp) < 18 || strlen($curp) > 18) {
            array_push($campos, "El campo CURP no debe estar vacío, ni tener menos o más de 18 caracteres");
        }

        //nombre
        if (empty($nombre) || strlen($nombre) < 5 || strlen($nombre) > 100) {
            array_push($campos, "El campo NOMBRE no debe estar vacío, o no cumple con las especificaciones");
        }

        //compruebo que los caracteres sean los permitidos
        $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";
        for ($i = 0; $i < strlen($nombre); $i++) {
            if (strpos($permitidos, substr($nombre, $i, 1)) === false) {
                array_push($campos, "El campo NOMBRE solo debe contener letras");
            }
        }


        //fecha de nacimiento
        if (empty($fechanac)) {
            array_push($campos, "El campo FECHA de nacimiento no debe estar vacío.");
        } else {
            // Obtiene solo el año a partir de una fecha dada
            $anyo = date('Y', strtotime($fechanac));
            // COndicional para verificar si esta dentro del rango de fechas.
            if ($anyo <= 1924) {
                array_push($campos, "El campo FECHA no debe ser menor al 01/01/1925");
            }
        }

        //domicilio
        if (empty($domicilio) || strlen($domicilio) < 5) {
            array_push($campos, "El campo DOMICILIO no debe estar vacío, ni tener menos de 5 caracteres");
        }

        //colonia
        if (empty($colonia) || strlen($colonia) < 5) {
            array_push($campos, "El campo COLONIA no debe estar vacío, ni tener menos de 5 caracteres");
        }

        //municipio
        if (empty($municipio) || strlen($municipio) < 5) {
            array_push($campos, "El campo MUNICIPIO no debe estar vacío, ni tener menos de 5 caracteres");
        }

        //localidad
        if (empty($localidad) || strlen($localidad) < 5) {
            array_push($campos, "El campo LOCALIDAD no debe estar vacío, ni tener menos de 5 caracteres");
        }

        //contar los campos con error
        if (count($campos) > 0) {

            echo "<div class='p-3 mb-2 bg-danger text-white'>";
            for ($i = 0; $i < count($campos); $i++) {
                echo "<li>" . $campos[$i] . "</li>";
            }
            echo "<br>";
            echo "<a href='paciente.php' class='btn btn-info'>Regresar</a></div>";
        } else {

            //==========================================================================================

            $existeExpediente = "SELECT idpaciente, expediente FROM pacientes WHERE (expediente LIKE '$expediente')";

            $existeExp = $con->query($existeExpediente);
            $fila = $existeExp->num_rows;

            if ($fila > 0) {
                header('location:../extend/alerta.php?msj=EL paciente con el numero de expediente:' . $expediente . ' ya existe en la base de datos&c=pac&p=in&t=error');
            } else {

                //Realizamos la inserción de los datos
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
    }
}

ob_end_flush();
