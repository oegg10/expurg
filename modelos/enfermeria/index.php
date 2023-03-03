<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 6) {
        header("Location:../../index.php");
    }

    $pacientes = "SELECT * FROM pacientes ORDER BY nombre ASC";

    $resultado = $con->query($pacientes);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Pacientes</h5>
                    </div>
                    <div class="card-body">
                        <a href="paciente.php" class="btn btn-primary">
                            Registrar Paciente <span class="fa fa-plus-circle"></span>
                        </a>
                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>CURP</th>
                                    <th>Afiliación</th>
                                    <th>No. afiliación</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                <td>" . $reg['expediente'] . "</td>
                                <td>" . $reg['nombre'] . "</td>
                                <td>" . $reg['sexo'] . "</td>
                                <td>" . $reg['curp'] . "</td>
                                <td>" . $reg['afiliacion'] . "</td>
                                <td>" . $reg['numafiliacion'] . "</td>
                                <td class='btn-group'>
                                    <a href='imprimiregreso.php?idp=" . $reg['idpaciente'] . "' type='button' class='btn btn-secundary'><i class='fa fa-print' title='Imprimir hoja'></i></a>
                                    <a href='edit_paciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-warning' title='Editar paciente'><i class='fa fa-pencil'></i></a>
                                </td>
                                </tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>CURP</th>
                                    <th>Afiliación</th>
                                    <th>No. afiliación</th>
                                    <th>Opciones</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php include "../extend/footer.php"; ?>
                </div>
            </div>
        </div>
    </div>

<?php
}

ob_end_flush();
?>