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

    $pacientes = "SELECT p.idpaciente, p.expediente, p.nombre, p.curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(p.fechanac)), '%Y')+0 AS edad, p.fechanac, p.sexo, p.estado, p.idusuario, u.idusuario, u.nombre AS usuario FROM pacientes p INNER JOIN usuarios u ON p.idusuario=u.idusuario WHERE (p.nombre LIKE '%$buscar%' OR p.curp LIKE '%$buscar%') ORDER BY curp ASC";

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
                                <a href="urgenciasindex.php" class="btn btn-primary">
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
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>CURP</th>
                                        <th>Fecha nac.</th>
                                        <th>Condición</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                                <td>" . $reg['expediente'] . "</td>
                                                <td>" . $reg['nombre'] . "</td>
                                                <td>" . $reg['sexo'] . "</td>
                                                <td>" . $reg['edad'] . "</td>
                                                <td>" . $reg['curp'] . "</td>
                                                <td>" . $reg['fechanac'] . "</td>";

                                                if ($reg['estado'] == 'Activo') {
                                                    echo "<td><span class='text-primary'><strong>Activo</strong></span></td>";
                                                } elseif ($reg['estado'] == 'Depurado') {
                                                    echo "<td><span class='text-info'><strong>Depurado</strong></span></td>";
                                                } elseif ($reg['estado'] == 'Defunción') {
                                                    echo "<td><span class='text-danger'><strong>Defunción</strong></span></td>";
                                                } elseif ($reg['estado'] == 'Depurado y nvo. número') {
                                                    echo "<td><span class='text-warning'><strong>Depurado y nvo. número</strong></span></td>";
                                                }

                                                echo "<td class='btn-group'>
                                                    
                                                    <a href='../../modelos/reportes/repPaciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-secundary' title='Historial del paciente'><i class='fa fa-address-book-o'></i></a>
                                                    
                                                </td>
                                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>CURP</th>
                                    <th>Fecha nac.</th>
                                    <th>Condición</th>
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