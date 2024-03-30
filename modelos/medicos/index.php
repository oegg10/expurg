<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $medicos  = "SELECT m.idmedico, m.nombremedico, m.curp, m.cedula, s.nombreservicio, m.diasconsulta, m.numpacientes, m.condicion FROM medicos m INNER JOIN servicios s ON m.idservicio=s.idservicio ORDER BY m.condicion ASC";

    $resultado = $con->query($medicos );

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Medicos</h5>
                    </div>
                    <div class="card-body">
                        <!--<a href="insMedico.php" class="btn btn-primary">
                            Registrar Medico <span class="fa fa-plus-circle"></span>
                        </a> -->
                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Nombre del medico</th>
                                        <th>CURP</th>
                                        <th>Cédula</th>
                                        <th>Servicio</th>
                                        <th>Días consulta</th>
                                        <th>Num. pacientes</th>
                                        <th>Estatus</th>
                                        <th>Editar</th>
                                        <th>Bloqueo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                            echo "<tr>
                                                <td>" . $reg['nombremedico'] . "</td>
                                                <td>" . $reg['curp'] . "</td>
                                                <td>" . $reg['cedula'] . "</td>
                                                <td>" . $reg['nombreservicio'] . "</td>
                                                <td>" . $reg['diasconsulta'] . "</td>
                                                <td>" . $reg['numpacientes'] . "</td>";
                                                    if ($reg['condicion'] == 1) {
                                                        echo "<td><span class='text-success'>Activo</span></td>";
                                                    } else {
                                                        echo "<td><span class='text-danger'>Bloqueado</span></td>";
                                                    }

                                                    echo "<td><a href='editarMedico.php?id=" . $reg['idmedico'] . "' type='button' class='btn btn-warning'><i class='fa fa-pencil'></i></a></td>";
                                                    if ($reg['condicion'] == 1) {
                                                        echo "<td><a href='bloqMedico.php?id=" . $reg['idmedico'] . "' type='button' class='btn btn-danger'><i class='fa fa-times'></i></a></td>";
                                                    } else {
                                                        echo "<td><a href='desBloqMedico.php?id=" . $reg['idmedico'] . "' type='button' class='btn btn-success'><i class='fa fa-check'></i></a></td>";
                                                    }

                                            echo "</tr>";
                                        }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre del medico</th>
                                        <th>CURP</th>
                                        <th>Cédula</th>
                                        <th>Servicio</th>
                                        <th>Días consulta</th>
                                        <th>Num. pacientes</th>
                                        <th>Estatus</th>
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