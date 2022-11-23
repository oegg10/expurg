<?php

ob_start();

include "../../conexion/conexion.php";

//Paginación
$paginacion = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes";
$result_pag = $con->query($paginacion);
//Sacar el numero de filas
$row = mysqli_num_rows($result_pag);
$num_registros = 7;
$total_pags = ceil($row / $num_registros);

if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

if ($pagina == 1) {
    $inicio = 0;
} else {
    $res = $pagina - 1;
    $inicio = ($num_registros * $res);
}

/*if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }*/

    $salida = "";

    $pacientes = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes ORDER BY nombre ASC";

    if (isset($_POST['consulta'])) {
        $q = $con->real_escape_string($_POST['consulta']);
        $pacientes = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes WHERE nombre LIKE '%".$q."%' OR curp LIKE '%".$q."%'";
    }

    $resultado = $con->query($pacientes);

    if ($resultado->num_rows > 0) {
        $salida.= '<table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #757579; color: white;">
                        <tr>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            <th>CURP</th>
                            <th>Afiliación</th>
                            <th>No. afiliación</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>';

        while($paciente = $resultado->fetch_assoc()){
            $salida.= "<tr>
                        <td>".$paciente['nombre']."</td>
                        <td>".$paciente['sexo']."</td>
                        <td>".$paciente['edad']."</td>
                        <td>".$paciente['curp']."</td>
                        <td>".$paciente['afiliacion']."</td>
                        <td>".$paciente['numafiliacion']."</td>

                        <td class='btn-group'>
                            <a href='../../modelos/recepcion/recepcion.php?id=" . $paciente['idpaciente'] . "' type='button' class='btn btn-success' title='Crear recepción'><i class='fa fa-check'></i></a>
                            <a href='../../modelos/reportes/repPaciente.php?id=" . $paciente['idpaciente'] . "' type='button' class='btn btn-secundary' title='Historial del paciente'><i class='fa fa-address-book-o'></i></a>
                            <a href='../pacientes/edit_paciente.php?id=" . $paciente['idpaciente'] . "' type='button' class='btn btn-warning' title='Editar paciente'><i class='fa fa-pencil'></i></a>
                        </td>
                    </tr>";
        }

        $salida.= "</tbody></table>";

    }else{
        $salida.= "No hay datos :(";
    }

    echo $salida;

    $con->close();

    ob_end_flush();

//}

?>