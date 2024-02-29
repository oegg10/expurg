<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $recepciones = "SELECT r.idrecepcion, r.idpaciente,p.nombre, p.curp, p.sexo, r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.semgesta, r.sala, r.referencia, r.tipoconsulta, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 1 ORDER BY r.idrecepcion ASC";

    $resultado = $con->query($recepciones);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Recepción Urgencias</h5>
                        <div class="row">
                            <div class="col-4">
                                <a href="../pacientes/paciente.php" class="btn btn-primary">Registrar Pacientes</a>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <a href="../desconocidos/desconocido.php" class="btn btn-danger">Registrar desconocido</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>CURP</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Embarazo</th>
                                        <th>SDG</th>
                                        <th>Motivo consulta</th>
                                        <th>Sala</th>
                                        <th>Tipo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($reg['sexo'] == 'Femenino') {

                                            //$reg['sexo'] = "F";

                                            if ($reg['embarazo'] == 'NO') {
                                                $reg['semgesta'] = "";
                                            }
                                        } elseif ($reg['sexo'] == 'Masculino') {

                                            //$reg['sexo'] = "M";
                                            $reg['embarazo'] = '';
                                            $reg['semgesta'] = '';
                                        }

                                        echo "<tr>
                                <td>" . date("H:i:s - d-m-Y", strtotime($reg['fechahorarecep'])) . "</td>
                                <td>" . $reg['curp'] . "</td>
                                <td>" . $reg['nombre'] . "</td>
                                <td>" . $reg['edad'] . "</td>
                                <td>" . $reg['embarazo'] . "</td>
                                <td>" . $reg['semgesta'] . "</td>
                                <td>" . $reg['mtvoconsulta'] . "</td>
                                <td>" . $reg['sala'] . "</td>
                                <td>" . $reg['tipoconsulta'] . "</td>
                                <td>" . $reg['observaciones'] . "</td>
                                <td class='btn-group'>
                                    <a href='pasaconsulta.php?id=" . $reg['idrecepcion'] . "&sala=" . $reg['sala'] . "' type='button' class='btn btn-success' title='Pasar a consulta'><i class='fa fa-stethoscope'></i></a>";

                                        //Condición para no mostrar el botón de imprimir en consultorio 1
                                        if ($reg['sala'] != 'CONSULTA GENERAL DE URGENCIAS') {
                                            echo "<a href='imprimir.php?idr=" . $reg['idrecepcion'] . "&idp=" . $reg['idpaciente'] . "' type='button' class='btn btn-secundary'><i class='fa fa-print' title='Imprimir hoja'></i></a>";
                                        }

                                        echo "<a href='nsp.php?id=" . $reg['idrecepcion'] . "' type='button' class='btn btn-danger' title='No se presentó'><i class='fa fa-times'></i></a>
                                    <a href='eliminar_recepcion.php?id=" . $reg['idrecepcion'] . "' type='button' class='btn btn-dark' title='Eliminar'><i class='fa fa-trash'></i></a>
                                    <a href='edit_recepcion.php?id=" . $reg['idrecepcion'] . "' type='button' class='btn btn-warning' title='Editar'><i class='fa fa-pencil-square-o'></i></a>
                                </td>
                            </tr>";
                                    }

                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>CURP</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Embarazo</th>
                                    <th>SDG</th>
                                    <th>Motivo consulta</th>
                                    <th>Sala</th>
                                    <th>Tipo consulta</th>
                                    <th>Observaciones</th>
                                    <th>Opciones</th>
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

$con->close();

ob_end_flush();
?>