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

        //CONSULTAS
        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, r.fechahorarecep, r.edad, r.mtvoconsulta, r.mtvocancelo, r.sala, r.condicion, r.fechamod FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 3 AND r.sala LIKE 'CONSULTA GENERAL DE URGENCIAS' AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf'";

        $resultado = $con->query($consulta);
        $con->close();

    } else {

        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, r.fechahorarecep, r.edad, r.mtvoconsulta, r.mtvocancelo, r.sala, r.condicion, r.fechamod FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 3 AND r.sala LIKE 'CONSULTA GENERAL DE URGENCIAS' AND DATE(r.fechahorarecep) = CURDATE()";

        $resultado = $con->query($consulta);
        $con->close();
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>CONSULTA GENERAL DE URGENCIAS</h5>
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

                                </div>

                            </div>
                        </form>

                        <hr>
                        <div class="card-header">
                            <h3 style="color: red;"><strong>NO CONSULTADOS</strong></h3>
                            <h6 style="color: red;"><strong>Se pueden regresar los pacientes a consulta presionando el <a href='#' type='button' class='btn btn-warning' title='Regresar a consulta'><i class='fa fa-undo'></i></a> para realizarle la consulta, aparecerán en la pestaña de <a href="index.php"> Consultas.</a></strong></h6>
                        </div>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha y hora</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Fecha|hora canceló</th>
                                        <th>Motivo canceló</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . $reg['sexo'] . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechamod'])) . "</td>
                                        <td>" . $reg['mtvocancelo'] . "</td>
                                        <td class='btn-group'>                               
                                            <a href='regresaConsulta.php?idr=" . $reg['idrecepcion'] . "' type='button' class='btn btn-warning' title='Regresar a consulta'><i class='fa fa-undo'></i></a>
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
                                    <th>Fecha|hora canceló</th>
                                    <th>Motivo canceló</th>
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
//$con->close();
ob_end_flush();
?>