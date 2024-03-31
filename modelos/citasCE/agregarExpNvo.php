<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $idcita = $_GET['idpx'];

    //CONSULTA DE CITA
    $citaSql = "SELECT pn.idpxnvo, pn.nombrenvo, m.idmedico, m.nombremedico, s.nombreservicio, pn.fechacita, pn.observaciones, pn.fechacaptura FROM citascenvo pn INNER JOIN medicos m ON pn.idmedico = m.idmedico INNER JOIN servicios s ON m.idservicio = s.idservicio WHERE pn.idpxnvo = '$idcita'";
    $resultCita = $con->query($citaSql);
    $cita = $resultCita->fetch_assoc();

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $expediente = mysqli_real_escape_string($con, $_POST['expediente']);

        $idusuario = $_SESSION['idusuario'];

        //===================================================================================

        //VALIDACIONES ==========

        $errores = [];

         // Validar nombre
        if (empty($expediente)) {
            $errores[] = 'Por favor, ingresa el número de expediente.';
        }

        /* if (is_numeric($expediente)) {
            $errores[] = 'Por favor, ingresa un número válido de expediente.';
        } */

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

            //Realizamos la modificación de los datos
            $editar = "UPDATE citascenvo SET expediente='$expediente',
                            idusuario='$idusuario',
                            condicion = 2 WHERE idpxnvo = '$idcita'";

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
                        <h5>Agregar número de expediente al paciente.</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" id="formCitaCE" method="POST" autocomplete="off">
                            <div class="row">

                                <!-- DATOS DEL PACIENTE -->
                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Nombre del paciente:</label>
                                    <input type="text" class="form-control" value="<?php echo $cita['nombrenvo']; ?>" readonly>
                                </div>

                                <!-- 12 -->
                                <!-- ====== SELECT MEDICOS ====== -->
                                <div class="form-group col-lg-7 col-md-7 col-sm-7">
                                    <label>Nombre del Médico (*):</label>
                                    <input type="text" class="form-control" value="<?php echo $cita['nombremedico']; ?>" readonly>
                                    
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Fecha cita (*):</label>
                                    <input type="text" class="form-control" value="<?php echo $cita['fechacita']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>Expediente:</label>
                                    <input type="text" class="form-control" name="expediente" id="expediente" autofocus required>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-9 col-md-9 col-sm-9">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" value="<?php echo $cita['observaciones']; ?>" readonly>
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

        function validarFormulario() {

            let expediente = document.getElementById('expediente').value;
            
            let errorMensaje = "";

            if (expediente == "" || isNaN(expediente)) {
                errorMensaje += "Por favor, ingresa un número válido de expediente.\n";
            }

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