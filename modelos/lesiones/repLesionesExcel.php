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

    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];
    }

?>

    <div class="container">

        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>CURP</th>
                    <th>Fechanac</th>
                    <th>Entidadnac</th>
                    <th>Escolaridad</th>
                    <th>Leerescribir</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Afiliacion</th>
                    <th>Numafiliacion</th>
                    <th>Mujeredadfertil</th>
                    <th>Embarazo</th>
                    <th>Semgesta</th>
                    <th>Numgesta</th>
                    <th>Discapacidad</th>
                    <th>Referidopor</th>
                    <th>nombre_unidad</th>
                    <th>Fechaocurrencia</th>
                    <th>diafestivo</th>
                    <th>sitio_ocurrencia</th>
                    <th>sitio_ocurrencia_otro</th>
                    <th>lesion_entidad</th>
                    <th>lesion_municipio</th>
                    <th>lesion_localidad</th>
                    <th>lesion_cp</th>
                    <th>lesion_domicilio</th>
                    <th>lesion_colonia</th>
                    <th>intensionalidad</th>
                    <th>agente_lesion</th>
                    <th>agente_otro</th>
                    <th>atnprehosp</th>
                    <th>tiempotraslado</th>
                    <th>toxicomanias</th>
                    <th>otras_toxicomanias</th>
                    <th>lesionad_es</th>
                    <th>equipo_seguridad</th>
                    <th>que_eq_seguridad</th>
                    <th>otro_eq_seguridad</th>
                    <th>tipo_violencia</th>
                    <th>num_agresores</th>
                    <th>parentesco_afectado</th>
                    <th>sexo_agresor</th>
                    <th>edad_agresor</th>
                    <th>bajoefectos_agresor</th>
                    <th>evento_autoinflingido</th>
                    <th>fechaingreso</th>
                    <th>servicio</th>
                    <th>otro_servicio</th>
                    <th>tipoatencion</th>
                    <th>otro_tipoatencion</th>
                    <th>areaanatomica</th>
                    <th>consec_resultante</th>
                    <th>afecprincipal</th>
                    <th>comorbilidad1</th>
                    <th>comorbilidad2</th>
                    <th>comorbilidad3</th>
                    <th>causaexterna</th>
                    <th>ministeriopublico</th>
                    <th>altapor</th>
                    <th>nombremedico</th>
                    <th>curpmedico</th>
                    <th>cedulamedico</th>
                    <th>turnomedico</th>

                </tr>
            </thead>
            <tbody>

                <?php

                header("Content-type: aplication/vnd.ms-excel");
                header("Content-Disposition: attachment;filename=Lesiones_Excel-" . $fechai . "-" . $fechaf . ".xls");

                error_reporting(0);

                $consulta = "SELECT p.idpaciente, p.nombre, p.curp, p.fechanac, p.entidadnac, l.escolaridad, l.leerescribir, r.edad, p.sexo, p.afiliacion, p.numafiliacion, c.mujeredadfertil, r.embarazo, r.semgesta, r.numgesta, l.discapacidad, l.referidopor, l.nombre_unidad, l.fecha_ocurrencia, l.diafestivo, l.sitio_ocurrencia, l.sitio_ocurrencia_otro, l.lesion_entidad, l.lesion_municipio, l.lesion_localidad, l.lesion_cp, l.lesion_domicilio, l.lesion_colonia, l.intensionalidad, l.agente_lesion, l.agente_otro, c.atnprehosp, c.tiempotraslado, l.toxicomanias, l.otras_toxicomanias, l.lesionad_es, l.equipo_seguridad, l.que_eq_seguridad, l.otro_eq_seguridad, l.tipo_violencia, l.num_agresores, l.parentesco_afectado, l.sexo_agresor, l.edad_agresor, l.bajoefectos_agresor, l.evento_autoinflingido, c.fechaingreso, l.servicio, l.otro_servicio, l.tipoatencion, l.otro_tipoatencion, l.areaanatomica, l.consec_resultante, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, l.causaexterna, c.ministeriopublico, c.altapor, u.nombre AS nm, u.curp AS curpm, u.cedula, u.turno FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON c.idusuario = u.idusuario INNER JOIN lesiones l ON l.idconsulta = c.idconsulta WHERE DATE(c.fechaalta) >= '$fechai' AND DATE(c.fechaalta) <= '$fechaf' ORDER BY c.fechaalta ASC";

                $resultado = $con->query($consulta);


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
                                  
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['curp'] . "</td>
                            <td>" . date("d-m-Y", strtotime($reg['fechanac'])) . "</td>
                            <td>" . $reg['entidadnac'] . "</td>
                            <td>" . $reg['escolaridad'] . "</td>
                            <td>" . $reg['leerescribir'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['sexo'] . "</td>
                            <td>" . $reg['afiliacion'] . "</td>
                            <td>" . $reg['numafiliacion'] . "</td>
                            <td>" . $reg['mujeredadfertil'] . "</td>
                            <td>" . $reg['embarazo'] . "</td>
                            <td>" . $reg['semgesta'] . "</td>
                            <td>" . $reg['numgesta'] . "</td>
                            <td>" . $reg['discapacidad'] . "</td>
                            <td>" . $reg['referidopor'] . "</td>
                            <td>" . $reg['nombre_unidad'] . "</td>
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fecha_ocurrencia'])) . "</td>
                            <td>" . $reg['diafestivo'] . "</td>
                            <td>" . $reg['sitio_ocurrencia'] . "</td>
                            <td>" . $reg['sitio_ocurrencia_otro'] . "</td>
                            <td>" . $reg['lesion_entidad'] . "</td>
                            <td>" . $reg['lesion_municipio'] . "</td>
                            <td>" . $reg['lesion_localidad'] . "</td>
                            <td>" . $reg['lesion_cp'] . "</td>
                            <td>" . $reg['lesion_domicilio'] . "</td>
                            <td>" . $reg['lesion_colonia'] . "</td>
                            <td>" . $reg['intensionalidad'] . "</td>
                            <td>" . $reg['agente_lesion'] . "</td>
                            <td>" . $reg['agente_otro'] . "</td>
                            <td>" . $reg['atnprehosp'] . "</td>
                            <td>" . $reg['tiempotraslado'] . "</td>
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
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaingreso'])) . "</td>
                            <td>" . $reg['servicio'] . "</td>
                            <td>" . $reg['otro_servicio'] . "</td>
                            <td>" . $reg['tipoatencion'] . "</td>
                            <td>" . $reg['otro_tipoatencion'] . "</td>
                            <td>" . $reg['areaanatomica'] . "</td>
                            <td>" . $reg['consec_resultante'] . "</td>
                            <td>" . $reg['afecprincipal'] . "</td>
                            <td>" . $reg['comorbilidad1'] . "</td>
                            <td>" . $reg['comorbilidad2'] . "</td>
                            <td>" . $reg['comorbilidad3'] . "</td>
                            <td>" . $reg['causaexterna'] . "</td>
                            <td>" . $reg['ministeriopublico'] . "</td>
                            <td>" . $reg['altapor'] . "</td>
                            <td>" . $reg['nm'] . "</td>
                            <td>" . $reg['curpm'] . "</td>
                            <td>" . $reg['cedula'] . "</td>
                            <td>" . $reg['turno'] . "</td>
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