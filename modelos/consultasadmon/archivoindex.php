<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 8) {
        header("Location:../../index.php");
    }

    //Paginación
    $paginacion = "SELECT e.idexpediente, e.nombrep, e.curp, e.tipopaciente, e.nombretrabajador, e.estado, e.observaciones, e.obs1, e.obs2, e.obs3, e.idusuario, e.fechaalta, u.nombre FROM exparchivo e INNER JOIN usuarios u ON e.idusuario=u.idusuario ORDER BY e.idexpediente DESC";

    $result_pag = $con->query($paginacion);
    //Sacar el numero de filas
    $row = mysqli_num_rows($result_pag);
    $num_registros = 7;
    $total_pags = ceil($row / $num_registros);

    if (isset($_GET['pag'])) {
        $pagina = $_GET['pag'];
    } else {
        $pagina = 1;
    }

    if ($pagina == 1) {
        $inicio = 0;
    } else {
        $res = $pagina - 1;
        $inicio = ($num_registros * $res);
    }

    $pacientes = "SELECT e.idexpediente, e.nombrep, e.curp, e.tipopaciente, e.nombretrabajador, e.otros, e.estado, e.observaciones, e.obs1, e.obs2, e.obs3, e.idusuario, e.fechaalta, u.nombre AS usuario FROM exparchivo e INNER JOIN usuarios u ON e.idusuario=u.idusuario ORDER BY e.idexpediente DESC LIMIT $inicio,$num_registros";

    $resultado = $con->query($pacientes);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Consultar Expedientes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 style="color: red;">El historial del paciante en consulta externa empezó en abril de 2024, antes de esa fecha no hay registros</h5>
                            </div>

                            <div class="col-sm-4">
                                <!-- FORMULARIO PARA BUSCAR PACIENTES -->
                                <form action="archivobuscarpaciente.php" method="GET" autocomplete="off">
                                    <div class="form-group">
                                        <input type="search" name="buscar" id="buscar" class="form-control" placeholder="Buscar Paciente">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-search"> Buscar</i></button>
                                    </div>
                                </form>
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
                                        <th>Historial</th>
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

                                            <td class='btn-group'>

                                                <a href='../archivo/repPacienteCe.php?id=" . $reg['idexpediente'] . "' type='button' class='btn btn-secundary' title='Historial del paciente'><i class='fa fa-address-book-o'></i></a>

                                            </td>

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
                                    <th>Historial</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php

    $atras = $pagina - 1;
    $adelante = $pagina + 1;

    ?>

    <center>
        <p>TOTAL PAGINAS: <?php echo $total_pags; ?></p>
    </center>
    <div class="row">
        <div class="col-4" align="right">
            <?php if ($pagina > 1) : ?>
                <a href="archivoindex.php?pag=<?php echo $atras; ?>" class="page-link"><i class="fa fa-arrow-circle-left"></i></a>
            <?php endif; ?>
        </div>

        <div class="col-4">
            <form action="archivoindex.php" method="GET">
                <input type="number" class="form-control" name="pag" size="1" placeholder="Página actual: <?php echo $pagina; ?>" style="width: 404px;">
            </form>
        </div>

        <div class="col-4">
            <?php if ($pagina < $total_pags) : ?>
                <a href="archivoindex.php?pag=<?php echo $adelante; ?>" class="page-link"><i class="fa fa-arrow-circle-right"></i></a>
            <?php endif; ?>
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