<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 4) {
        header("Location: ../../index.php");
    }

    $idusuario = $_SESSION['idusuario'];

    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $consulta = "SELECT r.idrecepcion, r.idpaciente, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, p.idpaciente, p.nombre, p.sexo, p.fechanac, c.fechaingreso, c.fechaalta, c.idusuario, u.nombre AS medico, TIMESTAMPDIFF(MINUTE,fechahorarecep,fechaingreso) as difRecepIniConsulta, TIMESTAMPDIFF(MINUTE,c.fechaingreso,c.fechaalta) as difIniFinConsulta FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE r.condicion = 2 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf'";

        $resultado = $con->query($consulta);
    } else {

        $consulta = "SELECT r.idrecepcion, r.idpaciente, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, p.idpaciente, p.nombre, p.sexo, p.fechanac, c.fechaingreso, c.fechaalta, c.idusuario, u.nombre AS medico, TIMESTAMPDIFF(MINUTE,fechahorarecep,fechaingreso) as difRecepIniConsulta, TIMESTAMPDIFF(MINUTE,c.fechaingreso,c.fechaalta) as difIniFinConsulta FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE r.condicion = 2 AND DATE(r.fechahorarecep) = CURDATE()";

        $resultado = $con->query($consulta);

        //select TIMESTAMPDIFF(MINUTE,fechaInicial,fechaFinal) as minutos from MiTabla
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>REPORTE DE DEPARTAMENTO DE CALIDAD</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha inicio (*):</label>
                                    <input type="date" class="form-control" name="fechai" id="fechai" min="2019-09-30" value="<?php echo $fechai; ?>" required>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha final (*):</label>
                                    <input type="date" class="form-control" name="fechaf" id="fechaf" min="2019-09-30" value="<?php echo $fechaf; ?>" required>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                    <button class="btn btn-primary" type="submit"><i class="fa fa-archive"> Recargar tabla con fechas seleccionadas</i></button>

                                    <!-- <a href="repRecep_excel.php" class="btn btn-success" type="button"><i class="fa fa-file-excel-o"> Reporte en Excel</i></a> -->

                                </div>

                            </div>
                        </form>

                        <hr>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>F. recepción</th>
                                        <th>F. inicio consulta</th>
                                        <th>Dif. Recep.-Inicio consulta</th>
                                        <th>F. fin consulta</th>
                                        <th>Dif. Inicio-Fin consulta</th>
                                        <th>Nombre paciente</th>
                                        <th>F. Nacimiento</th>
                                        <th>Edad</th>
                                        <th>Sexo</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Medico</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaingreso'])) . "</td>
                                        <td>" . $reg['difRecepIniConsulta'] . "</td>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaalta'])) . "</td>
                                        <td>" . $reg['difIniFinConsulta'] . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . date("d-m-Y", strtotime($reg['fechanac'])) . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['sexo'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>
                                        <td>" . $reg['medico'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>F. recepción</th>
                                    <th>F. inicio consulta</th>
                                    <th>Dif. Recep.-Inicio consulta</th>
                                    <th>F. fin consulta</th>
                                    <th>Dif. Inicio-Fin consulta</th>
                                    <th>Nombre paciente</th>
                                    <th>F. Nacimiento</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Motivo consulta</th>
                                    <th>Observaciones</th>
                                    <th>Medico</th>
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

$resultado = null;
$con->close();
ob_end_flush();
?>