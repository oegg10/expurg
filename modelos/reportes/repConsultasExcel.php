<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1) {
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
                    <th>Fecha recep.</th>
                    <th>Fecha ingreso.</th>
                    <th>Fecha alta.</th>
                    <th>Tipo Urg.</th>
                    <th>Attn prehosp.</th>
                    <th>Traslado trans</th>
                    <th>Nombre unidad</th>
                    <th>Tiempo traslado</th>
                    <th>Mvo. atencion</th>
                    <th>Tipo cama</th>
                    <th>MP</th>
                    <th>Mujer fertil</th>
                    <th>Afec. principal</th>
                    <th>Comorb1</th>
                    <th>Comorb2</th>
                    <th>Comorb3</th>
                    <th>Intercons1</th>
                    <th>Intercons2</th>
                    <th>Intercons3</th>
                    <th>Preced1</th>
                    <th>Preced2</th>
                    <th>Preced3</th>
                    <th>Preced4</th>
                    <th>Preced5</th>
                    <th>Med1</th>
                    <th>Med2</th>
                    <th>Med3</th>
                    <th>Alta por</th>
                    <th>Otra unidad</th>
                    <th>Mtvo consulta</th>
                    <th>Nombre Paciente</th>
                    <th>Sexo</th>
                    <th>Expediente</th>
                    <th>Edad</th>
                    <th>Curp</th>
                    <th>Fecha nac</th>
                    <th>Ent nac</th>
                    <th>Afiliacion</th>
                    <th>Num afil</th>
                    <th>Domicilio</th>
                    <th>Colonia</th>
                    <th>CP</th>
                    <th>Municipio</th>
                    <th>Localidad</th>
                    <th>Ent Dom</th>
                    <th>Telefono</th>
                    <th>Embarazo</th>
                    <th>Sem gesta</th>
                    <th>Num gesta</th>
                    <th>sala</th>
                    <th>Nombre medico</th>
                    <th>Curp Medico</th>
                    <th>Cedula</th>
                    <th>Turno medico</th>

                </tr>
            </thead>
            <tbody>

                <?php

                header("Content-type: aplication/vnd.ms-excel");
                header("Content-Disposition: attachment;filename=Consultas_Excel-" . $fechai . "-" . $fechaf . ".xls");

                error_reporting(0);

                $consulta = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.fc, c.fr, c.ta, c.temperatura, c.glucosa, c.talla, c.peso, c.pabdominal, c.imc, c.notaingresourg, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.idusuario, p.idpaciente, p.nombre, r.idrecepcion, r.edad, r.fechahorarecep, r.mtvoconsulta, p.expediente, p.curp, p.fechanac, p.entidadnac, p.sexo, p.afiliacion, p.numafiliacion, p.domicilio, p.colonia, p.cp, p.municipio, p.localidad, p.entidaddom, p.telefono, r.embarazo, r.semgesta, r.numgesta, r.sala, r.observaciones, u.nombre AS nm, u.curp AS curpm, u.cedula, u.turno FROM consultas c INNER JOIN recepciones r ON c.idrecepcion = r.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE c.condicion = 1 AND DATE(c.fechaalta) >= '$fechai' AND DATE(c.fechaalta) <= '$fechaf' ORDER BY c.fechaalta ASC";

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
                                        
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaingreso'])) . "</td>
                            <td>" . date("d-m-Y H:i:s", strtotime($reg['fechaalta'])) . "</td>
                            <td>" . $reg['tipourgencia'] . "</td>
                            <td>" . $reg['atnprehosp'] . "</td>
                            <td>" . $reg['trastrans'] . "</td>
                            <td>" . $reg['nombreunidad'] . "</td>
                            <td>" . $reg['tiempotraslado'] . "</td>
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
                            <td>" . $reg['altapor'] . "</td>
                            <td>" . $reg['otraunidad'] . "</td>
                            <td>" . $reg['mtvoconsulta'] . "</td>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['sexo'] . "</td>
                            <td>" . $reg['expediente'] . "</td>
                            <td>" . $reg['edad'] . "</td>
                            <td>" . $reg['curp'] . "</td>
                            <td>" . $reg['fechanac'] . "</td>
                            <td>" . $reg['entidadnac'] . "</td>
                            <td>" . $reg['afiliacion'] . "</td>
                            <td>" . $reg['numafiliacion'] . "</td>
                            <td>" . $reg['domicilio'] . "</td>
                            <td>" . $reg['colonia'] . "</td>
                            <td>" . $reg['cp'] . "</td>
                            <td>" . $reg['municipio'] . "</td>
                            <td>" . $reg['localidad'] . "</td>
                            <td>" . $reg['entidaddom'] . "</td>
                            <td>" . $reg['telefono'] . "</td>
                            <td>" . $reg['embarazo'] . "</td>
                            <td>" . $reg['semgesta'] . "</td>
                            <td>" . $reg['numgesta'] . "</td>
                            <td>" . $reg['sala'] . "</td>
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