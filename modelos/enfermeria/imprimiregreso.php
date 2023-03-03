<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 6) {
        header("Location:../../index.php");
    }

    $idpaciente = $_GET['idp'];

    $sql = "SELECT idpaciente, expediente, nombre, curp, fechanac, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, entidadnac, sexo, edocivil, afiliacion, numafiliacion, domicilio, colonia, cp, municipio, localidad, entidaddom, telefono, fechaalta FROM pacientes WHERE idpaciente = '$idpaciente'";
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
                            <div class="col-sm-10">
                                <img src="../../public/img/egresos.jpg" alt="logo SSC" width="650px">
                            </div>
                            <div class="col-sm-2">
                                <p>
                                    <h4>FOLIO: </h4>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <small>
                                    <strong>Nombre:</strong><input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">
                                    <p><u><?php echo $fila['nombre']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['nombre']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>CURP:</strong>
                                    <p><u><?php echo $fila['curp']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['curp']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Fecha de Nacimiento:</strong>
                                    <p><u><?php echo $fnac; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['fechanac']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Entidad de Nacimiento:</strong>
                                    <p><u><?php echo $fila['entidadnac']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['entidadnac']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>Edad:</strong>
                                    <p><u><?php echo $fila['edad']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['edad']; ?>" readonly>-->
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <small>
                                    <strong>Sexo:</strong>
                                    <p><u><?php echo $fila['sexo']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['sexo']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Peso y Talla:</strong>
                                    <p>P:_______________ T:_______________</p>
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Estado Conyugal:</strong>
                                    <p><u><?php echo $fila['edocivil']; ?></u></p>
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Afiliación:</strong>
                                    <p><u><?php echo $fila['afiliacion']; ?></u></p>
                                    <!-- <input type="text" class="form-control form-control-sm" value="<?php echo $fila['afiliacion']; ?>" readonly> -->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Num. afiliación:</strong>
                                    <p><u><?php echo $fila['numafiliacion']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['numafiliacion']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Gratuidad:</strong>
                                    <p>SI__________ NO__________</p>
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="../../public/img/indigena.jpg" alt="imagen" width="1250px" height="35px">
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Nombre de la vialidad:</strong>
                                    <p><u><?php echo $fila['domicilio']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['domicilio']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <small>
                                    <strong>Colonia:</strong>
                                    <p><u><?php echo $fila['colonia']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['colonia']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Código Postal:</strong>
                                    <p><u><?php echo $fila['cp']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['cp']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Localidad:</strong>
                                    <p><u><?php echo $fila['localidad']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['localidad']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Municipio o Delegación:</strong>
                                    <p><u><?php echo $fila['municipio']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['municipio']; ?>" readonly>-->
                                </small>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <small>
                                    <strong>Entidad federativa:</strong>
                                    <p><u><?php echo $fila['entidaddom']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['entidaddom']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Teléfono:</strong>
                                    <p><u><?php echo $fila['telefono']; ?></u></p>
                                    <!--<input type="text" class="form-control form-control-sm" value="<?php echo $fila['telefono']; ?>" readonly>-->
                                </small>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <small>
                                    <strong>Expediente:</strong>
                                    <p><u><?php echo $fila['expediente']; ?></u></p>
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

<?php
}

ob_end_flush();
?>