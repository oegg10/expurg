<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    //buscador
    $buscar = strtoupper($_REQUEST['buscar']);
    if (empty($buscar)) {
        header("location:index.php");
    }

    $pacientes = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes WHERE (nombre LIKE '%$buscar%' OR curp LIKE '%$buscar%') ORDER BY curp ASC";

    $resultado = $con->query($pacientes);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Busqueda de Pacientes</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <a href="index.php" class="btn btn-primary">
                                    Regresar <span class="fa fa-plus-circle"></span>
                                </a>
                            </div>
                        </div>


                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla1" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>CURP</th>
                                        <th>Afiliación</th>
                                        <th>No. afiliación</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                                <td>" . $reg['nombre'] . "</td>
                                                <td>" . $reg['sexo'] . "</td>
                                                <td>" . $reg['edad'] . "</td>
                                                <td>" . $reg['curp'] . "</td>
                                                <td>" . $reg['afiliacion'] . "</td>
                                                <td>" . $reg['numafiliacion'] . "</td>
                                                <td class='btn-group'>
                                                    <a href='../../modelos/recepcion/recepcion.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-success' title='Crear recepción'><i class='fa fa-check'></i></a>
                                                    <a href='../../modelos/reportes/repPaciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-secundary' title='Historial del paciente'><i class='fa fa-address-book-o'></i></a>
                                                    <a href='../pacientes/edit_paciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-warning' title='Editar paciente'><i class='fa fa-pencil'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>CURP</th>
                                    <th>Afiliación</th>
                                    <th>No. afiliación</th>
                                    <th>Opciones</th>
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