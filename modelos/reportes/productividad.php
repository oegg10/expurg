<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    //CONDICION PARA LLENAR LA TABLA DE PRODUCTIVIDAD POR RECEPCIONISTA
    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $productividad_por_recepcionista = "SELECT IFNULL(count(r.fechahorarecep),0) as totrecepciones, u.nombre, u.turno FROM recepciones r INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' GROUP BY u.idusuario ORDER BY u.turno";

        $resultado = $con->query($productividad_por_recepcionista);
    } else {

        $productividad_por_recepcionista = "SELECT IFNULL(count(r.fechahorarecep),0) as totrecepciones, u.nombre, u.turno FROM recepciones r INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE DATE(fechahorarecep)=curdate() GROUP BY u.idusuario ORDER BY u.turno";

        $resultado = $con->query($productividad_por_recepcionista);
    }

    //CONDICION PARA LLENAR LA TABLA DE PRODUCTIVIDAD POR TURNO
    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $productividad_por_turno = "SELECT IFNULL(count(r.fechahorarecep),0) as totrecepciones, u.turno FROM recepciones r INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' GROUP BY u.turno ORDER BY u.turno";

        $resultado_turno = $con->query($productividad_por_turno);
    } else {

        $productividad_por_turno = "SELECT IFNULL(count(r.fechahorarecep),0) as totrecepciones, u.turno FROM recepciones r INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE DATE(fechahorarecep)=curdate() GROUP BY u.turno ORDER BY u.turno";

        $resultado_turno = $con->query($productividad_por_turno);
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Consultados</h5>
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
                        <h3>PRODUCTIVIDAD POR RECEPCIONISTA</h3>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Recepciones</th>
                                        <th>Nombre</th>
                                        <th>Turno</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                        <td style='text-align: center;'>" . $reg['totrecepciones'] . "</td>
                                        <td style='text-align: center;'>" . $reg['nombre'] . "</td>
                                        <td style='text-align: center;'>" . $reg['turno'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Recepciones</th>
                                    <th>Nombre</th>
                                    <th>Turno</th>
                                </tfoot>
                            </table>
                        </div>

                        <hr>
                        <h3>PRODUCTIVIDAD POR TURNO</h3>
                        <div class="table-responsive display nowrap" id="tabla">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Recepciones</th>
                                        <th>Turno</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado_turno->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                        <td style='text-align: center;'>" . $reg['totrecepciones'] . "</td>
                                        <td style='text-align: center;'>" . $reg['turno'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Recepciones</th>
                                    <th>Turno</th>
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