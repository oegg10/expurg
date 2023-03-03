<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location:../../index.php");
    }

    $idc = $_GET['idc'];
    //$idrecepcion = $_GET['idr'];

    //Agregar encabezado
    $sql = "SELECT c.idconsulta, r.idrecepcion, r.edad, r.fechahorarecep, r.mtvoconsulta, p.idpaciente, p.expediente, p.nombre AS np, p.curp, p.fechanac, p.entidadnac, p.sexo, p.afiliacion, p.numafiliacion, p.domicilio, p.colonia, p.cp, p.municipio, p.localidad, p.entidaddom, p.telefono, u.nombre AS nu, u.turno, r.embarazo, r.semgesta, r.numgesta, r.medico, r.sala FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON r.idusuario = u.idusuario INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion WHERE c.idconsulta = '$idc'";

    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //Agregar cuerpo
    $cuerpo = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.idusuario, u.nombre AS nm, u.curp, u.cedula, u.turno FROM consultas c INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE c.idconsulta = '$idc'";

    $result = $con->query($cuerpo);
    $consulta = $result->fetch_assoc();

    //========================================================================================================

    $fnac = date('d/m/Y', strtotime($fila['fechanac']));

?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <!--<div class="card text-left">-->
                <!--<div class="card-header">-->
                <div class="row">
                    <div class="col-sm-7">
                        <img src="../../public/img/urgencias.jpg" alt="logo SSC" width="500px" height="70px">
                    </div>

                    <div class="col-sm-4">
                        <span style="font-size: 10px">Recepción: <small><?php echo $fila['nu']; ?></small></span>
                        <p><span style="font-size: 10px">Turno: <small><?php echo $fila['turno']; ?></small></span></p>
                        <span>Folio:</span>
                    </div>

                    <input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">

                    <div class="table-responsive">

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 40em;"><strong>Nombre</strong></td>
                                    <td style="width: 20em;"><strong>CURP</strong></td>
                                    <td style="width: 15em;"><strong>Fecha Nac.</strong></td>
                                    <td style="width: 25em;"><strong>Entidad Nacimiento</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo $fila['np']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['curp']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fnac; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['entidadnac']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 10em;"><strong>Edad años</strong></td>
                                    <td style="width: 30em;"><strong> < 1 año anotar (horas, días, meses) según corresponda</strong></td>
                                    <td style="width: 10em;"><strong>Sexo</strong></td>
                                    <td style="width: 20em;"><strong>Afiliaci&oacute;n</strong></td>
                                    <td style="width: 20em;"><strong>No. Afil.</strong></td>
                                    <td style="width: 10em;"><strong>Gratuidad</strong></td>

                                </tr>
                                <!--DATOS-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo $fila['edad']; ?></td>
                                    <td></td>
                                    <td style="font-size: 1.3em;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo "F";
                                        } elseif ($fila['sexo'] == 'Masculino') {
                                            echo "M";
                                        }
                                        ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['afiliacion']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['numafiliacion']; ?></td>
                                    <td style="font-size: 1.3em;"></td>

                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 10em;"><strong>Se considera indígena?</strong></td>
                                    <td style="width: 10em;"><strong>Se considera afromexicano?</strong></td>
                                    <td style="width: 30em;"><strong>Entidad Domicilio</strong></td>
                                    <td style="width: 25em;"><strong>Municipio</strong></td>
                                    <td style="width: 25em;"><strong>Localidad</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr>
                                    <td style="font-size: 1.3em;"></td>
                                    <td style="font-size: 1.3em;"></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['entidaddom']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['municipio']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['localidad']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 37em;"><strong>Calle</strong></td>
                                    <td style="width: 27em;"><strong>Colonia</strong></td>
                                    <td style="width: 10em;"><strong>C.P.</strong></td>
                                    <td style="width: 10em;"><strong>Tel&eacute;fono</strong></td>
                                    <!-- <td style="width: 15em;"><strong>Hora recepci&oacute;n</strong></td> -->
                                    <td style="width: 6em;"><strong>Embarazo</strong></td>
                                    <td style="width: 5em;"><strong>SDG</strong></td>
                                    <td style="width: 5em;"><strong>Gesta</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo $fila['domicilio']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['colonia']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $fila['cp']; ?></td>
                                    
                                    <td style="font-size: 1.3em;"><?php echo $fila['telefono']; ?></td>
                                    <!-- <td style="font-size: 1.3em;"><strong><?php echo  date("d-m-Y H:i", strtotime($fila['fechahorarecep'])); ?></strong></td> -->
                                    <td style="font-size: 1.3em;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR SI ESTA EMBARAZADA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo $fila['embarazo'];
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td style="font-size: 1.3em;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR LAS SDG SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['semgesta'];
                                        } else {
                                            echo "";
                                        } ?></td>
                                    <td style="font-size: 1.3em;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR EL NUMERO DE GESTA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['numgesta'];
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    
                                    <td style="width: 20em;"><strong>M&eacute;dico</strong></td>
                                    <td style="width: 60em;"><strong>Motivo Consulta (síntomas otorgados por paciente)</strong></td>
                                    <td style="width: 20em;"><strong>Sala</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr>
                                    
                                    <td style="font-size: 0.9em;"><?php echo $fila['medico']; ?></td>
                                    <td style="font-size: 0.9em;"><?php echo $fila['mtvoconsulta']; ?></td>
                                    <td style="font-size: 0.9em;"><?php echo $fila['sala']; ?></td>

                                </tr>
                            </tbody>
                        </table>
                        <!--<p style="text-align: center; font-size: 15px"><strong>=== DATOS DE LA CONSULTA ===</strong></p> -->

                        <!-- DATOS DE LA CONSULTA -->
                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 15em;"><strong>Att'n prehospitalaria</strong></td>
                                    <td style="width: 15em;"><strong>Tiempo traslado</strong></td>
                                    <td style="width: 15em;"><strong>Tipo de urgencia</strong></td>
                                    <td style="width: 10em;"><strong>Motivo att'n</strong></td>
                                    <td style="width: 10em;"><strong>Tipo de cama</strong></td>
                                    <td style="width: 10em;"><strong>Tras. transitorio</strong></td>
                                    <td style="width: 25em;"><strong>Nombre unidad y CLUES</strong></td>
                                    
                                    
                                    
                                    
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['atnprehosp']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['tiempotraslado']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['tipourgencia']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['motivoatencion']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['tipocama']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['trastrans']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['nombreunidad']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 15em;"><strong>Fecha y hora de recep.</strong></td>
                                    <td style="width: 15em;"><strong>Fecha y hora de ingreso</strong></td>
                                    <td style="width: 15em;"><strong>Fecha y hora de alta</strong></td>
                                    <td style="width: 15em;"><strong>Alta por:</strong></td>
                                    <td style="width: 40em;"><strong>Nombre unidad y CLUES a la que se envía</strong></td>
                                    
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo date("d-m-Y H:i", strtotime($fila['fechahorarecep'])); ?></td>
                                    <td style="font-size: 1.3em;"><strong><?php echo  date("d-m-Y H:i", strtotime($consulta['fechaingreso'])); ?></strong></td>
                                    <td style="font-size: 1.3em;"><strong><?php echo  date("d-m-Y H:i", strtotime($consulta['fechaalta'])); ?></strong></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['altapor']; ?></td>
                                    <!-- <td style="font-size: 1.3em;"><?php echo $consulta['ministeriopublico']; ?></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['mujeredadfertil']; ?></td> -->
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 15em;"><strong>Ministerio pub.</strong></td>
                                    <td style="width: 35em;"><strong>Folio del certificado</strong></td>
                                    <td style="width: 20em;"><strong>Mujer edad fertil</strong></td>
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['ministeriopublico']; ?></td>
                                    <td></td>
                                    <td style="font-size: 1.3em;"><?php echo $consulta['mujeredadfertil']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <p style="text-align: center; font-size: 1em;"><strong>=== AFECCIONES TRATADAS ===</strong></p> -->

                        <!-- Afección principal -->
                        <table class="content-table" border="2">
                            <tbody>
                                <tr class="encabezado">
                                    <td style="width: 80em;"><strong>Afecciones</strong></td>
                                    <td style="width: 20em;"><strong>Clave CIE-10</strong></td>
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr>
                                    <td style="font-size: 1.3em;"><?php echo "PRINCIPAL: " . $consulta['afecprincipal']; ?></td>
                                    <td style="background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad1']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad2']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad3']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                            </tbody>
                        </table>

                        <!--<table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad1']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad2']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['comorbilidad3']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table> -->

                        <!-- <p>=== INTERCONSULTA ===</p> -->

                        <table class="content-table" border="2">
                            <tbody>
                                <tr class="encabezado">
                                    <td colspan="3" style="text-align: center;"><strong>INTERCONSULTAS</strong></td>
                                </tr>

                                <tr>
                                    <td style="width: 27em; font-size: 1.3em;"><?php echo $consulta['interconsulta1']; ?></td>
                                    <td style="width: 25em; font-size: 1.3em;"><?php echo $consulta['interconsulta2']; ?></td>
                                    <td style="width: 25em; font-size: 1.3em;"><?php echo $consulta['interconsulta3']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <p>=== PROCEDIMIENTOS ===</p> -->

                        <table class="content-table" border="2">
                            <tbody>
                                <tr class="encabezado">
                                    <td><strong>PROCEDIMIENTOS</strong></td>
                                    <td><strong>Clave</strong></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim1']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim2']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim3']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim4']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim5']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim2']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim3']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim4']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="content-table" border="2">
                            <tbody>
                                <tr>
                                    <td style="width: 61.5em; font-size: 1.3em;"><?php echo $consulta['procedim5']; ?></td>
                                    <td style="width: 20em; background-color: #f3f1f1;"></td>
                                </tr>
                            </tbody>
                        </table> -->

                        <!--<p>=== MEDICAMENTOS ===</p>-->

                        <table class="content-table" border="2">
                            <tbody>
                                <tr class="encabezado">
                                    <td colspan="3" style="text-align: center;"><strong>MEDICAMENTOS</strong></td>
                                </tr>

                                <tr>
                                    <td style="width: 26em; font-size: 1.3em;"><?php echo $consulta['medicamento1']; ?></td>
                                    <td style="width: 26em; font-size: 1.3em;"><?php echo $consulta['medicamento2']; ?></td>
                                    <td style="width: 25em; font-size: 1.3em;"><?php echo $consulta['medicamento3']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- TABLA DE MEDICO -->
                        <table class="content-table" border="2">
                            <tbody>
                                <tr class="encabezado">
                                    <td colspan="4" style="text-align: center;"><strong>MEDICO RESPONSABLE</strong></td>
                                </tr>
                                <!--DATOS DEL MEDICO-->
                                <tr>
                                    <td style="width: 35em; font-size: 1.1em;"><?php echo "Nombre: " . $consulta['nm']; ?></td>
                                    <td style="width: 20em; font-size: 1.1em;"><?php echo "CURP: " . $consulta['curp']; ?></td>
                                    <td style="width: 15em; font-size: 1.1em;"><?php echo "Cédula: " . $consulta['cedula']; ?></td>
                                    <td style="width: 21em; font-size: 1.1em;"><?php echo "Turno: " . $consulta['turno']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

    </body>

    </html>

<?php
}

$con->close();
ob_end_flush();
?>
