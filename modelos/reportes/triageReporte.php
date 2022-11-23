<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    /*if ($_SESSION['idrol'] == 2 || $_SESSION['idrol'] == 3) {
        header("Location:../../index.php");
    }*/

    $triages = "SELECT t.idtriage,t.idrecepcion,t.inicio,r.idpaciente,p.nombre,r.edad,p.sexo,t.condicion FROM triages t INNER JOIN recepciones r ON t.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente";

    $resultado = $con->query($triages);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Recepción Urgencias</h5>
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Sexo</th>
                                        <th>Estadp</th>
                                        <th>Ver Triage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                                <td>" . $reg['inicio'] . "</td>
                                                <td>" . $reg['nombre'] . "</td>
                                                <td>" . $reg['edad'] . "</td>
                                                <td>" . $reg['sexo'] . "</td>";

                                        if ($reg['condicion'] == 1) {
                                            echo "<td><span class='badge badge-success text-white'>Con Triage</span></td>";
                                        } else {
                                            echo "<td><span class='badge badge-danger text-white'>Sin Triage</span></td>";
                                        }

                                        echo "<td><a href='../reportes/reporteTriage.php?idtriage=" . $reg['idtriage'] . "' type='button' class='btn btn-secundary' target='_blank'><i class='fa fa-file-pdf-o'></i></a></td>";
                                    }
                                    ?>

                                </tbody>
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