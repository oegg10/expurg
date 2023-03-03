<?php

ob_start();
include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location: ../../index.php");
    }

    ini_set("display_errors", 1);

    $idrecepcion = $_GET['id'];

    $sql = "SELECT r.idrecepcion,r.idpaciente,p.nombre,p.sexo,r.edad,r.mtvoconsulta,r.embarazo,r.semgesta,r.sala, r.medico, r.referencia,r.observaciones FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE idrecepcion = '$idrecepcion'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Editar Usuario</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                            <div class="row">

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idrecepcion" value="<?php echo $idrecepcion; ?>">
                                    <input type="text" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>" readonly name="edad" id="edad">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Motivo de la consulta (*):</label>
                                    <input type="text" class="form-control" name="mtvoconsulta" id="mtvoconsulta" maxlength="100" value="<?php echo $fila['mtvoconsulta']; ?>" required autofocus onblur="may(this.value, this.id)">
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
                                        <option value="<?php echo $fila['sala']; ?>"><?php echo $fila['sala']; ?></option>
                                        <option value="CONSULTA GENERAL DE URGENCIAS">CONSULTA GENERAL DE URGENCIAS</option>
                                        <option value="GINECOLOGIA">GINECOLOGIA</option>
                                        <option value="URGENCIAS | ENCAMADOS">URGENCIAS | ENCAMADOS</option>
                                        <option value="CONTROL TERMICO">CONTROL TERMICO</option>
                                        <option value="TRIAGE">TRIAGE</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Médico(*):</label>
                                    <input type="text" class="form-control" name="medico" id="medico" maxlength="80" value="<?php echo $fila['medico']; ?>" placeholder="Médico" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Referencia:</label>
                                    <input type="text" class="form-control" name="referencia" id="referencia" maxlength="200" value="<?php echo $fila['referencia']; ?>" placeholder="Referencia" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" value="<?php echo $fila['observaciones']; ?>" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" name="editar"><i class="fa fa-save"> Editar</i></button>
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
            } else if (value == "NO") {
                // deshabilitamos
                $("#semgesta").prop('disabled', true);
            }

        }
    </script>

    </body>

    </html>

<?php

    //editar
    if (isset($_POST["editar"])) {

        $mtvoconsulta = $_POST["mtvoconsulta"];
        //Comprobación si es Femenino o Masculino
        if ($fila['sexo'] == "Femenino") {
            $embarazo = $_POST["embarazo"];
            $semgesta = $_POST["semgesta"];
            $numgesta = $_POST["numgesta"];
        }else{
            $embarazo = 0;
            $semgesta = 0;
            $numgesta = 0;
        }
        
        $sala = $_POST["sala"];
        $medico = $_POST["medico"];
        $referencia = $_POST["referencia"];
        $observaciones = $_POST["observaciones"];

        $idrecepcion = $_POST["idrecepcion"];

        //Comprobación de variables
        /*echo "$mtvoconsulta" . "</br>";
        echo "$embarazo" . "</br>";
        echo "$semgesta" . "</br>";
        echo "$numgesta" . "</br>";
        echo "$sala" . "</br>";
        echo "$medico" . "</br>";
        echo "$referencia" . "</br>";
        echo "$observaciones" . "</br>";
        echo "$idrecepcion" . "</br>";*/

        $editar = "UPDATE recepciones SET mtvoconsulta='$mtvoconsulta',
                                        embarazo='$embarazo',
                                        semgesta='$semgesta',
                                        numgesta='$numgesta',
                                        sala='$sala',
                                        medico='$medico',
                                        referencia='$referencia',
                                        observaciones='$observaciones1',
                                        condicion='1',
                                        fechamod=NOW() WHERE idrecepcion = '$idrecepcion'";

        $editado = $con->query($editar);

        if ($editado > 0) {
            header('location:../extend/alerta.php?msj=La recepcion fue actualizado&c=pac&p=in&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar&c=pac&p=in&t=error');
        }
    }

    $con->close();
}

ob_end_flush();

?>