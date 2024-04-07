<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    if (isset($_POST['fechacita'])) {

        $fechacita = $_POST['fechacita'];
        /*======== CONSULTA DE CITAS CON FECHA =====================*/
        $citasFecha = "SELECT m.nombremedico, cn.fechacita, cn.expediente AS expediente, nombrenvo AS nombrepac FROM citascenvo cn INNER JOIN medicos m ON cn.idmedico=m.idmedico WHERE cn.fechacita = '$fechacita' UNION SELECT m.nombremedico, c.fechacita, c.idexpediente AS expediente, e.nombrep AS nombrepac FROM citas_ce c INNER JOIN medicos m ON c.idmedico=m.idmedico INNER JOIN exparchivo e ON c.idexpediente=e.idexpediente WHERE c.fechacita = '$fechacita' ORDER BY nombremedico, fechacita";

        $resultado = $con->query($citasFecha);
        /*=========================================================*/

        $consultasMed = "SELECT m.nombremedico, (SELECT COUNT(pn.idpxnvo) FROM citascenvo pn WHERE pn.idmedico = m.idmedico AND pn.fechacita = '$fechacita') AS total_pacientes_nuevos, (SELECT COUNT(pr.idcita) FROM citas_ce pr WHERE pr.idmedico = m.idmedico AND pr.fechacita = '$fechacita') AS total_pacientes_registrados, (SELECT COUNT(pn.idpxnvo) FROM citascenvo pn WHERE pn.idmedico = m.idmedico AND pn.fechacita = '$fechacita') + (SELECT COUNT(pr.idcita) FROM citas_ce pr WHERE pr.idmedico = m.idmedico AND pr.fechacita = '$fechacita') AS total_pacientes FROM medicos m HAVING total_pacientes_nuevos > 0 OR total_pacientes_registrados > 0";

        $resConsultasMed = $con->query($consultasMed);

    }else {

        /*======== CONSULTA DE CITAS HOY ==========================*/
        $citasFecha = "SELECT m.nombremedico, cn.fechacita, cn.expediente AS expediente, nombrenvo AS nombrepac FROM citascenvo cn INNER JOIN medicos m ON cn.idmedico=m.idmedico WHERE cn.fechacita = CURDATE() UNION SELECT m.nombremedico, c.fechacita, c.idexpediente AS expediente, e.nombrep AS nombrepac FROM citas_ce c INNER JOIN medicos m ON c.idmedico=m.idmedico INNER JOIN exparchivo e ON c.idexpediente=e.idexpediente WHERE c.fechacita = CURDATE() ORDER BY nombremedico, fechacita";

        $resultado = $con->query($citasFecha);
        /*=========================================================*/

        $consultasMed = "SELECT m.nombremedico, (SELECT COUNT(pn.idpxnvo) FROM citascenvo pn WHERE pn.idmedico = m.idmedico AND pn.fechacita = CURDATE()) AS total_pacientes_nuevos, (SELECT COUNT(pr.idcita) FROM citas_ce pr WHERE pr.idmedico = m.idmedico AND pr.fechacita = CURDATE()) AS total_pacientes_registrados, (SELECT COUNT(pn.idpxnvo) FROM citascenvo pn WHERE pn.idmedico = m.idmedico AND pn.fechacita = CURDATE()) + (SELECT COUNT(pr.idcita) FROM citas_ce pr WHERE pr.idmedico = m.idmedico AND pr.fechacita = CURDATE()) AS total_pacientes FROM medicos m HAVING total_pacientes_nuevos > 0 OR total_pacientes_registrados > 0";

        $resConsultasMed = $con->query($consultasMed);
    
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Citas por fecha: <?php if($fechacita == ""){echo " HOY";}else{echo date("d-m-Y", strtotime($fechacita));} ?></h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Fecha cita (*):</label>
                                        <input type="date" class="form-control" name="fechacita" id="fechacita" min="2024-04-01" value="<?php echo $_POST['fechacita']; ?>" required>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                        <button class="btn btn-primary" type="submit"><i class="fa fa-archive"> Recargar con fecha seleccionada</i></button>

                                    </div>

                                </div>
                            </form>
                        
                        <hr>

                        <!-- =============================================================== -->
                        <div class="row">
                            <?php

                            $nombreMedicoActual = null;
                            while ($fila = $resultado->fetch_assoc()) {
                                if ($nombreMedicoActual != $fila['nombremedico']) {
                                    // Si es un médico diferente, cerramos la tabla anterior si existe y comenzamos una nueva
                                    if ($nombreMedicoActual !== null) {
                                        echo "</table></div>";
                                    }
                                    echo "<div class='table-responsive col-lg-6'>
                                    <h5 style='background-color: #ceced3; font-weight: bold;'>Citas " . $fila['nombremedico'] . "</h5>";
                                    echo "<table class='table table-striped table-bordered table-condensed table-hover'>";
                                    echo "<tr>
                                            <th>Expediente</th>
                                            <th>Nombre del Paciente</th>
                                        </tr>";
                                        
                                    $nombreMedicoActual = $fila['nombremedico'];
                                }
                                // Para cada fila, mostramos una nueva línea en la tabla
                                echo "<tr>
                                        <td style='font-size: 20px; font-weight: bold;'>" . $fila['expediente'] . "</td>
                                        <td style='font-size: 20px;'>" . $fila['nombrepac'] . "</td>
                                    </tr>";
                            }

                            if ($nombreMedicoActual !== null) {
                                // Cerramos la última tabla
                                echo "</table></div>";
                            }

                            ?>

                        </div>
                        <br>
                        <hr>
                        <h3>Número de pacientes por médico</h3>
                        <div class="table-responsive">
                            <table id="consultasMed" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #ceced3; color: black;">
                                    <tr>
                                        <th>Médico</th>
                                        <th>Pacientes nuevos</th>
                                        <th>Pacientes registrados</th>
                                        <th>Total pacientes</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($pxnvo = $resConsultasMed->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                            
                                            <td style='font-size: 20px;'>" . $pxnvo['nombremedico'] . "</td>
                                            <td style='font-size: 20px;'>" . $pxnvo['total_pacientes_nuevos'] . "</td>
                                            <td style='font-size: 20px;'>" . $pxnvo['total_pacientes_registrados'] . "</td>
                                            <td style='font-size: 20px;'>" . $pxnvo['total_pacientes'] . "</td>";

                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <p id="totalPacCol" style="font-size: x-large"></p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../extend/footer.php"; ?>

    <script>
        // Obtener la referencia de la tabla
        var tabla = document.getElementById('consultasMed');

        // Obtener todas las celdas de la tercera columna (índice 2)
        var totalPacientes = tabla.getElementsByTagName('td');
        var totalPacCol = 0;

        // Iterar sobre las celdas de la tercera columna y sumar los valores
        for (var i = 3; i < totalPacientes.length; i += 4) {
            // Convertir el contenido de la celda a un número y sumarlo
            totalPacCol += parseInt(totalPacientes[i].textContent);
        }

        // Mostrar el total de la tercera columna
        document.getElementById('totalPacCol').textContent = 'Total de pacientes en este día: ' + totalPacCol;


    </script>

<?php

    $con->close();
}

ob_end_flush();
?>