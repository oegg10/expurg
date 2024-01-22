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

    if (isset($_GET['anioLesiones'])) {

        $anio = $_GET["anioLesiones"];
    }

?>

    <div class="container">

        <table border="1">
            <thead>
                <tr>
                    <th>Fecha consulta</th>
                    <th>Fecha ocurrencia</th>
                    <th>Nombre Paciente</th>
                    <th>Expediente</th>
                    <th>Edad</th>
                    <th>Escolaridad</th>
                    <th>Lee</th>
                    <th>Discapacidad</th>
                    <th>Referido por</th>
                    <th>Unidad</th>
                    <th>Dia festivo</th>
                    <th>Sitio ocurrencia</th>
                    <th>Sitio ocurrencia otro</th>
                    <th>Entidad</th>
                    <th>Municipio</th>
                    <th>Localidad</th>
                    <th>Intensionalidad</th>
                    <th>Agente lesion</th>
                    <th>Agente otro</th>
                    <th>Bajo efectos</th>
                    <th>Bajo efectos otro</th>
                    <th>Lesionado accidente</th>
                    <th>Uso equipo</th>
                    <th>Equipo de seguridad</th>
                    <th>Otro equipo</th>
                    <th>Tipo de violencia</th>
                    <th>Num agresores</th>
                    <th>Parentesco</th>
                    <th>Sexo agresor</th>
                    <th>Edad agresor</th>
                    <th>Bajo efectos agresor</th>
                    <th>Autoinflingido</th>
                    <th>Servicio</th>
                    <th>Otro servicio</th>
                    <th>Tipo atencion</th>
                    <th>Otro tipo de atencion</th>
                    <th>Area anatomica</th>
                    <th>Mayor gravedad</th>
                    <th>Causa externa</th>
                    <th>MP</th>
                    <th>Afeccion principal</th>
                    <th>Comorbilidad1</th>
                    <th>comorbilidad2</th>
                    <th>comorbilidad3</th>
                    <th>Alta por</th>
                    <th>Otra unidad</th>
                    <th>Medico</th>
                </tr>
            </thead>
            <tbody>

                <?php

                header("Content-type: aplication/vnd.ms-excel");
                header("Content-Disposition: attachment;filename=lesionesAnio_" . $anio . ".xls");

                error_reporting(0);

                $lesionesAnio = "SELECT c.fechaingreso, l.fecha_ocurrencia, p.nombre, p.expediente, r.edad, l.escolaridad, l.leerescribir, l.discapacidad, l.referidopor, l.nombre_unidad, l.diafestivo, l.sitio_ocurrencia, l.sitio_ocurrencia_otro, l.lesion_entidad, l.lesion_municipio, l.lesion_localidad, l.intensionalidad, l.agente_lesion, l.agente_otro, l.toxicomanias, l.otras_toxicomanias, l.lesionad_es, l.equipo_seguridad, l.que_eq_seguridad, l.otro_eq_seguridad, l.tipo_violencia, l.num_agresores, l.parentesco_afectado, l.sexo_agresor, l.edad_agresor, l.bajoefectos_agresor, l.evento_autoinflingido, l.servicio, l.otro_servicio, l.tipoatencion, l.otro_tipoatencion, l.areaanatomica, l.consec_resultante, l.causaexterna, l.idusuario, c.ministeriopublico, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.altapor, c.otraunidad, l.condicion, u.nombre AS medico FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN lesiones l ON l.idconsulta = c.idconsulta INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE YEAR(c.fechaingreso) = '$anio' AND c.condicion = 1  ORDER BY c.fechaingreso DESC";

                $resultado = $con->query($lesionesAnio);


                while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                    echo "<tr>

                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaingreso'])) . "</td>
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fecha_ocurrencia'])) . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['expediente'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['escolaridad'] . "</td>
                            <td>" . $reg['leerescribir'] . "</td>
                            <td>" . $reg['discapacidad'] . "</td>
                            <td>" . $reg['referidopor'] . "</td>
                            <td>" . $reg['nombre_unidad'] . "</td>
                            <td>" . $reg['diafestivo'] . "</td>
                            <td>" . $reg['sitio_ocurrencia'] . "</td>
                            <td>" . $reg['sitio_ocurrencia_otro'] . "</td>
                            <td>" . $reg['lesion_entidad'] . "</td>
                            <td>" . $reg['lesion_municipio'] . "</td>
                            <td>" . $reg['lesion_localidad'] . "</td>
                            <td>" . $reg['intensionalidad'] . "</td>
                            <td>" . $reg['agente_lesion'] . "</td>
                            <td>" . $reg['agente_otro'] . "</td>
                            <td>" . $reg['toxicomanias'] . "</td>
                            <td>" . $reg['otras_toxicomanias'] . "</td>
                            <td>" . $reg['lesionad_es'] . "</td>
                            <td>" . $reg['equipo_seguridad'] . "</td>
                            <td>" . $reg['que_eq_seguridad'] . "</td>
                            <td>" . $reg['otro_eq_seguridad'] . "</td>
                            <td>" . $reg['tipo_violencia'] . "</td>
                            <td>" . $reg['num_agresores'] . "</td>
                            <td>" . $reg['parentesco_afectado'] . "</td>
                            <td>" . $reg['sexo_agresor'] . "</td>
                            <td>" . $reg['edad_agresor'] . "</td>
                            <td>" . $reg['bajoefectos_agresor'] . "</td>
                            <td>" . $reg['evento_autoinflingido'] . "</td>
                            <td>" . $reg['servicio'] . "</td>
                            <td>" . $reg['otro_servicio'] . "</td>
                            <td>" . $reg['tipoatencion'] . "</td>
                            <td>" . $reg['otro_tipoatencion'] . "</td>
                            <td>" . $reg['areaanatomica'] . "</td>
                            <td>" . $reg['consec_resultante'] . "</td>
                            <td>" . $reg['causaexterna'] . "</td>
                            <td>" . $reg['ministeriopublico'] . "</td>
                            <td>" . $reg['afecprincipal'] . "</td>
                            <td>" . $reg['comorbilidad1'] . "</td>
                            <td>" . $reg['comorbilidad2'] . "</td>
                            <td>" . $reg['comorbilidad3'] . "</td>
                            <td>" . $reg['altapor'] . "</td>
                            <td>" . $reg['otraunidad'] . "</td>
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
