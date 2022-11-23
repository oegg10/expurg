<?php

ob_start();

include "../../conexion/conexion.php";

if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {
    $fechai = $_POST['fechai'];
    $fechaf = $_POST['fechaf'];

    header("Content-type: application/vdn.ms-excel");
    header("Content-Disposition: attachment;filename=Reporte_recepcion.xls");

    error_reporting(0);

    $recepciones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, r.fechahorarecep, DATE(r.fechahorarecep) as fecha, r.edad, r.mtvoconsulta, r.medico, r.embarazo, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario, u.nombre as nu, u.turno FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' ORDER BY r.fechahorarecep ASC";

    $resultado = $con->query($recepciones);
}else{

    echo "<script>
            alert('No se han seleccionado las fechas');
            window.location = 'reporteConsultados.php';
        </script>";

}


    ?>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Embarazo</th>
                <th>Semanas</th>
                <th>Motivo consulta</th>
                <th>Medico</th>
                <th>Referencia</th>
                <th>Sala</th>
                <th>Observaciones</th>
                <th>Capturo</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody>

            <?php
                while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                    echo "<tr>
                            <td>" . $reg['fechahorarecep'] . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['sexo'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['embarazo'] . "</td>
                            <td>" . $reg['semgesta'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['medico'] . "</td>
                            <td>" . $reg['referencia'] . "</td>
                            <td>" . $reg['sala'] . "</td>
                            <td>" . $reg['observaciones'] . "</td>
                            <td>" . $reg['nu'] . "</td>
                            <td>" . $reg['turno'] . "</td>
                        </tr>";
                }
                ?>

        </tbody>
    </table>

<?php

$resultado->close();
ob_end_flush();

?>