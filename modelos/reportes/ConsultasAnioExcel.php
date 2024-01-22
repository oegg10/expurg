<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 9) {
        header("Location: ../../index.php");
    }

    $idusuario = $_SESSION['idusuario'];

    if (isset($_GET['anioConsultas'])) {

        $anio = $_GET["anioConsultas"];
    }

?>

    <div class="container">

        <table border="1">
            <thead>
                <tr>
                    <th>Fecha ingreso</th>
                    <th>Fecha alta</th>
                    <th>Alta por</th>
                    <th>Nombre Paciente</th>
                    <th>Expediente</th>
                    <th>Edad</th>
                    <th>Nota urg</th>
                    <th>Tipo Urg</th>
                    <th>Att pre hosp</th>
                    <th>Mtvo Aton</th>
                    <th>Tipo cama</th>
                    <th>Ministerio pub</th>
                    <th>Mujer edad fertil</th>
                    <th>Afeccion Ppal</th>
                    <th>Comorb1</th>
                    <th>Comorb2</th>
                    <th>Comorb3</th>
                    <th>interconsulta1</th>
                    <th>interconsulta2</th>
                    <th>interconsulta3</th>
                    <th>procedim1</th>
                    <th>procedim2</th>
                    <th>procedim3</th>
                    <th>procedim4</th>
                    <th>procedim5</th>
                    <th>medicamento1c</th>
                    <th>medicamento2</th>
                    <th>medicamento3</th>
                    <th>otraunidad</th>
                    <th>lesion_es</th>
                    <th>lesiones</th>
                    <th>Medico</th>
                </tr>
            </thead>
            <tbody>

                <?php

                header("Content-type: aplication/vnd.ms-excel");
                header("Content-Disposition: attachment;filename=consultasAnio_" . $anio . ".xls");

                error_reporting(0);

                $consultasAnio = "SELECT p.nombre, p.expediente, r.edad, c.fechaingreso, c.notaingresourg, c.tipourgencia, c.atnprehosp, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.lesion_es, c.lesiones, u.nombre AS medico FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE YEAR(c.fechaingreso) = '$anio' AND c.condicion = 1  ORDER BY c.fechaingreso DESC";

                $resultado = $con->query($consultasAnio);


                while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                    echo "<tr>

                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaingreso'])) . "</td>
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaalta'])) . "</td>
                            <td>" . $reg['altapor'] . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['expediente'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['notaingresourg'] . "</td>
                            <td>" . $reg['tipourgencia'] . "</td>
                            <td>" . $reg['atnprehosp'] . "</td>
                            <td>" . $reg['motivoatencion'] . "</td>
                            <td>" . $reg['tipocama'] . "</td>
                            <td>" . $reg['ministeriopublico'] . "</td>
                            <td>" . $reg['mujeredadfertil'] . "</td>
                            <td>" . $reg['afecprincipal'] . "</td>
                            <td>" . $reg['comorbilidad1'] . "</td>
                            <td>" . $reg['comorbilidad2'] . "</td>
                            <td>" . $reg['comorbilidad3'] . "</td>
                            <td>" . $reg['interconsulta1'] . "</td>
                            <td>" . $reg['interconsulta2'] . "</td>
                            <td>" . $reg['interconsulta3'] . "</td>
                            <td>" . $reg['procedim1'] . "</td>
                            <td>" . $reg['procedim2'] . "</td>
                            <td>" . $reg['procedim3'] . "</td>
                            <td>" . $reg['procedim4'] . "</td>
                            <td>" . $reg['procedim5'] . "</td>
                            <td>" . $reg['medicamento1'] . "</td>
                            <td>" . $reg['medicamento2'] . "</td>
                            <td>" . $reg['medicamento3'] . "</td>
                            <td>" . $reg['otraunidad'] . "</td>
                            <td>" . $reg['lesion_es'] . "</td>
                            <td>" . $reg['lesiones'] . "</td>
                            <td>" . $reg['medico'] . "</td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>


    <?php include "../extend/footer.php"; ?>

    </body>

    </html>

<?php
}

$resultado = null;
$con->close();
ob_end_flush();

?>
