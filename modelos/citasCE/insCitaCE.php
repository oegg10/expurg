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
    $citaSql = "SELECT idexpediente, nombrep, curp FROM exparchivo WHERE idexpediente = '$id'";
    $resultado = $con->query($citaSql);
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

        //Conteo de numero de pacientes en la fecha de la cita
        //SELECT COUNT(*) AS pacientes FROM citas_ce WHERE fechacita = "2024-01-15" GROUP BY fechacita
        $npacientes = "SELECT COUNT(*) AS pacientes FROM citas_ce WHERE fechacita = '$fechacita' GROUP BY fechacita";
        $resPacientes = $con->query($npacientes);
        $numeroDePacientes = $resPacientes->fetch_assoc();
        //Variable de pacientes citados en la fecha asignada
        $VpCfA = $numeroDePacientes['pacientes'];

        /*if ($numeroDePacientes == NULL || $numeroDePacientes == "") {
            $VpCfA = 0;
        }else{
            $VpCfA = $numeroDePacientes['pacientes'];
        }*/
        
        //echo 'Número de total de registros: ' . $numeroDePacientes['pacientes'] . '<br>';

        //Consulta de numero de pacientes del medico asignado y servicio
        $medicoid = "SELECT numpacientes FROM medicos WHERE idmedico = '$idmedico'";
        $resMedId = $con->query($medicoid);
        $pacXdia = $resMedId->fetch_assoc();
        //Variable de pacientes que Faltan para cubrir la Fecha
        $VpFcF = $pacXdia['numpacientes'];
        //echo 'Número de pacientes que atiende el medico: ' . $pacXdia['numpacientes'] . '<br>';
        $np = $VpFcF -  $VpCfA;
        //echo $np;

        /*echo $idexpediente . "<br>";
        echo $idmedico . "<br>";
        echo $idservicio . "<br>";
        echo $fechacita . "<br>";
        echo $consultorio . "<br>";
        echo $observaciones . "<br>";*/

        //===================================================================================

        //Realizamos la inserción de los datos en la tabla de medicos
        /*$insSql = "INSERT INTO citas_ce(idexpediente, idmedico, fechacita, consultorio, observaciones, idusuario ) VALUES ('$idexpediente','$idmedico', '$fechacita', '$consultorio','$observaciones', '$idusuario')";

        $insertarCitaCE = $con->query($insSql);*/

        /*if ($insertarCitaCE > 0) {

            header('location:../extend/alerta.php?msj=La cita a sido registrada&c=citasCE&p=in&t=success');
            $con->close();
            $con = null;
        } else {

            header('location:../extend/alerta.php?msj=Error al registrar la cita&c=citasCE&p=in&t=error');
        }

        $con->close();
        $con = null;*/

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
                                    <select class="form-control" name="idmedico" id="idmedico" required>
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

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <button class="btn btn-danger" id="botonConsultar" onclick="citasDisponibles()"><i class="fa fa-save"> Consultar</i></button>
                                </div>
                                

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <span id="diasCita" style="color: red;"></span>
                                    <label>Fecha cita (*):</label>
                                    <input type="date" class="form-control" name="fechacita" id="fechacita" min="2024-01-01">
                                    <span id="citas" style="color: red;"></span>
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

        let formulario = document.getElementById("formCitaCE");

        let idmedico = document.getElementById("idmedico");
        let fechacita = document.getElementById("fechacita");
        let consultorio = document.getElementById("consultorio");

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
                //console.log(fechaC);
                //console.log(fechaA);

            } else {

                document.getElementById("fechacita").style.backgroundColor = "white";
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

        function citasDisponibles() {

            //https://www.youtube.com/watch?v=_0iZ3W2u_Bo
            let medico = idmedico.value;

            $.ajax({
                url: "funcionesMedico/buscarPorMedico.php",
                method: "POST",
                data: { peticion:medico },
            }).done(function(res){
                let result = JSON.parse(res);
                console.log(result);
            });

            //console.log(idmedico.value);
            
        }

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

    </script>

    </body>

    </html>

<?php
}

ob_end_flush();

?>