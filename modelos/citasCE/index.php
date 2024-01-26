<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    //$citas_ce  = "SELECT ce.idcita, e.idexpediente, e.nombrep, e.curp, m.idmedico, m.nombremedico, s.nombreservicio, ce.fechacita, ce.consultorio, ce.observaciones, ce.fechacaptura, u.idusuario, u.nombre AS usuario FROM citas_ce ce INNER JOIN exparchivo e ON ce.idexpediente = e.idexpediente INNER JOIN medicos m ON ce.idmedico = m.idmedico INNER JOIN servicios s ON m.idservicio = s.idservicio INNER JOIN usuarios u ON ce.idusuario = u.idusuario WHERE fechacita = CURDATE()";

    $citas_ce  = "SELECT ce.idcita, e.idexpediente, e.nombrep, e.curp, m.idmedico, m.nombremedico, s.nombreservicio, ce.fechacita, ce.consultorio, ce.observaciones, ce.fechacaptura, u.idusuario, u.nombre AS usuario FROM citas_ce ce INNER JOIN exparchivo e ON ce.idexpediente = e.idexpediente INNER JOIN medicos m ON ce.idmedico = m.idmedico INNER JOIN servicios s ON m.idservicio = s.idservicio INNER JOIN usuarios u ON ce.idusuario = u.idusuario";

    $resultado = $con->query($citas_ce );

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Consulta Externa</h5>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha Cita</th>
                                        <th>Expediente</th>
                                        <th>Nombre Pac.</th>
                                        <th>CURP</th>
                                        <th>Consultorio</th>
                                        <th>Médico</th>
                                        <th>Servicio</th>
                                        <th>Observaciones</th>
                                        <th>Fecha cap.</th>
                                        <th>Capturó</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                            <td style='color: white; background-color: #030303;'>" . date("d-m-Y", strtotime($reg['fechacita'])) . "</td>
                                            <td>" . $reg['idexpediente'] . "</td>
                                            <td>" . $reg['nombrep'] . "</td>
                                            <td>" . $reg['curp'] . "</td>
                                            <td>" . $reg['consultorio'] . "</td>
                                            <td>" . $reg['nombremedico'] . "</td>
                                            <td>" . $reg['nombreservicio'] . "</td>
                                            <td>" . $reg['observaciones'] . "</td>
                                            <td>" . date("H:i:s - d-m-Y", strtotime($reg['fechacaptura'])) . "</td>
                                            <td>" . $reg['usuario'] . "</td>";

                                            echo "<td><a href='editarCitaCE.php?idcita=" . $reg['idcita'] . "' type='button' class='btn btn-warning'><i class='fa fa-pencil'></i></a></td>";

                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha Cita</th>
                                        <th>Expediente</th>
                                        <th>Nombre Pac.</th>
                                        <th>CURP</th>
                                        <th>Consultorio</th>
                                        <th>Médico</th>
                                        <th>Servicio</th>
                                        <th>Observaciones</th>
                                        <th>Fecha cap.</th>
                                        <th>Capturó</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    </body>

</html>

<?php
}

ob_end_flush();
?>