<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];

    $sql = "SELECT idpaciente,nombre,DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad,sexo FROM pacientes WHERE idpaciente = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //======================================================================================
    $idusuario = $_SESSION['idusuario'];

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Recepción a Consulta</h5>
                    </div>
                    <div class="card-body">
                        <form action="ins_recepcion.php" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idpaciente" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>" readonly name="edad" id="edad">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Motivo de la consulta (*):</label>
                                    <input type="text" class="form-control" name="mtvoconsulta" id="mtvoconsulta" maxlength="100" placeholder="Motivo de la consulta" required autofocus onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->
                                <?php
                                if ($fila['sexo'] == "Femenino") {
                                    echo "
                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Embarazo (*):</label>
                                        <select class='form-control' name='embarazo' id='embarazo' onchange='habilitarGesta(this.value);' required>
                                            <option value='' disabled selected>Embarazo</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                        </select>
                                    </div>";

                                    echo "
                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Semanas de Gestación:</label>
                                        <input type='text' class='form-control' name='semgesta' id='semgesta' disabled maxlength='2' placeholder='Semanas gesta' pattern='[0-9]{1,2}'>
                                    </div>";

                                    echo "
                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>No. de Gestación:</label>
                                        <input type='text' class='form-control' name='numgesta' id='numgesta' disabled maxlength='2' placeholder='Semanas gesta' pattern='[0-9]{1}'>
                                    </div>";
                                }

                                ?>
                                
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Sala (*):</label>
                                    <select class="form-control" name="sala" id="sala" required>
                                        <option value="" disabled selected>Sala</option>
                                        <option value="CONSULTA GENERAL DE URGENCIAS">CONSULTA GENERAL DE URGENCIAS</option>
                                        <option value="GINECOLOGIA">GINECOLOGIA</option>
                                        <option value="URGENCIAS | ENCAMADOS">URGENCIAS | ENCAMADOS</option>
                                        <option value="CONTROL TERMICO">CONTROL TERMICO</option>
                                        <option value="CLINICA DE HERIDAS">CLINICA DE HERIDAS</option>
                                        <option value="TRIAGE">TRIAGE</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Médico(*):</label>
                                    <input type="text" class="form-control" name="medico" id="medico" maxlength="80" placeholder="Médico" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Referencia:</label>
                                    <input type="text" class="form-control" name="referencia" id="referencia" maxlength="200" placeholder="Referencia" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <p>PREGUNTARLE AL PACIENTE SI ES LA PRIMERA VEZ QUE VIENE CON LA AFECCIÓN O ES SUBSECUENTE</p>
                                <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <label style="color: red;">Nuevo: Primera vez o subsecuente (*):</label>
                                    <select class="form-control" name="tipoconsulta" id="tipoconsulta" required>
                                        <option value="" disabled selected>Elija una opción</option>
                                        <option value="PRIMERA VEZ">PRIMERA VEZ</option>
                                        <option value="SUBSECUENTE">SUBSECUENTE</option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div id="error"></div>

                </div>

            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>
        function habilitarGesta(value) {

            if (value == "SI") {
                // habilitamos
                $("#semgesta").prop('disabled', false);
                $("#numgesta").prop('disabled', false);
            } else if (value == "NO") {
                // deshabilitamos
                $("#semgesta").prop('disabled', true);
                $("#numgesta").prop('disabled', true);
            }

        }

        //variables para almacenar los datos que se ingresan en los campos
        let mtvoconsulta, sala, semgesta, medico, referencia, tipoConsulta, observaciones;
        //Guardar el dato en las variables
        mtvoconsulta = document.getElementById("mtvoconsulta");
        semgesta = document.getElementById("semgesta");
        sala = document.getElementById("sala");
        medico = document.getElementById("medico");
        referencia = document.getElementById("referencia");
        tipoConsulta = document.getElementById("tipoconsulta");
        observaciones = document.getElementById("observaciones");

        let error = document.getElementById("error");
        error.style.color = "red";

        function enviarFormulario() {

            let mensajesError = [];

            if (mtvoconsulta.value === "" || mtvoconsulta.value === null || mtvoconsulta.length > 100) {
                mensajesError.push("El campo motivo de la consulta está vacío");
            }
            
            if (sala.value === null || sala.value === "") {

                mensajesError.push("Seleccione una opción para el campo SALA");
            }
            
            if (medico.value === "") {
                mensajesError.push("El campo medico está vacío");
            }
            
            if (semgesta.value > 43) {
                mensajesError.push("Semanas de gestación muy altas");
            }

            if (tipoConsulta.value === null || tipoConsulta.value === "") {

                mensajesError.push("Se debe elegir la opción de primera vez o subsecuente");

            }

            if (observaciones.length > 250) {
                mensajesError.push("Las observaciones debe ser menor a 250 caracteres");
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