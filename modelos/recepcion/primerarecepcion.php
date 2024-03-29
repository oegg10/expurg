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

    //Seleccionamos algunos campos de la tabla
    $sql = "SELECT idpaciente,nombre,DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad,sexo FROM pacientes WHERE idpaciente = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================================
    $idusuario = $_SESSION['idusuario'];

    //Captura de datos
    if (!empty($_POST)) {

        $idpaciente = isset($_POST["idpaciente"]) ? mysqli_real_escape_string($con, $_POST['idpaciente']) : "";
        $edad = isset($_POST["edad"]) ? mysqli_real_escape_string($con, $_POST['edad']) : "";
        $mtvoconsulta = isset($_POST["mtvoconsulta"]) ? mysqli_real_escape_string($con, $_POST['mtvoconsulta']) : "";
        $embarazo = isset($_POST["embarazo"]) ? mysqli_real_escape_string($con, $_POST['embarazo']) : "";
        $semgesta = isset($_POST["semgesta"]) ? mysqli_real_escape_string($con, $_POST['semgesta']) : "";
        $numgesta = isset($_POST["numgesta"]) ? mysqli_real_escape_string($con, $_POST['numgesta']) : "";
        $sala = isset($_POST["sala"]) ? mysqli_real_escape_string($con, $_POST['sala']) : "";
        $medico = isset($_POST["medico"]) ? mysqli_real_escape_string($con, $_POST['medico']) : "";
        $referencia = isset($_POST["referencia"]) ? mysqli_real_escape_string($con, $_POST['referencia']) : "";
        $observaciones = isset($_POST["observaciones"]) ? mysqli_real_escape_string($con, $_POST['observaciones']) : "";

        //Si vienen vacíos los campos de embarazo, sem gesta y num gesta
        if (empty($embarazo) && empty($semgesta) && empty($numgesta)) {
            $embarazo = "NO";
            $semgesta = 0;
            $numgesta = 0;
        } elseif (empty($semgesta) && empty($numgesta)) {
            $semgesta = 0;
            $numgesta = 0;
        }

        //Realizamos la inserción de los datos
        $sqlins = "INSERT INTO recepciones (idpaciente,edad,mtvoconsulta,embarazo,semgesta,numgesta,sala,medico,referencia,tipoconsulta,observaciones,condicion,idusuario,fechamod) VALUES ('$idpaciente','$edad','$mtvoconsulta','$embarazo','$semgesta','$numgesta','$sala','$medico','$referencia','PRIMERA VEZ','$observaciones', '1', '$idusuario',NOW())";

        $resins = $con->query($sqlins);

        if ($resins > 0) {

            header('location:../extend/alerta.php?msj=La recepcion fue exitosa&c=rec&p=in&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al registrar la recepcion&c=rec&p=in&t=error');
        }

        $con->close();
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Recepción a Consulta</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" onsubmit="return validar();">
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
                                        <input type='text' class='form-control' name='semgesta' id='semgesta' disabled maxlength='2' placeholder='Semanas gesta' pattern='[0-9]{1-2}'>
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
                                        <?php
                                            if ($fila['sexo'] == "Femenino") {
                                                echo '<option value="GINECOLOGIA">GINECOLOGIA</option>';
                                            }
                                        ?>
                                        <option value="URGENCIAS | ENCAMADOS">URGENCIAS | ENCAMADOS</option>
                                        <option value="CONTROL TERMICO">CONTROL TERMICO</option>
                                        <option value="CLINICA DE HERIDAS">CLINICA DE HERIDAS</option>
                                        <option value="TRIAGE">TRIAGE</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Médico(*):</label>
                                    <input type="text" class="form-control" name="medico" id="medico" maxlength="80" placeholder="Médico" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Referencia:</label>
                                    <input type="text" class="form-control" name="referencia" id="referencia" maxlength="200" placeholder="Referencia" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>
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
    </script>

    <!--<script src="../validaciones/validarecepcion.js"></script>-->


    </body>

    </html>

<?php
}

ob_end_flush();
?>