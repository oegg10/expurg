<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 8) {
        header("Location:../../index.php");
    }

    //buscador
    $buscar = strtoupper($_REQUEST['buscar']);
    if (empty($buscar)) {
        header("location:index.php");
    }

    $pacientes = "SELECT e.idexpediente, e.nombrep, e.curp, e.tipopaciente, e.nombretrabajador, e.otros, e.estado, e.observaciones, e.obs1, e.obs2, e.obs3, e.idusuario, e.fechaalta, u.nombre AS usuario FROM exparchivo e INNER JOIN usuarios u ON e.idusuario=u.idusuario WHERE (e.nombrep LIKE '%$buscar%' OR e.curp LIKE '%$buscar%') ORDER BY e.idexpediente DESC";

    $resultado = $con->query($pacientes);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Consulta de Pacientes</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <a href="archivoindex.php" class="btn btn-primary">
                                    Regresar <span class="fa fa-plus-circle"></span>
                                </a>
                            </div>
                        </div>


                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla1" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Expediente</th>
                                        <th>Nombre</th>
                                        <th>CURP</th>
                                        <th>Tipo pac.</th>
                                        <th>Estado</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                                <td><span class='text-dark'><strong>" . $reg['idexpediente'] . "</strong></span></td>
                                                <td>" . $reg['nombrep'] . "</td>
                                                <td>" . $reg['curp'] . "</td>
                                                <td>" . $reg['tipopaciente'] . "</td>";

                                        if ($reg['estado'] == 'ACTIVO' || $reg['estado'] == '') {
                                            echo "<td><span class='text-primary'><strong>ACTIVO</strong></span></td>";
                                        } elseif ($reg['estado'] == 'DEPURADO') {
                                            echo "<td><span class='text-info'><strong>DEPURADO</strong></span></td>";
                                        } elseif ($reg['estado'] == 'DEFUNCION') {
                                            echo "<td><span class='text-danger'><strong>DEFUNCION</strong></span></td>";
                                        } elseif ($reg['estado'] == 'DEPURADO Y NVO. NUMERO') {
                                            echo "<td><span class='text-warning'><strong>DEPURADO Y NVO. NUMERO</strong></span></td>";
                                        }

                                        echo "<td>" . $reg['observaciones'] . "</td>
                                                
                                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>CURP</th>
                                    <th>Tipo pac.</th>
                                    <th>Estado</th>
                                    <th>Observaciones</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div><br>

    <?php include "../extend/footer.php"; ?>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>