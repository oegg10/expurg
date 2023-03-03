<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        //echo $_SESSION['idrol'];
        header("Location:../../index.php");
    }

    //Consulta a la tabla de recepciones
    $recepciones = "SELECT r.idrecepcion, r.idpaciente,p.nombre,r.fechahorarecep, r.edad, r.mtvoconsulta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente LEFT JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 4 AND c.idrecepcion IS NULL";

    $resultado = $con->query($recepciones);


    //Consulta a la tabla de consultas
    $consultas = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, p.nombre, r.edad, r.mtvoconsulta, c.altapor, c.condicion FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE c.altapor = 'Observación' AND c.condicion = 2";

    $sqlconsulta = $con->query($consultas);

?>

    <!-- PACIENTES QUE SE VAN A CONSULTAR -->
    <h3>Consultas de Urgencias Hospital General Saltillo, consultorio 1</h3>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Aquí aparecen los pacientes por consultar</h5>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha y hora registro</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . date("H:i:s - d-m-Y", strtotime($reg['fechahorarecep'])) . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['observaciones'] . "</td>
                            <td class='btn-group'>                               
                                <a href='../consultas/regresaUrg.php?idrecepcion=" . $reg['idrecepcion'] . "' type='button' class='btn btn-danger' title='Regresar a admisión'><i class='fa fa-eraser'></i></a>                               
                            </td>
                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha y hora registro</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    <!-- PACIENTES QUE SE ENCUENTRAN EN TRIAGE -->
                    <h5>Aquí aparecen los pacientes en observación</h5>

                    <div class="card-body">

                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha ingreso</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($fila = $sqlconsulta->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . date("H:i:s - d-m-Y", strtotime($fila['fechaingreso'])) . "</td>
                            <td>" . $fila['nombre'] . "</td>
                            <td>" . $fila['edad'] . "</td>
                            <td>" . $fila['mtvoconsulta'] . "</td>
                            <td>" . $fila['altapor'] . "</td>
                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha ingreso</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Estatus</th>
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