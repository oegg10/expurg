<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 5) {
        header("Location:../../index.php");
    }

    $id = $_GET['idrecep'];

    $sql = "SELECT r.idrecepcion,r.idpaciente,r.fechahorarecep,r.edad,p.nombre,p.sexo FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE idrecepcion = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================================
    //$idusuario = $_SESSION['idusuario'];

    //Captura de datos
    if (!empty($_POST)) {

        $idrecepcion = isset($_POST["idrecepcion"]) ? mysqli_real_escape_string($con, $_POST['idrecepcion']) : "";
        $inicio = isset($_POST["inicio"]) ? mysqli_real_escape_string($con, $_POST['inicio']) : "";
        $fc = isset($_POST["fc"]) ? mysqli_real_escape_string($con, $_POST['fc']) : "";
        $fr = isset($_POST["fr"]) ? mysqli_real_escape_string($con, $_POST['fr']) : "";
        $ta = isset($_POST["ta"]) ? mysqli_real_escape_string($con, $_POST['ta']) : "";
        $temperatura = isset($_POST["temperatura"]) ? mysqli_real_escape_string($con, $_POST['temperatura']) : "";
        $glucosa = isset($_POST["glucosa"]) ? mysqli_real_escape_string($con, $_POST['glucosa']) : "";
        $mtvoconsulta = isset($_POST["mtvoconsulta"]) ? mysqli_real_escape_string($con, $_POST['mtvoconsulta']) : "";
        $semaforo = isset($_POST["semaforo"]) ? mysqli_real_escape_string($con, $_POST['semaforo']) : "";
        $notamedica = isset($_POST["notamedica"]) ? mysqli_real_escape_string($con, $_POST['notamedica']) : "";
        $fechatermino = isset($_POST["fechatermino"]) ? mysqli_real_escape_string($con, $_POST['fechatermino']) : "";
        $idusuario = $_SESSION['idusuario'];

        //Realizamos la inserción de los datos
        $sqlins = "INSERT INTO triages(idrecepcion, inicio, fc, fr, ta, temperatura, glucosa, mtvoconsulta, semaforo, notamedica, fechatermino, condicion, idusuario) VALUES ('$idrecepcion','$inicio','$fc','$fr','$ta','$temperatura','$glucosa','$mtvoconsulta','$semaforo','$notamedica','$fechatermino','1','$idusuario')";

        $resins = $con->query($sqlins);

        if ($resins > 0) {

            echo "<script>
            alert('El triage fue exitoso');
            window.location = 'index.php';
        </script>";
        } else {

            echo "<script>
            alert('Error al realizar el triage');
            window.location = 'index.php';
        </script>";
        }

        $sqlins->close();
        $con->close();
    }

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Triage</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idrecepcion" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>" readonly name="edad" id="edad" disabled>
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Sexo:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['sexo']; ?>" readonly name="sexo" id="sexo" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Fecha y hora de inicio (*):</label>
                                    <input type="datetime-local" class="form-control" name="inicio" id="inicio">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>F.C.:</label>
                                    <input type="text" class="form-control" name="fc" id="fc" maxlength="8" placeholder="F.C." onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>F.R.:</label>
                                    <input type="text" class="form-control" name="fr" id="fr" maxlength="8" placeholder="F.R." onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>T.A.:</label>
                                    <input type="text" class="form-control" name="ta" id="ta" maxlength="8" placeholder="T.A." onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Temperatura:</label>
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" maxlength="3" placeholder="Temperatura" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Glucosa:</label>
                                    <input type="text" class="form-control" name="glucosa" id="glucosa" maxlength="3" placeholder="Glucosa" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Motivo consulta:</label>
                                    <input type="text" class="form-control" name="mtvoconsulta" id="mtvoconsulta" maxlength="200" placeholder="Motivo consulta" onblur="may(this.value, this.id)">
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Semaforo:</label>
                                    <select class='form-control' name='semaforo' id='semaforo' required>
                                        <option value='' disabled selected>Semaforo</option>
                                        <option value='ROJO'>ROJO</option>
                                        <option value='NARANJA'>NARANJA</option>
                                        <option value='AMARILLO'>AMARILLO</option>
                                        <option value='VERDE'>VERDE</option>
                                        <option value='AZUL'>AZUL</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Fecha de atencion:</label>
                                    <input type="datetime-local" class="form-control" name="fechaatencion" id="fechaatencion">
                                </div> -->

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Nota medica:</label><br>
                                    <textarea name="notamedica" id="notamedica" cols="209" rows="8" onblur="may(this.value, this.id)"></textarea>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha y hora de termino (*):</label>
                                    <input type="datetime-local" class="form-control" name="fechatermino" id="fechatermino" required>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
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

<?php
}

ob_end_flush();
?>

<script>
    function habilitarGesta(value) {

        if (value == "SI") {
            // habilitamos
            $("#semgesta").prop('disabled', false);
        } else if (value == "NO") {
            // deshabilitamos
            $("#semgesta").prop('disabled', true);
        }

    }
</script>