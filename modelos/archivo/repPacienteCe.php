<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7 && $_SESSION['idrol'] != 6 && $_SESSION['idrol'] != 8) {
        header("Location:../../index.php");
    }

    ini_set("display_errors", 1);

    $id = $_GET['id'];

    /*===== CONSULTAS EN citas_ce =====*/
    $consExp = "SELECT c.idexpediente, e.nombrep, c.idmedico, c.fechacita, c.evento, c.observaciones, c.condicion, m.nombremedico, s.nombreservicio FROM citas_ce c INNER JOIN medicos m ON c.idmedico = m.idmedico INNER JOIN servicios s ON m.idservicio = s.idservicio INNER JOIN exparchivo e ON c.idexpediente = e.idexpediente WHERE c.idexpediente = '$id'";
    $resultado = $con->query($consExp);

    /*===== CONSULTA EN  =====*/
    $sqlPxNvo = "SELECT c.idpxnvo, c.nombrenvo, c.expediente, c.idmedico, c.fechacita, c.observaciones, c.condicion, m.nombremedico, s.nombreservicio FROM citascenvo c INNER JOIN medicos m ON c.idmedico = m.idmedico INNER JOIN servicios s ON m.idservicio = s.idservicio WHERE c.expediente = '$id' AND c.condicion = 2";
    $respxNvo = $con->query($sqlPxNvo);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Historial Paciente No. expediente: <?php echo $id; ?></h5>
                    </div>
                    <div class="card-body">
                        <h3>Consulta Externa</h3>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <th>Fecha cita</th>
                                    <th>Nombre</th>
                                    <th>Expediente</th>
                                    <th>Médico que atendio</th>
                                    <th>Servicio</th>
                                    <th>Observaciones</th>
                                    <th>Evento</th>
                                    <th>Condición</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y", strtotime($reg['fechacita'])) . "</td>
                                        <td>" . $reg['nombrep'] . "</td>
                                        <td>" . $reg['idexpediente'] . "</td>
                                        <td>" . $reg['nombremedico'] . "</td>
                                        <td>" . $reg['nombreservicio'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>
                                        <td>" . $reg['evento'] . "</td>";

                                        if ($reg['condicion'] = 1) {
                                            echo "<td style='color: green;'>Consultado</td>";
                                        }else{
                                            echo "<td style='color: red;'>NO Consultado</td>";
                                        }

                                        echo "</tr>";

                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th>Fecha cita</th>
                                    <th>Nombre</th>
                                    <th>Expediente</th>
                                    <th>Médico que atendio</th>
                                    <th>Servicio</th>
                                    <th>Observaciones</th>
                                    <th>Evento</th>
                                    <th>Condición</th>
                                </tfoot>
                            </table>
                        </div>

                        <h3>No contaba con número de expediente</h3>
                        <div class="table-responsive">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <th>Fecha cita</th>
                                    <th>Nombre</th>
                                    <th>Expediente</th>
                                    <th>Médico que atendio</th>
                                    <th>Servicio</th>
                                    <th>Observaciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($pxNvo = $respxNvo->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y", strtotime($pxNvo['fechacita'])) . "</td>
                                        <td>" . $pxNvo['nombrenvo'] . "</td>
                                        <td>" . $pxNvo['expediente'] . "</td>
                                        <td>" . $pxNvo['nombremedico'] . "</td>
                                        <td>" . $pxNvo['nombreservicio'] . "</td>
                                        <td>" . $pxNvo['observaciones'] . "</td>
                                        </tr>";

                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th>Fecha cita</th>
                                    <th>Nombre</th>
                                    <th>Expediente</th>
                                    <th>Médico que atendio</th>
                                    <th>Servicio</th>
                                    <th>Observaciones</th>
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