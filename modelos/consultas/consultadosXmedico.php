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
        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, r.idusuario, c.idconsulta, c.fechaalta, c.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 2 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' AND c.idusuario = '$idusuario'";

        $resultado = $con->query($consulta);

        //CONSULTA LESIONES
        $lesiones = "SELECT l.idlesion,l.condicion,c.fechaingreso,p.nombre,p.curp,r.edad,r.mtvoconsulta FROM consultas c INNER JOIN lesiones l ON c.idconsulta = l.idconsulta INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON p.idpaciente = r.idpaciente WHERE l.condicion = 1 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf' AND c.idusuario = '$idusuario'";

        $resLesiones = $con->query($lesiones);
        $con->close();

    } else {

        $consulta = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.observaciones, r.condicion, r.idusuario, c.idconsulta, c.fechaalta, c.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 2 AND DATE(r.fechahorarecep) = CURDATE() AND c.idusuario = '$idusuario'";

        $resultado = $con->query($consulta);

        //CONSULTA LESIONES
        $lesiones = "SELECT l.idlesion,l.condicion,c.fechaingreso,p.nombre,p.curp,r.edad,r.mtvoconsulta FROM consultas c INNER JOIN lesiones l ON c.idconsulta = l.idconsulta INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON p.idpaciente = r.idpaciente WHERE l.condicion = 1 AND DATE(r.fechahorarecep) = CURDATE() AND c.idusuario = '$idusuario'";

        $resLesiones = $con->query($lesiones);
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
                            <h6>CONSULTADOS</h6>
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
                                            <!-- <a href='imprimirConsulta.php?idc=" . $reg['idconsulta'] . "' type='button' class='btn btn-primary' title='Imprimir hoja de consulta'><i class='fa fa-print'></i></a> -->
                                            <a href='imprimeObs.php?id=" . $reg['idconsulta'] . "&idr=" . $reg['idrecepcion'] . "' type='button' class='btn btn-black' title='Imprimir nota medica'><i class='fa fa-print'></i></a>

                                            <a href='editarConsultaCons1.php?idc=" . $reg['idconsulta'] . "&idr=" . $reg['idrecepcion'] . "' type='button' class='btn btn-warning' title='Editar'><i class='fa fa-pencil-square-o'></i></a>
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

                        <hr>
                        <!-- ===== INICIO TABLA LESIONES ===== -->
                        <div class="card-header">
                            <h6>LESIONES</h6>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive" id="listadoregistros">
                                <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Fecha consulta</th>
                                            <th>Nombre</th>
                                            <th>CURP</th>
                                            <th>Edad</th>
                                            <th>Motivo consulta</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($filalesion = $resLesiones->fetch_array(MYSQLI_BOTH)) {
                                            echo "<tr>
                            <td>" . date("d-m-Y - H:i:s", strtotime($filalesion['fechaingreso'])) . "</td>
                            <td>" . $filalesion['nombre'] . "</td>
                            <td>" . $filalesion['curp'] . "</td>
                            <td>" . $filalesion['edad'] . "</td>
                            <td>" . $filalesion['mtvoconsulta'] . "</td>
                            <td>
                                <a href='../lesiones/editarLesiones.php?idl=" . $filalesion['idlesion'] . "' type='button' class='btn btn-warning' title='Editar lesión'><i class='fa fa-pencil-square-o'></i></a>
                            </td>
                            </tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Fecha ingreso</th>
                                            <th>Nombre</th>
                                            <th>CURP</th>
                                            <th>Edad</th>
                                            <th>Motivo consulta</th>
                                            <th>Opción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- FIN TABLA LESIONES -->

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