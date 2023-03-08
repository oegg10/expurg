<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Registrar Expediente</h5>
                    </div>

                    <div class="card-body">

                        <form action="insExpediente.php" method="POST" autocomplete="off" onsubmit="return validar();">
                            <div class="row">

                                <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="text" class="form-control" name="nombrep" id="nombrep" autofocus placeholder="Nombre del paciente" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <input type="text" class="form-control" name="curp" id="curp" minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Tipo de paciente (*):</label>
                                    <select class="form-control" name="tipopaciente" id="tipopaciente" required>
                                        <option value="Ninguno" disabled selected>Ninguno</option>
                                        <option value="Sin Identidad">Sin Identidad</option>
                                        <option value="Desconocido">Desconocido</option>
                                        <option value="Extranjero">Extranjero</option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Estado(*):</label>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="DEPURADO">DEPURADO</option>
                                        <option value="DEFUNCION">DEFUNCION</option>
                                        <option value="DEPURADO Y NVO. NUMERO">DEPURADO Y NVO. NUMERO</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>
                                
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p id="mensajeError" style="color: red;"></p>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <?php include "../extend/footer.php"; ?>
            </div>
        </div>
    </div>

    <script src="validaCurp/funcion.js"></script>
    <!-- <script src="validaCurp/validaPaciente.js"></script> -->


    </body>

    </html>

<?php
}

ob_end_flush();
?>