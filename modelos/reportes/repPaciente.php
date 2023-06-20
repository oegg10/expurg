<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3 && $_SESSION['idrol'] != 6 && $_SESSION['idrol'] != 8) {
        header("Location:../../index.php");
    }

    ini_set("display_errors", 1);

    $id = $_GET['id'];

    $consulta = "SELECT p.idpaciente,p.nombre,p.sexo,r.idrecepcion,r.fechahorarecep,r.edad,r.mtvoconsulta,r.embarazo,r.semgesta,r.referencia,r.observaciones,r.sala,r.condicion FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente WHERE p.idpaciente = '$id' ORDER BY r.fechahorarecep DESC";

    $resultado = $con->query($consulta);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Historial Paciente: </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Motivo consulta</th>
                                    <th>Embarazo</th>
                                    <th>SDG</th>
                                    <th>Referencia</th>
                                    <th>Sala</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($reg['sexo'] == 'Femenino') {

                                            $reg['sexo'] = "F";

                                            if ($reg['embarazo'] == 'NO') {
                                                $reg['semgesta'] = "";
                                            }
                                            
                                        } elseif ($reg['sexo'] == 'Masculino') {

                                            $reg['sexo'] = "M";
                                            $reg['embarazo'] = '';
                                            $reg['semgesta'] = '';
                                        }

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . $reg['embarazo'] . "</td>
                                        <td>" . $reg['semgesta'] . "</td>
                                        <td>" . $reg['referencia'] . "</td>
                                        <td>" . $reg['sala'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>";

                                        if ($reg['condicion'] == 1) {
                                            echo "<td><span class='badge badge-primary text-white'>En sala</span></td>";
                                        }elseif($reg['condicion'] == 2){
                                            echo "<td><span class='badge badge-success text-white'>Consultado</span></td>";
                                        }else{
                                            echo "<td><span class='badge badge-danger text-white'>N.S.P.</span></td>";
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Motivo consulta</th>
                                    <th>Embarazo</th>
                                    <th>SDG</th>
                                    <th>Referencia</th>
                                    <th>Sala</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
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