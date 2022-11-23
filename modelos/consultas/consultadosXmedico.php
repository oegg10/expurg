<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    $idusuario = $_SESSION['idusuario'];

    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, r.idusuario, c.idconsulta, c.fechaalta, c.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 2 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' AND c.idusuario = '$idusuario'";

        $resultado = $con->query($consulta);
    } else {

        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, r.idusuario, c.idconsulta, c.fechaalta, c.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 2 AND DATE(r.fechahorarecep) = CURDATE() AND c.idusuario = '$idusuario'";

        $resultado = $con->query($consulta);
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>CONSULTA GENERAL DE URGENCIAS Consultados</h5>
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
                                        <th>Fecha y hora</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaalta'])) . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . $reg['sexo'] . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>
                                        <td class='btn-group'>                               
                                            <a href='imprimirConsulta.php?idc=" . $reg['idconsulta'] . "' type='button' class='btn btn-primary' title='Imprimir hoja de consulta'><i class='fa fa-print'></i></a>
                                            <a href='imprimeObs.php?id=" . $reg['idconsulta'] . "&idr=" . $reg['idrecepcion'] . "' type='button' class='btn btn-black' title='Imprimir nota medica'><i class='fa fa-print'></i></a>

                                            <a href='editarConsultaObs.php?idc=" . $reg['idconsulta'] . "&idr=" . $reg['idrecepcion'] . "' type='button' class='btn btn-warning' title='Editar'><i class='fa fa-pencil-square-o'></i></a>
                                        </td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha y hora</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Motivo consulta</th>
                                    <th>Observaciones</th>
                                    <th>Opciones</th>
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