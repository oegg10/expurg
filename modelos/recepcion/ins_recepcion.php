<?php

session_start();

require_once "../extend/scripts.php";

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

        $idpaciente = isset($_POST["idpaciente"]) ? mysqli_real_escape_string($con, $_POST['idpaciente']) : "";
        $edad = isset($_POST["edad"]) ? mysqli_real_escape_string($con, $_POST['edad']) : "";
        $mtvoconsulta = isset($_POST["mtvoconsulta"]) ? mysqli_real_escape_string($con, $_POST['mtvoconsulta']) : "";
        $embarazo = isset($_POST["embarazo"]) ? mysqli_real_escape_string($con, $_POST['embarazo']) : "";
        $semgesta = isset($_POST["semgesta"]) ? mysqli_real_escape_string($con, $_POST['semgesta']) : "";
        $numgesta = isset($_POST["numgesta"]) ? mysqli_real_escape_string($con, $_POST['numgesta']) : "";
        $sala = isset($_POST["sala"]) ? mysqli_real_escape_string($con, $_POST['sala']) : "";
        $medico = isset($_POST["medico"]) ? mysqli_real_escape_string($con, $_POST['medico']) : "";
        $referencia = isset($_POST["referencia"]) ? mysqli_real_escape_string($con, $_POST['referencia']) : "";
        $tipoconsulta = isset($_POST["tipoconsulta"]) ? mysqli_real_escape_string($con, $_POST['tipoconsulta']) : "";
        $observaciones = isset($_POST["observaciones"]) ? mysqli_real_escape_string($con, $_POST['observaciones']) : "";

        $idusuario = $_SESSION['idusuario'];

        /*if ($sala == "" || $sala != "CONSULTA GENERAL DE URGENCIAS" || $sala != "GINECOLOGIA" || $sala != "URGENCIAS|ENCAMADOS" || $sala != "CONTROL TERMICO" || $sala != "TRIAGE") {

            //array_push($campos, "Elija una opción para la sala, o no cumple con las especificaciones");
            header('location:../extend/alerta.php?msj=Error al registrar la recepcion, indique la sala correctamente&c=rec&p=in&t=error');
        }*/

        //Si vienen vacíos los campos de embarazo, sem gesta y num gesta
        if (empty($embarazo) && empty($semgesta) && empty($numgesta)) {
            $embarazo = "NO";
            $semgesta = 0;
            $numgesta = 0;
        } elseif (empty($semgesta) && empty($numgesta)) {
            $semgesta = 0;
            $numgesta = 0;
        }

        $sql = "INSERT INTO recepciones(idpaciente,edad,mtvoconsulta,embarazo,semgesta,numgesta,sala,medico,referencia,tipoconsulta,observaciones,condicion,idusuario,fechamod) VALUES ('$idpaciente','$edad','$mtvoconsulta','$embarazo','$semgesta','$numgesta','$sala','$medico','$referencia','$tipoconsulta','$observaciones', '1', '$idusuario', NOW())";

        $resultado = $con->query($sql);

        if ($resultado > 0) {

            header('location:../extend/alerta.php?msj=La recepcion fue exitosa&c=rec&p=in&t=success');
            $con->close();
            exit();
        } else {

            header('location:../extend/alerta.php?msj=Error al registrar la recepcion&c=rec&p=in&t=error');
        }

        $con->close();

        /*
        ASIGNACION DE CONDICION
        1 En sala de espera
        2 Consultado
        3 NSP
        4 Pasa a CONSULTA GENERAL DE URGENCIAS
        6 ELIMINADO
        7 
        8
        9 
        
        */

    }
}
