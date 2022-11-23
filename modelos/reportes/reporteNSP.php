<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    /*if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }*/

$recepciones = "SELECT r.idrecepcion, r.idpaciente,p.nombre,p.sexo,r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion, r.idusuario FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 3 ORDER BY r.fechahorarecep DESC";

$resultado = $con->query($recepciones);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    <h5>Pacientes "No se presentó"</h5>
                </div>
                <div class="card-body">

                    <hr>
                    <div class="table-responsive" id="listadoregistros">
                        <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Embarazo</th>
                                    <th>Semanas</th>
                                    <th>Motivo consulta</th>
                                    <th>Observaciones</th>
                                </tr>
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
                            <td>" . $reg['sexo'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['embarazo'] . "</td>
                            <td>" . $reg['semgesta'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['observaciones'] . "</td>
                            </tr>";
                                }
                                ?>

                            </tbody>
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