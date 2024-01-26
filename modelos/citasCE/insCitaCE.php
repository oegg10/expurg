<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];

    //Consulta de paciente
    $expedienteSql = "SELECT idexpediente, nombrep, curp FROM exparchivo WHERE idexpediente = '$id'";
    $resultado = $con->query($expedienteSql);
    $fila = $resultado->fetch_assoc();

    //Consulta de medicos
    $medicoSql = "SELECT m.idmedico, m.nombremedico, m.idservicio, m.condicion, s.nombreservicio FROM medicos m INNER JOIN servicios s ON m.idservicio = s.idservicio WHERE m.condicion = 1 ORDER BY m.nombremedico";
    $resultMedico = $con->query($medicoSql);

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        //$idexpediente = preg_replace('/\s\s+/', ' ', mysqli_real_escape_string($con, $_POST['idexpediente']));
        $idexpediente = mysqli_real_escape_string($con, $_POST['idexpediente']);
        $idmedico = mysqli_real_escape_string($con, $_POST['idmedico']);
        $fechacita = mysqli_real_escape_string($con, $_POST['fechacita']);
        $consultorio = mysqli_real_escape_string($con, $_POST['consultorio']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $idusuario = $_SESSION['idusuario'];

        //===================================================================================

        //Realizamos la inserción de los datos en la tabla de medicos
        $insSql = "INSERT INTO citas_ce(idexpediente, idmedico, fechacita, consultorio, observaciones, idusuario) VALUES ('$idexpediente','$idmedico', '$fechacita', '$consultorio','$observaciones', '$idusuario')";

        $insertarCitaCE = $con->query($insSql);

        if ($insertarCitaCE > 0) {

            header('location:../extend/alerta.php?msj=La cita a sido registrada&c=citasCE&p=in&t=success');
            $con->close();
            $con = null;
        } else {

            header('location:../extend/alerta.php?msj=Error al registrar la cita&c=citasCE&p=in&t=error');
        }

        $con->close();
        $con = null;

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
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $fila['idexpediente']; ?>" readonly name="idexpediente" id="idexpediente">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                    <label>Nombre Paciente:</label>
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $fila['nombrep']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>CURP:</label>
                                    <input type="text" class="form-control" style="font-weight: bold;" value="<?php echo $fila['curp']; ?>" readonly>
                                </div>

                                <!-- 12 -->
                                <!-- ====== SELECT MEDICOS ====== -->
                                <div class="form-group col-lg-7 col-md-7 col-sm-7">
                                    <label>Nombre del Médico (*):</label>
                                    <select class="form-control" name="idmedico" id="idmedico" onchange="diasConsultaMed()" required>
                                    <option value="" disabled selected>Seleccione Opción</option> 
                                        <?php
                                            while ($medico = $resultMedico->fetch_array(MYSQLI_BOTH)) {
                                                $idmedico = $medico['idmedico'];
                                                $nombremedico = $medico['nombremedico'];
                                                $nombreservicio = $medico['nombreservicio'];

                                        ?>
                                            <option value="<?php echo $idmedico; ?>"><?php echo $nombremedico . " => " . $nombreservicio; ?></option>

                                        <?php
                                            }
                                        ?>
                                        
                                    </select>
                                </div>

                                <!--<div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Fecha cita (*):</label><span id="diasCita" style="color: red;"></span>
                                    <input type="text" class="form-control" name="fechacita" id="fechacita" min="2024-01-01">
                                    <span id="citados" style="color: red;"></span>
                                </div>-->

                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Fecha cita (*):</label><span id="diasCita" style="color: red;"></span>
                                    <input type="date" class="form-control" name="fechacita" id="fechacita" min="2024-01-01">
                                    <span id="citados" style="color: red;"></span>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>Consultorio (*):</label>
                                    <select class="form-control" name="consultorio" id="consultorio" required>
                                        <option value="" disabled selected>Seleccione Opción</option>
                                        <option value="C01">C01</option>
                                        <option value="C02">C02</option>
                                        <option value="C03">C03</option>
                                        <option value="C04">C04</option>
                                        <option value="C05">C05</option>
                                        <option value="C06">C06</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-9 col-md-9 col-sm-9">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
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
        //VARIABLES
        let formulario = document.getElementById("formCitaCE");
        let fechacita = document.getElementById("fechacita");
        let idmedico = document.getElementById("idmedico");
        let consultorio = document.getElementById("consultorio");

        //FUNCIONES
        function diasConsultaMed() {
            $.ajax({
                url: "buscarDiasMedico.php",
                type: "post",
                data: $("#formCitaCE").serialize(),
                success: function(resultado) {
                    $("#diasCita").html(resultado);
                }
            });
        };

        function pacientesRegistrados() {
            $.ajax({
                url: "pacisentesFechaReg.php",
                type: "post",
                data: $("#formCitaCE").serialize(),
                success: function(resultado) {
                    $("#citados").html(resultado);
                }
            });
        };

        fechacita.addEventListener("blur", pacientesRegistrados);
        formulario.addEventListener("blur", rojoValidaFechas, true);

        //VALIDAR FECHA RECEPCION Y FECHA DE INICIO DE LA CONSULTA
        function rojoValidaFechas() {

            //https://www.techiedelight.com/es/find-difference-between-two-dates-javascript/
            // Two date strings
            const fechaA = Date.now();
            const fechaCita = new Date(fechacita.value);

            // Create two Date objects with the dates to compare
            const x = new Date(fechaA);
            const y = new Date(fechaCita);

            // Get the difference in milliseconds
            const diff = x - y;

            // Convert the difference to days
            const days = diff / (1000 * 60 * 60 * 24);

            // Print the result
            //console.log(days + " days");	// 10 days

            if (days > 1) {

                document.getElementById("fechacita").style.backgroundColor = "red";
                document.getElementById("fechacita").focus();
                document.getElementById("btnGuardar").disabled = true;
                //console.log(fechaC);
                //console.log(fechaA);

            } else {

                document.getElementById("fechacita").style.backgroundColor = "white";
                document.getElementById("btnGuardar").disabled = false;
            }

        }

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

        idmedico.addEventListener("blur", validarCamposVacios);
        fechacita.addEventListener("blur", validarCamposVacios);
        consultorio.addEventListener("blur", validarCamposVacios);

        function enviarFormulario() {

            let mensajesError = [];

            if (idmedico.value == null || idmedico.value == "") {
                mensajesError.push("El nombre del médico no debe estar vacío");
            }

            if (fechacita.value == null || fechacita.value == "") {
                mensajesError.push("La fecha de la cita no debe estar vacía");
            }

            if (consultorio.value == null || consultorio.value == "") {
                mensajesError.push("Consultorio no debe estar vacío");
            }

            error.innerHTML = mensajesError.join(", ");

            return false;

        }

        //=========== BLOQUEO DE DIAS PASADOS A LA FECHA ACTUAL =======================
        let fecha = new Date();
        let anio = fecha.getFullYear();
        let dia = fecha.getDate();
        let _mes = fecha.getMonth(); //viene con valores de 0 al 11
        _mes = _mes + 1; //ahora lo tienes de 1 al 12
        let mes;
        if (_mes < 10){ //ahora le agregas un 0 para el formato date
            mes = "0" + _mes;
            } else {
            mes = _mes.toString;
        }

        let fecha_minimo = anio + '-' + mes + '-' + dia; // Nueva variable

        document.getElementById("fechacita").setAttribute('min',fecha_minimo);


        //https://www.forosdelweb.com/f127/desactivar-dias-concretos-con-datepicker-985765/
        /* ============================  DATEPICKER =======================================
        //funcion que bloquea todos lo dias expecto los que queremos habilitar para la seleccion
        function noConsulta(date){
        let day = date.getDay();
        // aqui indicamos el numero correspondiente a los dias que ha de bloquearse (el 0 es Domingo, 1 Lunes, etc...) en el ejemplo bloqueo todos menos los lunes y jueves.
        return [(day != 0 && day != 2 && day != 3 && day != 5 && day != 6), ''];
        };

        //Crear el datepicker
        $("#fechacita").datepicker({
        beforeShowDay: noConsulta,
        });
        ==================================================================================*/

    </script>

    </body>

    </html>

<?php
}

ob_end_flush();

?>