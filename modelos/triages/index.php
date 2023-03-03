<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 5) {
        header("Location:../../index.php");
    }

    //$recepciones = "SELECT r.idrecepcion, r.idpaciente,p.nombre,r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 2";

    $recepciones = "SELECT r.idrecepcion, r.idpaciente,p.nombre,r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente LEFT JOIN triages t ON r.idrecepcion = t.idrecepcion WHERE r.condicion = 2 AND t.idrecepcion IS NULL";

    $resultado = $con->query($recepciones);

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
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Embarazo</th>
                                        <th>Semanas</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Consultar</th>
                                        <th>No Triage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . $reg['fechahorarecep'] . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['embarazo'] . "</td>
                            <td>" . $reg['semgesta'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['observaciones'] . "</td>
                            <td><a href='triage.php?idrecep=" . $reg['idrecepcion'] . "' type='button' class='btn btn-success'><i class='fa fa-eye'></i></a></td>
                            <td><a href='notriage.php?idrecep=" . $reg['idrecepcion'] . "' type='button' class='btn btn-danger'><i class='fa fa-times'></i></a></td>
                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Embarazo</th>
                                        <th>Semanas</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Consultar</th>
                                        <th>No Triage</th>
                                    </tr>
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