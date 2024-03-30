<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    //Consulta de servicios
    $servicioSql = "SELECT idservicio, nombreservicio FROM servicios WHERE condicion = 1 ORDER BY nombreservicio";
    $resultServicio = $con->query($servicioSql);

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $nombremedico = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['nombremedico']));
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $cedula = mysqli_real_escape_string($con, $_POST['cedula']);
        $idservicio = mysqli_real_escape_string($con, $_POST['idservicio']);
        $diasconsulta = implode(",", $_POST['diasconsulta']);
        $numpacientes = mysqli_real_escape_string($con, $_POST['numpacientes']);

        //===================================================================================
        //VALIDACIONES ==========

        $errores = [];

         // Validar nombre medico
        if (empty($nombremedico)) {
            $errores[] = 'Por favor, introduce el nombre del médico.';
        }

         // Validar curp medico
         if (empty($curp)) {
            $errores[] = 'Por favor, introduce la curp del médico.';
        }

         // Validar cedula medico
         if (empty($cedula)) {
            $errores[] = 'Por favor, introduce la cédula del médico.';
        }

        // Validar servicio
        if (empty($idservicio)) {
            $errores[] = 'Por favor, introduce el servicio.';
        }

        // Validar dias consulta
        if (empty($diasconsulta)) {
            $errores[] = 'Por favor, introduce los días de consulta.';
        }

        // Validar número de pacientes
        if (empty($numpacientes)) {
            $errores[] = 'Por favor, introduce el número de pacientes.';
        }

        /*============= FIN DE VALIDACIONES ========================================*/

        // Mostrar errores si los hay
        if (!empty($errores)) {
            echo '<h2 style="color: red;">Errores:</h2>';
            echo '<ul>';
            foreach ($errores as $error) {
                echo '<li style="color: red;">' . $error . '</li>';
            }
            echo '</ul>';

        } else {

            //Realizamos la inserción de los datos en la tabla de medicos
            $insSql = "INSERT INTO medicos(nombremedico, curp, cedula, diasconsulta, numpacientes, condicion) VALUES ('$nombremedico','$curp','$cedula', '$idservicio', '$diasconsulta', '$numpacientes', '1')";

            $resultado = $con->query($insSql);

            //===================================================================================
            //MENSAJES DESBLOQUEAR AQUI==========================================================

            if ($resultado > 0) {

                header('location:../extend/alerta.php?msj=EL Medico a sido registrado&c=medicos&p=in&t=success');
                $con->close();
                $con = null;
            } else {

                header('location:../extend/alerta.php?msj=Error al registrar al Medico&c=medicos&p=in&t=error');
            }

            $con->close();
            $con = null;

        }

    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Registrar Médico</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre del médico(*):</label>
                                    <input type="text" class="form-control" name="nombremedico" id="nombremedico" autofocus placeholder="Nombre del médico" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <input type="text" class="form-control" name="curp" id="curp" minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Cédula(*):</label>
                                    <input type="text" class="form-control" name="cedula" id="cedula" maxlength="20" placeholder="Cédula" required>
                                </div>

                                <!-- 12 -->

                                <!-- ====== SELECT SERVICIOS ====== -->
                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Servicio (*):</label>
                                    <select class="form-control" name="idservicio" id="idservicio" required>
                                    <option value="" disabled selected>Seleccione Opción</option>
                                        <?php
                                            while ($servicio = $resultServicio->fetch_array(MYSQLI_BOTH)) {
                                                $idservicio = $servicio['idservicio'];
                                                $nombreservicio = $servicio['nombreservicio'];

                                        ?>
                                            <option value="<?php echo $idservicio; ?>"><?php echo $nombreservicio; ?></option>

                                        <?php
                                            }
                                        ?>
                                        
                                    </select>
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label for="diasconsulta">Días de consulta (*)</label><br>
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="LUN"> Lunes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="MAR"> Martes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="MIE"> Miercoles
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="JUE"> Jueves
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="VIE"> Viernes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="SAB"> Sábado
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="DOM"> Domingo
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="DFE"> Días festivos
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Num. pacientes(*):</label>
                                    <input type="number" class="form-control" name="numpacientes" id="numpacientes" min="1" max="20" required>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" onclick="validarFormulario()" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div id="error" style="color: red;"></div>

                </div>
                <?php include "../extend/footer.php"; ?>
            </div>
        </div>
    </div>

    <script>

        let nombremedico = document.getElementById("nombremedico");
        let curp = document.getElementById("curp");
        let cedula = document.getElementById("cedula");
        let idservicio = document.getElementById("idservicio");
        let numpacientes = document.getElementById("numpacientes");

        //VALIDACION CAMPOS VACIOS
        const validarCamposVacios = (e) => {

            let campo = e.target;
            let valorcampo = e.target.value;

            if (valorcampo.trim().length == 0) {
                campo.classList.add("invalido");
                campo.nextElementSibling.classList.add("errorSpan");
                campo.nextElementSibling.innerText = "Este campo es requerido";
            } else {
                campo.classList.add("valido");
                campo.nextElementSibling.classList.remove("errorSpan");
                campo.nextElementSibling.innerText = "";
            }

        }

        nombremedico.addEventListener("blur", validarCamposVacios);
        curp.addEventListener("blur", validarCamposVacios);
        cedula.addEventListener("blur", validarCamposVacios);
        idservicio.addEventListener("blur", validarCamposVacios);
        numpacientes.addEventListener("blur", validarCamposVacios);

        function validarFormulario() {

            let errorMensaje = "";

            if (nombremedico.value == "") {
                errorMensaje += "Por favor, ingresa el nombre del medico.\n";
            }

            if (curp.value == "") {
                errorMensaje += "Por favor, ingresa la curp del medico.\n";
            }

            if (cedula.value == "") {
                errorMensaje += "Por favor, ingresa la cédula del medico.\n";
            }

            if (idservicio.value == "") {
                errorMensaje += "Por favor, ingresa el servicio.\n";
            }

            if (numpacientes.value == "" || numpacientes.value > 20) {
                errorMensaje += "Por favor, ingresa correctamente el número de pacientes.\n";
            }

            if (errorMensaje !== "") {
                alert(errorMensaje);
                return false;
            } else {
                return true;
            }
        }

    </script>

    <script src="validaCurp/funcion.js"></script>


    </body>

    </html>

<?php
}

ob_end_flush();
?>