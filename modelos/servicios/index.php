<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $servicios = "SELECT * FROM servicios ORDER BY nombreservicio ASC";

    $resultado = $con->query($servicios);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Servicios</h5>
                    </div>
                    <div class="card-body">
                        <a href="insServicio.php" class="btn btn-primary">
                            Registrar Servicio <span class="fa fa-plus-circle"></span>
                        </a>
                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Nombre del servicio</th>
                                        <th>Condición</th>
                                        <th>Editar</th>
                                        <th>Bloqueo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . $reg['nombreservicio'] . "</td>";
                                        if ($reg['condicion']) {
                                            echo "<td><span class='text-success'>Activo</span></td>";
                                        } else {
                                            echo "<td><span class='text-danger'>Bloqueado</span></td>";
                                        }

                                        echo "<td><a href='editarServicio.php?id=" . $reg['idservicio'] . "' type='button' class='btn btn-warning'><i class='fa fa-pencil'></i></a></td>";
                                        if ($reg['condicion']) {
                                            echo "<td><a href='bloqServicio.php?id=" . $reg['idservicio'] . "' type='button' class='btn btn-danger'><i class='fa fa-times'></i></a></td>";
                                        } else {
                                            echo "<td><a href='desBloqServicio.php?id=" . $reg['idservicio'] . "' type='button' class='btn btn-success'><i class='fa fa-check'></i></a></td>";
                                        }

                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre del servicio</th>
                                        <th>Condición</th>
                                        <th>Editar</th>
                                        <th>Bloqueo</th>
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