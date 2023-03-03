<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1) {
        header("Location:../../index.php");
    }

//Llenar el select de rol
$tipoRol = "SELECT idrol,rol FROM roles";
$resRol = $con->query($tipoRol);

//Captura de datos
if (!empty($_POST)) {

    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($con, $_POST['nombre']) : "";
    $idrol = isset($_POST["idrol"]) ? mysqli_real_escape_string($con, $_POST['idrol']) : "";
    $cedula = isset($_POST["cedula"]) ? mysqli_real_escape_string($con, $_POST['cedula']) : "";
    $curp = isset($_POST["curp"]) ? mysqli_real_escape_string($con, $_POST['curp']) : "";
    $turno = isset($_POST["turno"]) ? mysqli_real_escape_string($con, $_POST['turno']) : "";
    $usuario = isset($_POST["usuario"]) ? mysqli_real_escape_string($con, $_POST['usuario']) : "";
    $pass = isset($_POST["pass"]) ? mysqli_real_escape_string($con, $_POST['pass']) : "";
    //Encriptar contraseña
    $pass1 = sha1($pass);

    //Verificar si el usuario ya existe en la BD
    $existeusuario = "SELECT idusuario FROM usuarios WHERE usuario = '$usuario'";
    $resusuario = $con->query($existeusuario);

    $filausuario = $resusuario->num_rows;
    if ($filausuario > 0) {

        header('location:../extend/alerta.php?msj=EL usuario ya está registrado&c=us&p=in&t=error');
        
    } else {

        $sqlins = "INSERT INTO usuarios(nombre, idrol, cedula, curp, turno, usuario, pass, condicion) VALUES ('$nombre','$idrol', '$cedula', '$curp', '$turno', '$usuario', '$pass1', 1)";

        $resultado = $con->query($sqlins);

        if ($resultado > 0) {

            header('location:../extend/alerta.php?msj=EL usuario a sido registrado&c=us&p=in&t=success');

        } else {

            header('location:../extend/alerta.php?msj=ERROR al registrar usuario&c=us&p=in&t=error');

        }
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    <h5>Registrar Usuario</h5>
                </div>
                <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                        <div class="row">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre (*):</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="150" placeholder="Nombre" required onblur="may(this.value, this.id)">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Rol (*):</label>
                                <select class="form-control" name="idrol" id="idrol" required>
                                    <option value="" disabled selected>Rol</option>
                                    <?php while ($fila = $resRol->fetch_assoc()) { ?>
                                        <option value="<?php echo $fila['idrol']; ?>"><?php echo $fila['rol']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Cedula (solo médicos):</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10" placeholder="Cedula">
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>CURP (solo médicos):</label>
                                <input type="text" class="form-control" name="curp" id="curp" maxlength="18" placeholder="CURP" onblur="may(this.value, this.id)">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Turno (*):</label>
                                <select class="form-control" name="turno" id="turno" required>
                                    <option value="" disabled selected>Turno</option>
                                    <option value="MATUTINO">MATUTINO</option>
                                    <option value="VESPERTINO">VESPERTINO</option>
                                    <option value="NOCTURO A">NOCTURO A</option>
                                    <option value="NOCTURNO B">NOCTURNO B</option>
                                    <option value="JORNADA ACUMULADA DIURNA">JORNADA ACUMULADA DIURNA</option>
                                    <option value="JORNADA ACUMULADA NOCTURNA">JORNADA ACUMULADA NOCTURNA</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>usuario (*):</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Contraseña (*):</label>
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" required>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
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

$con->close();

ob_end_flush();
?>