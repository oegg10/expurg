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

    $sql = "SELECT * FROM servicios WHERE idservicio = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php      
        $idservicio = mysqli_real_escape_string($con, $_POST['idservicio']);
        $nombreservicio = mysqli_real_escape_string($con, $_POST['nombreservicio']);

        /* VALIDACION DE DATOS */
        $validacion = array();

        //nombre
        if ($nombreservicio == "" || strlen($nombreservicio) < 4 || strlen($nombreservicio) > 200) {
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

            //========================================================================================

            //Realizamos la inserción de los datos
            $editar = "UPDATE servicios SET nombreservicio='$nombreservicio' WHERE idservicio = '$idservicio'";

            $editado = $con->query($editar);

            if ($editado > 0) {
                header('location:../extend/alerta.php?msj=EL registro a sido actualizado&c=servicios&p=in&t=success');
            } else {

                header('location:../extend/alerta.php?msj=Error al actualizar registro&c=servicios&p=in&t=error');
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
                        <h5>Editar Servicio</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <label>Nombre Servicio:</label>
                                    <input type="hidden" name="idservicio" id="idservicio" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" name="nombreservicio" id="nombreservicio" maxlength="200" value="<?php echo $fila['nombreservicio']; ?>" required onblur="may(this.value, this.id)">
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