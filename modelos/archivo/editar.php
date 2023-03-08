<?php

session_start();

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

        //https://www.php.net/manual/es/function.preg-replace.php      
        $idexpediente = mysqli_real_escape_string($con, $_POST['idexpediente']);
        $nombrep = mysqli_real_escape_string($con, $_POST['nombrep']);
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $tipopaciente = mysqli_real_escape_string($con, $_POST['tipopaciente']);
        $estado = mysqli_real_escape_string($con, $_POST['estado']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $idusuario = $_SESSION['idusuario'];

        

        //validación de campos
        /*$campos = array();

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

        //contar los campos con error
        if (count($campos) > 0) {

            echo "<div class='p-3 mb-2 bg-danger text-white'>";
            for ($i = 0; $i < count($campos); $i++) {
                echo "<li>" . $campos[$i] . "</li>";
            }
            echo "<br>";
            echo "<a href='index.php' class='btn btn-info'>Regresar</a></div>";
        } else {*/

            //==========================================================================================


            //Realizamos la inserción de los datos
            $editar = "UPDATE exparchivo SET nombrep='$nombrep',
                    curp='$curp',
                    tipopaciente='$tipopaciente',
                    estado='$estado',
                    observaciones='$observaciones',
                    idusuario='$idusuario',
                    fechaalta=NOW() WHERE idexpediente = '$idexpediente'";

            $editado = $con->query($editar);

            if ($editado > 0) {
                header('location:../extend/alerta.php?msj=EL registro a sido actualizado&c=pac&p=in&t=success');
            } else {

                header('location:../extend/alerta.php?msj=Error al actualizar registro&c=pac&p=in&t=error');
            }

            $con->close();
        //}
    }
}

ob_end_flush();
