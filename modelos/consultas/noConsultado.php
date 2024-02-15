<?php

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    include "../../conexion/conexion.php";

    $id = $_GET['idrecepcion'];

    //CONSULTA A LA RECEPCION Y PACIENTE
    $sql = "SELECT r.idrecepcion,r.fechahorarecep,DATE_FORMAT(r.fechahorarecep, '%Y-%m-%d') FechaStr,DATE_FORMAT(r.fechahorarecep,'%H:%i:%s')  HoraStr,p.idpaciente,p.nombre,r.edad,p.sexo,r.mtvoconsulta FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente WHERE r.idrecepcion = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //Captura de datos
    if (!empty($_POST)) {

        $idrecepcion = isset($_POST["idrecepcion"]) ? mysqli_real_escape_string($con, $_POST['idrecepcion']) : "";
        $mtvocancelo = isset($_POST["mtvocancelo"]) ? mysqli_real_escape_string($con, $_POST['mtvocancelo']) : "";

        //VALIDACION
        $errores = [];
        
        if ($mtvocancelo == "" || $mtvocancelo == NULL) {

            $errores[] = 'El motivo no debe estar vacío.';
            
        }
        
        if (!empty($errores)) {

            echo '<h2>Errores:</h2>';
            echo '<ul>';
            foreach ($errores as $error) {
                echo '<li style="color: red;">' . $error . '</li>';
            }
            echo '</ul>';

        }else {

            $cancelar = "UPDATE recepciones SET mtvocancelo = '$mtvocancelo', condicion = 3, fechamod = NOW() WHERE idrecepcion = '$id'";
            $cancelado = $con->query($cancelar);

            if ($cancelado > 0) {

                header('location:../extend/alerta.php?msj=La consulta fue catalogada como NO CONSULTADO&c=rec&p=in&t=success');
                $con->close();
                exit();
            } else {

                header('location:../extend/alerta.php?msj=La recepcion no se pudo realizar&c=rec&p=in&t=error');
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

                        <h5>CANCELACIÓN DE CONSULTA DE URGENCIAS</h5>
                        <hr>
                        <div style="color: red;">
                            <h5>Favor de escribir el motivo de la cancelación de la consulta en el apartado correspondiente. Gracias.</h5>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="formConsulta" autocomplete="off">

                                <div class="row">

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>Datos del paciente:</h6>
                                    </div>

                                    <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                        <label>Nombre:</label>
                                        <input type="hidden" name="idrecepcion" id="idrecepcion" value="<?php echo $id; ?>">
                                        <input type="hidden" name="idpaciente" value="<?php echo $fila['idpaciente']; ?>">
                                        <input type="text" name="nombrep" id="nombrep" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Sexo:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['sexo']; ?>" readonly name="sexo" id="sexo">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Edad:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>" readonly name="edad" id="edad">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Motivo de la consulta:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['mtvoconsulta']; ?>" readonly name="mtvoconsulta" id="mtvoconsulta">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Motivo de la cancelación de la consulta:</label>
                                        <input type="text" class="form-control" name="mtvocancelo" id="mtvocancelo" style="background: black; color: white" placeholder="Motivo de la cancelación de la consulta" onblur="may(this.value, this.id)" required>
                                    </div>


                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="Guardar" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </form>
                        </div>

                        <div id="error"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <?php include "../extend/footer.php"; ?>

    <script>

        function enviarFormulario() {

            let mtvocancelo = document.getElementById("mtvocancelo");

            let mensajesError = [];

            if (mtvocancelo.value === null || mtvocancelo.value === "") {
                mensajesError.push("El motivo no debe estar vacío");
            }

            error.innerHTML = mensajesError.join(", ");

            return false;

        }
       
    </script>
    
    </body>

    </html>

<?php } ?>
