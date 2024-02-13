<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        //echo $_SESSION['idrol'];
        header("Location:../../index.php");
    }

    //Consulta a la tabla de recepciones
    $recepciones = "SELECT r.idrecepcion, r.idpaciente,p.expediente,p.nombre,p.fechanac,r.fechahorarecep, r.edad, r.mtvoconsulta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente LEFT JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE r.condicion = 4 AND c.idrecepcion IS NULL";

    $resultado = $con->query($recepciones);

    //Consulta para lesiones
    $sqllesiones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.curp, r.edad, r.mtvoconsulta, c.idconsulta, c.fechaingreso, c.lesiones, c.cap_lesion FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente LEFT JOIN consultas c ON r.idrecepcion = c.idrecepcion WHERE c.lesiones = 'SI' AND c.cap_lesion = '2'";

    $lesion = $con->query($sqllesiones);


    //Consulta a la tabla de consultas
    /*$consultas = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, p.expediente, p.nombre, r.edad, r.mtvoconsulta, c.altapor, c.condicion FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE c.altapor = 'Observación' AND c.condicion = 2";

    $sqlconsulta = $con->query($consultas);*/

    /* ACTUALIZAR PAGINA en php
    https://baulcode.com/php/actualizar-pagina-con-php-ejemplo-completo/
    */

    // Variable de declaración en segundos
    $ActualizarDespuesDe = 120;

    // Envíe un encabezado Refresh al navegador preferido.
    header('Refresh: ' . $ActualizarDespuesDe);


?>

    <!-- PACIENTES QUE SE VAN A CONSULTAR -->
    <h3>Consultas de Urgencias Hospital General Saltillo, consultorio 1</h3>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Aquí aparecen los pacientes por consultar (Sala de espera)</h5>
                        <h5 style="color: red;"><strong>Si el paciente ya no se encuentra en sala de espera o no se le va a realizar la consulta, favor de oprimir el <a href='#' class='btn btn-danger' title='No consultado'><i class='fa fa-times'></i></a> Evitar entrar a la consulta y poner (. - sin diagnóstico, etc.), gracias</strong></h5>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha y hora de Reg.</th>
                                        <th>Expediente</th>
                                        <th>Nombre</th>
                                        <th>Fecha nac.</th>                                        
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    //<td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>

                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . date("H:i:s - d-m-Y", strtotime($reg['fechahorarecep'])) . "</td>
                            <td>" . $reg['expediente'] . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . date("d-m-Y", strtotime($reg['fechanac'])) . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['observaciones'] . "</td>
                            <td class='btn-group'>
                                <a href='consultaC1.php?idrecep=" . $reg['idrecepcion'] . "' type='button' class='btn btn-success' title='Consultar'><i class='fa fa-stethoscope'></i></a>
                                <a href='regresaUrg.php?idrecepcion=" . $reg['idrecepcion'] . "' type='button' class='btn btn-warning' title='Regresar a admisión'><i class='fa fa-eraser'></i></a>
                                <a href='noConsultado.php?idrecepcion=" . $reg['idrecepcion'] . "' type='button' class='btn btn-danger' title='No consultado'><i class='fa fa-times'></i></a>
                            </td>
                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha y hora de Reg.</th>
                                        <th>Expediente</th>
                                        <th>Nombre</th>
                                        <th>Fecha nac.</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- FIN TABLA DE PACIENTES A CONSULTAR -->


                    <!-- PACIENTES CON LESIONES -->
                    <h5>Aquí aparecen los pacientes a los que se les realizará hoja de lesiones</h5>
                    <h5 style="color: red;"><strong>Favor de no dejar lesiones sin capturar y especificar en la causa externa cómo fue que ocurrió la lesión, gracias</strong></h5>

                    <div class="card-body">

                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha consulta</th>
                                        <th>Nombre</th>
                                        <th>CURP</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($filalesion = $lesion->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . date("d-m-Y - H:i:s", strtotime($filalesion['fechaingreso'])) . "</td>
                            <td>" . $filalesion['nombre'] . "</td>
                            <td>" . $filalesion['curp'] . "</td>
                            <td>" . $filalesion['edad'] . "</td>
                            <td>" . $filalesion['mtvoconsulta'] . "</td>
                            <td class='btn-group'>
                                <a href='../lesiones/lesiones.php?idc=" . $filalesion['idconsulta'] ."' type='button' class='btn btn-success' title='Hoja de lesiones'><i class='fa fa-file-text'></i></a>

                                <a href='../lesiones/quitarLesion.php?idq=" . $filalesion['idconsulta'] ."' type='button' class='btn btn-dark' title='Quitar lesion'><i class='fa fa-trash'></i></a>
                            </td>
                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha ingreso</th>
                                        <th>Nombre</th>
                                        <th>CURP</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- FIN TABLA DE PACIENTES CON LESIONES -->

                    <br><br>

                    <?php include "../extend/footer.php"; ?>
                </div>
            </div>
        </div>
    </div>

<?php
}

ob_end_flush();
?>