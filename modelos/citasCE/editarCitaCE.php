<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $idcita = $_GET['idcita'];

    //CONSULTA DE CITA
    $citaSql = "SELECT c.idexpediente, e.nombrep, e.curp, c.idmedico, m.nombremedico, c.fechacita, c.evento, c.observaciones FROM citas_ce c INNER JOIN exparchivo e ON c.idexpediente = e.idexpediente INNER JOIN medicos m ON c.idmedico = m.idmedico INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE c.idcita = '$idcita'";
    $resultCita = $con->query($citaSql);
    $cita = $resultCita->fetch_assoc();

    //Consulta de medicos
    $citaSql = "SELECT m.idmedico, m.nombremedico, m.idservicio, m.diasconsulta, m.condicion, s.nombreservicio FROM medicos m INNER JOIN servicios s ON m.idservicio = s.idservicio WHERE m.condicion = 1 ORDER BY m.nombremedico";
    $resultMedico = $con->query($citaSql);

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $idcita = mysqli_real_escape_string($con, $_POST['idcita']);
        //$idexpediente = mysqli_real_escape_string($con, $_POST['idexpediente']);
        $idmedico = mysqli_real_escape_string($con, $_POST['idmedico']);
        $fechacita = mysqli_real_escape_string($con, $_POST['fechacita']);
        //$evento = mysqli_real_escape_string($con, $_POST['evento']);
        if (isset($_POST["evento"])) {
            $evento = $_POST["evento"];
        }else{
            $evento = "";
        }
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $idusuario = $_SESSION['idusuario'];

        //VALIDACIONES ==========

        $errores = [];

         // Validar expediente
        if (empty($idexpediente)) {
            $errores[] = 'Por favor, ingresa el número de expediente del paciente.';
        }

         // Validar medico
         if (empty($idmedico)) {
            $errores[] = 'Por favor, ingresa el medico.';
        }

         // Validar fecha cita
         if (empty($fechacita)) {
            $errores[] = 'Por favor, ingresa la fecha de la cita.';
        }

        // Validar evento
        if (empty($evento)) {
            $errores[] = 'Por favor, ingresa primera vez o subsecuente.';
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

        }else{

            //Realizamos la modificación de los datos
            $editar = "UPDATE citas_ce SET idmedico='$idmedico',
                            fechacita='$fechacita',
                            evento='$evento',
                            observaciones='$observaciones',
                            idusuario='$idusuario' WHERE idcita = '$idcita'";

            $editado = $con->query($editar);

            if ($editado > 0) {

                header('location:../extend/alerta.php?msj=La cita a sido modificada&c=citasCE&p=in&t=success');
                $con->close();
                $con = null;
            } else {

                header('location:../extend/alerta.php?msj=Error al modificar la cita&c=citasCE&p=in&t=error');
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
                        <h5>Registrar Cita a consulta externa</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" id="formCitaCE" method="POST" autocomplete="off">
                            <div class="row">

                                <!-- DATOS DEL PACIENTE -->
                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>Expediente:</label>
                                    <input type="hidden" name="idcita" value="<?php echo $idcita; ?>">
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $cita['idexpediente']; ?>" readonly name="idexpediente" id="idexpediente">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                    <label>Nombre Paciente:</label>
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $cita['nombrep']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>CURP:</label>
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $cita['curp']; ?>" readonly>
                                </div>

                                <!-- 12 -->
                                <!-- ====== SELECT MEDICOS ====== -->
                                <div class="form-group col-lg-7 col-md-7 col-sm-7">
                                    <label>Nombre del Médico (*):</label>
                                    <select class="select2 form-control" name="idmedico" id="idmedico" required>
                                        <option value="<?php echo $cita['idmedico']; ?>" selected><?php echo $cita['nombremedico']; ?></option>

                                        <?php
                                            
                                            $medicos = array();

                                            while ($fila = $resultMedico->fetch_assoc()) {
                                                $medicos[] = $fila;
                                            }

                                            function convertirDiasANumeros($diasTexto){
                                                $diasMapa = [
                                                    'DOM' => 0,
                                                    'LUN' => 1,
                                                    'MAR' => 2,
                                                    'MIE' => 3,
                                                    'JUE' => 4,
                                                    'VIE' => 5,
                                                    'SAB' => 6,
                                                ];

                                                $diasNumeros = array_map(function ($dia) use ($diasMapa) {
                                                    return $diasMapa[$dia] ?? null;
                                                }, explode(',', $diasTexto));

                                                return implode(',', array_filter($diasNumeros, function ($dia) {
                                                    return $dia !== null;
                                                }));
                                            }

                                            foreach ($medicos as $medico) {
                                                // Conversión de los días laborables del texto a números
                                                $diasLaborablesNumeros = convertirDiasANumeros($medico['diasconsulta']);
                                                echo '<option value="' . $medico['idmedico'] . '" data-dias-laborables="' . $diasLaborablesNumeros . '">' . $medico['nombremedico'] . ' - ' . $medico['nombreservicio'] . '</option>';
                                            }

                                        ?>

                                    </select>
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Fecha cita (*):</label><span id="diasCita" style="color: red;"></span>
                                    <input type="text" class="form-control" name="fechacita" id="fechacita" value="<?php echo $cita['fechacita']; ?>" required>
                                    <span id="citados" style="color: red;"></span>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>Evento (*):</label><br>
                                    <input type="radio" name="evento" value="PRIMERA VEZ" <?php if($cita['evento'] == "PRIMERA VEZ") echo "checked"; ?>> PRIMERA VEZ<br>
                                    <input type="radio" name="evento" value="SUBSECUENTE" <?php if($cita['evento'] == "SUBSECUENTE") echo "checked"; ?>> SUBSECUENTE<br>
                                </div>

                                <div class="form-group col-lg-9 col-md-9 col-sm-9">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" value="<?php echo $cita['observaciones']; ?>" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar" onclick="return validarFormulario()"><i class="fa fa-save"> Guardar</i></button>
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

        $(document).ready(function() {
            //SELECT2
            $('#idmedico').select2({
                allowclear: true,
                language: {
                    noResults: function(){
                        return "No hay resultados";
                    },
                    searching: function(){
                        return "Buscando...";
                    }
                }
            });

            // Inicialización del datepicker
            $('#fechacita').datepicker({
                dateFormat: 'yy-mm-dd', // Formato de día de la semana completo (lunes, martes, etc.)
                minDate: 0, // Evita seleccionar fechas anteriores a hoy
                beforeShowDay: function() {
                    return [false];
                }
            });

            $('#idmedico').change(function() {
                var diasLaborables = $(this).find('option:selected').data('dias-laborables').toString().split(',').map(Number);
                $('#fechacita').datepicker('option', 'beforeShowDay', function(date) {
                    var day = date.getDay();
                    return [diasLaborables.includes(day)];
                });
            });
            // FIN DATEPICKER ====================

            //FECHA CITA =====
            $('#fechacita').on('change', function() {
                let fechacita = $(this).val();
                let idmedico = document.getElementById("idmedico").value;
        
                // Enviar solicitud AJAX al servidor
                $.ajax({
                    url: 'pacientesFechaReg.php', // Ruta al script PHP que realizará la búsqueda en la base de datos
                    method: 'POST',
                    data: { fechacita: fechacita, 
                            idmedico: idmedico 
                          }, // Enviar la fecha y el idMedico seleccionados al servidor
                    success: function(response) {
                        // Actualizar el contenido del elemento con el id "resultadoConteo" con la respuesta del servidor
                        $('#resultadoConteo').html(response);
                    }
                });
            });
            //FIN FECHA CITA =====

        });

        function validarFormulario() {

            let idexpediente = document.getElementById('idexpediente').value;
            let idmedico = document.getElementById('idmedico').value;
            let fechacita = document.getElementById('fechacita').value;
            //let evento = document.getElementById('evento').value;

            let errorMensaje = "";

            if (idexpediente == "") {
                errorMensaje += "Por favor, ingresa el número de expediente.\n";
            }

            if (idmedico == "") {
                errorMensaje += "Por favor, ingresa el medico.\n";
            }

            if (fechacita == "") {
                errorMensaje += "Por favor, ingresa la fecha de la cita.\n";
            }

            /* if (evento == "") {
                errorMensaje += "Por favor, ingresa primera vez o subsecuente.\n";
            } */

            if (errorMensaje !== "") {
                alert(errorMensaje);
                return false;
            } else {
                return true;
            }
        }

    </script>

    </body>

    </html>

<?php
}

ob_end_flush();

?>