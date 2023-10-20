<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $idpaciente = $_GET['idp'];
    $idrecepcion = $_GET['idr'];

    $sql = "SELECT r.idrecepcion, r.edad, r.fechahorarecep, r.mtvoconsulta, p.idpaciente, p.expediente, p.nombre AS np, p.curp, p.fechanac, p.entidadnac, p.sexo, p.afiliacion, p.numafiliacion, p.domicilio, p.colonia, p.cp, p.municipio, p.localidad, p.entidaddom, p.telefono, u.nombre AS nu, u.turno, r.embarazo, r.semgesta, r.numgesta, r.medico, r.sala FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE r.idrecepcion = '$idrecepcion' AND p.idpaciente = '$idpaciente'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================================

    $fnac = date('d/m/Y', strtotime($fila['fechanac']));

?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <!--<div class="card text-left">-->
                <!--<div class="card-header">-->
                <div class="row">
                    <div class="col-sm-9">
                        <img src="../../public/img/urgencias.jpg" alt="logo SSC" width="500px">
                    </div>

                    <div class="col-sm-3">
                        <span style="font-size: 10px">Recepción: <small><?php echo $fila['nu']; ?></small></span>
                        <p><span style="font-size: 10px">Turno: <small><?php echo $fila['turno']; ?></small></span></p>
                        <span>Folio:</span>
                    </div>

                    <input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 37%; text-align: center; height: 36px;"><strong> Nombre</strong></td>
                                    <td style="width: 22%; text-align: center; height: 36px;"><strong>CURP</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Fecha Nac.</strong></td>
                                    <td style="width: 23%; text-align: center; height: 36px;"><strong>Entidad Nacimiento</strong></td>
                                    <td style="width: 4%; text-align: center; height: 36px;"><strong>Edad</strong></td>
                                    <td style="width: 4%; text-align: center; height: 36px;"><strong>Sexo</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 18px;">
                                    <td style="width: 37%; padding: 0; height: 18px; font-size: 22px"><strong><?php echo $fila['np']; ?></strong></td>
                                    <td style="width: 22%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><strong><?php echo $fila['curp']; ?></strong></td>
                                    <td style="width: 10%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><?php echo $fnac; ?></td>
                                    <td style="width: 23%; padding: 0; height: 18px; font-size: 22px"><?php echo $fila['entidadnac']; ?></td>
                                    <td style="width: 4%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><?php echo $fila['edad']; ?></td>
                                    <td style="width: 4%; padding: 0; height: 18px; font-size: 22px; text-align:center;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo "F";
                                        } elseif ($fila['sexo'] == 'Masculino') {
                                            echo "M";
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Afiliaci&oacute;n</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>No. Afil.</strong></td>
                                    <td style="width: 40%; text-align: center; height: 36px;"><strong>Calle</strong></td>
                                    <td style="width: 35%; text-align: center; height: 36px;"><strong>Colonia</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>C.P.</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 10%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['afiliacion']; ?></td>
                                    <td style="width: 10%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['numafiliacion']; ?></td>
                                    <td style="width: 40%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['domicilio']; ?></td>
                                    <td style="width: 35%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['colonia']; ?></td>
                                    <td style="width: 5%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['cp']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 21%; text-align: center; height: 36px;"><strong>Entidad Domicilio</strong></td>
                                    <td style="width: 19%; text-align: center; height: 36px;"><strong>Municipio</strong></td>
                                    <td style="width: 29%; text-align: center; height: 36px;"><strong>Localidad</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Tel&eacute;fono</strong></td>
                                    <td style="width: 16%; text-align: center; height: 36px;"><strong>Hora recepci&oacute;n</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Embarazo</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 21%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['entidaddom']; ?></td>
                                    <td style="width: 19%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['municipio']; ?></td>
                                    <td style="width: 29%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['localidad']; ?></td>
                                    <td style="width: 10%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['telefono']; ?></td>
                                    <td style="width: 16%; padding: 0; font-size: 22px; height: 36px;"><strong><?php echo  date("d-m-Y H:i", strtotime($fila['fechahorarecep'])); ?></strong></td>
                                    <td style="width: 5%; padding: 0; font-size: 22px; height: 36px; text-align: center;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR SI ESTA EMBARAZADA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo $fila['embarazo'];
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>SDG</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Gesta</strong></td>
                                    <td style="width: 15%; text-align: center; height: 36px;"><strong>M&eacute;dico</strong></td>
                                    <td style="width: 50%; text-align: center; height: 36px;"><strong>Motivo Consulta</strong></td>
                                    <td style="width: 25%; text-align: center; height: 36px;"><strong>Sala</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 5%; padding: 0; font-size: 22px; height: 36px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR LAS SDG SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['semgesta'];
                                        } else {
                                            echo "";
                                        } ?></td>
                                    <td style="width: 5%; padding: 0; font-size: 22px; height: 36px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR EL NUMERO DE GESTA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['numgesta'];
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td style="width: 15%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['medico']; ?></td>
                                    <td style="width: 50%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['mtvoconsulta']; ?></td>
                                    <td style="width: 25%; padding: 0; font-size: 22px; height: 36px;"><?php echo $fila['sala']; ?></td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!--</div>-->

                <!--</div>-->
                <?php //include "../extend/footer.php"; 
                ?>
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