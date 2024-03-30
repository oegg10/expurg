<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    if (!empty($_POST)) {

        $nombreservicio = isset($_POST["nombreservicio"]) ? mysqli_real_escape_string($con, $_POST['nombreservicio']) : "";

        /* VALIDACION DE DATOS */
        $validacion = array();

        //nombre
        if ($nombreservicio === "" || strlen($nombreservicio) < 4 || strlen($nombreservicio) > 200) {
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

            //===================================================================================

            //Realizamos la inserción de los datos en la tabla de archivo
            $insSql = "INSERT INTO servicios(nombreservicio, condicion) VALUES ('$nombreservicio', '1')";
            $resultado = $con->query($insSql);

            //===================================================================================
            //MENSAJES DESBLOQUEAR AQUI==========================================================

            if ($resultado > 0) {

                header('location:../extend/alerta.php?msj=EL servicio a sido registrado&c=servicios&p=in&t=success');

            } else {

                header('location:../extend/alerta.php?msj=Error al registrar el servicio&c=servicios&p=in&t=error');
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
                        <h5>Registrar Servicio</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <label>Nombre del Servicio(*):</label>
                                    <input type="text" class="form-control" name="nombreservicio" id="nombreservicio" autofocus placeholder="Nombre del servicio" required onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p id="mensajeError" style="color: red;"></p>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar" onclick="validarFormulario()"><i class="fa fa-save"> Guardar</i></button>
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

        let nombreservicio = document.getElementById("nombreservicio");

        function validarFormulario() {

            let errorMensaje = "";

            if (nombreservicio.value == "") {
                errorMensaje += "Por favor, ingresa el nombre del servicio.\n";
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