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

    $sql = "SELECT * FROM exparchivo WHERE idexpediente = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php      
        $idexpediente = mysqli_real_escape_string($con, $_POST['idexpediente']);
        $nombrep = mysqli_real_escape_string($con, $_POST['nombrep']);
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $tipopaciente = mysqli_real_escape_string($con, $_POST['tipopaciente']);
        $estado = mysqli_real_escape_string($con, $_POST['estado']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $idusuario = $_SESSION['idusuario'];

        /*echo $nombrep . "<br>";
        echo $curp . "<br>";
        echo $tipopaciente . "<br>";
        echo $estado . "<br>";
        echo $observaciones . "<br>";*/

        /* VALIDACION DE DATOS */
        $validacion = array();

        //CURP
        if ($curp == "" && $tipopaciente == "Ninguno") {
            array_push($validacion, "La CURP no puede estar vacía o incompleta y el tipo de paciente no puede ser NINGUNO");
        }

        if (substr($curp, 0, 4) == "XXXX") {
            array_push($validacion, "El campo CURP no debe empezar con XXXX utilice la página CURPS que se encuentra en una de las pestañas para obtener la CURP");
        }

        //nombre
        if ($nombrep == "" || strlen($nombrep) < 4 || strlen($nombrep) > 200) {
            array_push($validacion, "El campo NOMBRE no debe estar vacío, o no cumple con las especificaciones");
        }

        //Conteo de validaciones
        if (count($validacion) > 0) {
            echo "<div class='error'>";
            for ($i = 0; $i < count($validacion); $i++) {
                echo "<li style = 'color: red;'>" . $validacion[$i] . "</li>";
            }
            echo "</div>";
        } else {

            //==========================================================================================


            //Realizamos la inserción de los datos
            $editar = "UPDATE exparchivo SET nombrep='$nombrep',
                    curp='$curp',
                    tipopaciente='$tipopaciente',
                    estado='$estado',
                    observaciones='$observaciones',
                    idusuario='$idusuario',
                    fechaalta=NOW() WHERE idexpediente = '$idexpediente'";

            $editado = $con->query($editar);

            if ($editado > 0) {
                header('location:../extend/alerta.php?msj=EL registro a sido actualizado&c=exp&p=in&t=success');
            } else {

                header('location:../extend/alerta.php?msj=Error al actualizar registro&c=exp&p=in&t=error');
            }

            $con->close();
        }
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Editar Expediente</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Expediente:</label>
                                    <input type="text" class="form-control" name="idexpediente" id="idexpediente" maxlength="10" value="<?php echo $fila['idexpediente']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="text" class="form-control" name="nombrep" id="nombrep" autofocus placeholder="Nombre del paciente" onblur="may(this.value, this.id)" required value="<?php echo $fila['nombrep']; ?>">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <input type="text" class="form-control" name="curp" id="curp" minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" onblur="may(this.value, this.id)" value="<?php echo $fila['curp']; ?>">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Tipo de paciente (*):</label>
                                    <select class="form-control" name="tipopaciente" id="tipopaciente" required>
                                        <option value="<?php echo $fila['tipopaciente']; ?>"><?php echo $fila['tipopaciente']; ?></option>
                                        <option value="Ninguno">Ninguno</option>
                                        <option value="Sin Identidad">Sin Identidad</option>
                                        <option value="Desconocido">Desconocido</option>
                                        <option value="Extranjero">Extranjero</option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Estado(*):</label>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="<?php echo $fila['estado']; ?>"><?php echo $fila['estado']; ?></option>    
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="DEPURADO">DEPURADO</option>
                                        <option value="DEFUNCION">DEFUNCION</option>
                                        <option value="DEPURADO Y NVO. NUMERO">DEPURADO Y NVO. NUMERO</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)" value="<?php echo $fila['observaciones']; ?>">
                                </div>
                                
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" name="editar"><i class="fa fa-pencil"> Editar</i></button>
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

    </body>

    </html>

<?php

}

ob_end_flush();

?>