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

    $sql = "SELECT r.idrecepcion, r.edad, r.fechahorarecep, r.mtvoconsulta, p.idpaciente, p.expediente, p.nombre AS np, p.curp, p.fechanac, p.entidadnac, p.sexo, p.afiliacion, p.numafiliacion, p.domicilio, p.colonia, p.cp, p.municipio, p.localidad, p.entidaddom, p.telefono, u.nombre AS nu, u.turno, r.embarazo, r.semgesta, r.numgesta, r.medico FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON r.idusuario = u.idusuario WHERE r.idrecepcion = '$idrecepcion' AND p.idpaciente = '$idpaciente'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================================

    $fnac = date('d/m/Y', strtotime($fila['fechanac']));

    ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <img src="../../public/img/urgencias.JPG" alt="logo SSC" width="500px">
                            </div>

                            <div class="col-sm-3">
                                <span style="font-size: 10px">Recepción: <small><?php echo $fila['nu']; ?></small></span>
                                <p><span style="font-size: 10px">Turno: <small><?php echo $fila['turno']; ?></small></span></p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body" style="padding-right: 0px;padding-bottom: 0px;padding-top: 0px;padding-left: 0px;">

                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <small>
                                    <strong>Nombre:</strong><input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">
                                    <p style="font-size: 15px;"><u><?php echo $fila['np']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['np']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>CURP:</strong>
                                    <p style="font-size: 18px;"><u><?php echo $fila['curp']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['curp']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Fecha de Nacimiento:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fnac; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo date("d-m-Y H:i:s", strtotime($fila['fechanac'])); ?>" readonly> -->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Entidad de Nacimiento:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['entidadnac']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['entidadnac']; ?>" readonly> -->
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>Edad:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fila['edad']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['edad']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>Sexo:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['sexo']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['sexo']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Afiliación:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['afiliacion']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['afiliacion']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Num. afiliación:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['numafiliacion']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['numafiliacion']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Nombre de la vialidad:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['domicilio']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['domicilio']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Colonia:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['colonia']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['colonia']; ?>" readonly>-->
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Código Postal:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['cp']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['cp']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Localidad:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['localidad']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['localidad']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Municipio o Delegación:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['municipio']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['municipio']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <small>
                                    <strong>Entidad federativa:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['entidaddom']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['entidaddom']; ?>" readonly>-->
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Teléfono:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['telefono']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['telefono']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Hora recepción:</strong>
                                    <p style="font-size: 10px;"><u><?php echo  date("d-m-Y H:i:s", strtotime($fila['fechahorarecep'])); ?></u></p>
                                </small>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Embarazo:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fila['embarazo']; ?></u></p>
                                </small>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>SDG:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fila['semgesta']; ?></u></p>
                                </small>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>Gesta:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fila['numgesta']; ?></u></p>
                                </small>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Médico:</strong>
                                    <p style="font-size: 10px;"><u><?php echo $fila['medico']; ?></u></p>
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <small>
                                    <strong>Motivo de la consulta:</strong>
                                    <p style="font-size: 15px;"><u><?php echo $fila['mtvoconsulta']; ?></u></p>
                                </small>
                            </div>

                            <!-- FIN -->

                        </div>

                    </div>
                </div>
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