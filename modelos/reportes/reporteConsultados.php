<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $recepciones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.medico, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 2 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf'";

        $resultado = $con->query($recepciones);

        //LESIONES
        $sqlLesiones = "SELECT p.nombre AS paciente, p.sexo, c.fechaingreso, r.edad, r.mtvoconsulta, u.nombre AS medico FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN lesiones l ON l.idconsulta = c.idconsulta INNER JOIN usuarios u ON u.idusuario = c.idusuario WHERE DATE(c.fechaingreso) >= '$fechai' AND DATE(c.fechaingreso) <= '$fechaf'";

        $lesiones = $con->query($sqlLesiones);
    } else {

        $recepciones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.medico, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 2 AND DATE(r.fechahorarecep) = CURDATE()";

        $resultado = $con->query($recepciones);

        $sqlLesiones = "SELECT p.nombre AS paciente, p.sexo, c.fechaingreso, r.edad, r.mtvoconsulta, u.nombre AS medico FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN lesiones l ON l.idconsulta = c.idconsulta INNER JOIN usuarios u ON u.idusuario = c.idusuario WHERE DATE(c.fechaingreso) = CURDATE()";

        $lesiones = $con->query($sqlLesiones);
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Reporte por fecha(s)</h5>
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

                        <!-- CONSULTAS -->
                        <h6>Consultas</h6>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Embarazo</th>
                                        <th>Semanas</th>
                                        <th>Sala</th>
                                        <th>Motivo consulta</th>
                                        <th>Médico</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($reg['sexo'] == 'Femenino') {

                                            $reg['sexo'] = "F";

                                            if ($reg['embarazo'] == 'NO') {
                                                $reg['semgesta'] = "";
                                            }
                                        } elseif ($reg['sexo'] == 'Masculino') {

                                            $reg['sexo'] = "M";
                                            $reg['embarazo'] = '';
                                            $reg['semgesta'] = '';
                                        }

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . $reg['sexo'] . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['embarazo'] . "</td>
                                        <td>" . $reg['semgesta'] . "</td>
                                        <td>" . $reg['sala'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . $reg['medico'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Embarazo</th>
                                    <th>Semanas</th>
                                    <th>Sala</th>
                                    <th>Motivo consulta</th>
                                    <th>Médico</th>
                                    <th>Observaciones</th>
                                </tfoot>
                            </table>
                        </div>

                        <!-- LESIONES -->

                        <hr>

                        <h6>Lesiones</h6>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Médico</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($lesion = $lesiones->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($lesion['sexo'] == 'Femenino') {

                                            $lesion['sexo'] = "F";
                                        } elseif ($lesion['sexo'] == 'Masculino') {

                                            $lesion['sexo'] = "M";
                                        }

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($lesion['fechaingreso'])) . "</td>
                                        <td>" . $lesion['paciente'] . "</td>
                                        <td>" . $lesion['sexo'] . "</td>
                                        <td>" . $lesion['edad'] . "</td>
                                        <td>" . $lesion['mtvoconsulta'] . "</td>
                                        <td>" . $lesion['medico'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Motivo consulta</th>
                                    <th>Médico</th>
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
ob_end_flush();
?>