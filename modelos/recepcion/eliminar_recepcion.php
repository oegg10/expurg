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

    $sql = "SELECT r.idrecepcion, r.idpaciente, p.nombre, r.edad, r.mtvoconsulta FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE idrecepcion = '$idrecepcion'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5 style="color: red;"> ¡¡¡CUIDADO, está a punto de eliminar la recepción!!!</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                            <div class="row">

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idrecepcion" value="<?php echo $idrecepcion; ?>">
                                    <input type="text" class="form-control" style="background-color: black; color: white" value="<?php echo $fila['nombre']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad:</label>
                                    <input type="text" class="form-control" style="background-color: black; color: white" value="<?php echo $fila['edad']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Motivo de la consulta (*):</label>
                                    <input type="text" class="form-control" style="background-color: black; color: white" value="<?php echo $fila['mtvoconsulta']; ?>" readonly>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <label><strong>Motivo de la eliminación (*):</strong></label>
                                    <select class="form-control" name="mtvocancelo" id="mtvocancelo" onchange='habilitaBtn(this.value);' required>
                                        <option value="">Elija una opción</option>
                                        <option value="REGISTRO DUPLICADO">REGISTRO DUPLICADO</option>
                                        <option value="NO HAY MEDICO">NO HAY MEDICO</option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-warning" type="submit" onclick="enviarFormulario()" name="eliminar" id="eliminar"><i class="fa fa-trash"> Eliminar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>

                        <div id="error" style="color: red;"></div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>

        let mtvocancelo = document.getElementById("mtvocancelo");
        //Se deshabilita el boton de eliminar
        let eliminar = document.getElementById('eliminar');
        eliminar.disabled = true;

        //Se habilita el boton de eliminar
        function habilitaBtn(){
            if (mtvocancelo.value != "") {
                eliminar.disabled = false;
            }else{
                eliminar.disabled = true;
            }
        }
        
        function enviarFormulario() {

            let mensajesError = [];

            //if (mtvocancelo.value === null || mtvocancelo.value === "") {

                /*SI SE CUMPLEN LAS CONDICIONES */
                /*mensajesError.push("El motivo de eliminación no puede estar vacío");
                document.getElementById("mtvocancelo").focus();
                eliminar.disabled = true;

            }*/

            if (mtvocancelo.value === null || 
                mtvocancelo.value === "" ||
                mtvocancelo.value != "REGISTRO DUPLICADO" &&
                mtvocancelo.value != "NO HAY MEDICO") {

                /*SI SE CUMPLEN LAS CONDICIONES */
                mensajesError.push("El motivo de eliminación no puede estar vacío o hay valores incorrectos");
                document.getElementById("mtvocancelo").focus();
                eliminar.disabled = true;

            }

            error.innerHTML = mensajesError.join(", ");

            return false;

        }
       
    </script>

    </body>

    </html>

<?php

    //eliminar
    if (isset($_POST["eliminar"])) {
    
        $mtvocancelo = isset($_POST["mtvocancelo"]) ? mysqli_real_escape_string($con, $_POST['mtvocancelo']) : "";
        //$mtvocancelo = $_POST["mtvocancelo"];
        $idrecepcion = $_POST["idrecepcion"];

        //VALIDACION
        $errores = [];

        // Validar motivo
        if (empty($mtvocancelo)) {
            $errores[] = 'Por favor, introduce el motivo de la eliminación.';
        }

        // Mostrar errores si los hay
        if (!empty($errores)) {
            echo '<h2>Errores:</h2>';
            echo '<ul>';
            foreach ($errores as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        } else {

            $eliminarSQL = "UPDATE recepciones SET mtvocancelo='$mtvocancelo',
                                        condicion='6',
                                        fechamod=NOW() WHERE idrecepcion = '$idrecepcion'";

            $elimina = $con->query($eliminarSQL);

            if ($elimina > 0) {
                header('location:../extend/alerta.php?msj=La recepcion fue eliminada&c=pac&p=in&t=success');
                $con->close();
                exit();
            } else {

                header('location:../extend/alerta.php?msj=Error al eliminar&c=pac&p=in&t=error');
            }
            
        }
        
    }

    $con->close();
    exit();
}

ob_end_flush();

?>
