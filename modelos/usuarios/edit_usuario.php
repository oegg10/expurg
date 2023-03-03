<?php

ob_start();
include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 1) {
        header("Location: ../../index.php");
    }

    ini_set("display_errors", 1);

    $id = $_GET['id'];

    //$sql = "SELECT * FROM usuarios WHERE idusuario = '$id'";
    $sqluser = "SELECT u.idusuario,u.nombre,u.idrol,r.rol,u.cedula,u.curp,u.turno,u.usuario,u.pass,u.fechaalta,u.condicion FROM usuarios u INNER JOIN roles r ON u.idrol = r.idrol WHERE idusuario = '$id'";
    $resultado = $con->query($sqluser);
    $fila = $resultado->fetch_assoc();

    //Llenar el select de rol
    $tipoRol = "SELECT idrol,rol FROM roles";
    $resRol = $con->query($tipoRol);
    $filarol = $resRol->fetch_assoc();

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

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="150" value="<?php echo $fila['nombre']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Rol (*):</label>
                                    <select class="form-control" name="idrol" id="idrol" required>
                                        <option value="<?php echo $fila['idrol']; ?>"><?php echo $fila['rol']; ?></option>
                                        <?php while ($filarol = $resRol->fetch_assoc()) { ?>
                                            <option value="<?php echo $filarol['idrol']; ?>"><?php echo $filarol['rol']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Cedula (solo médicos):</label>
                                    <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10" value="<?php echo $fila['cedula']; ?>">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP (solo médicos):</label>
                                    <input type="text" class="form-control" name="curp" id="curp" maxlength="18" value="<?php echo $fila['curp']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Turno (*):</label>
                                    <select class="form-control" name="turno" id="turno" required>
                                        <option value="<?php echo $fila['turno']; ?>"><?php echo $fila['turno']; ?></option>
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
                                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $fila['usuario']; ?>" disabled="true">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Contraseña (*):</label>
                                    <input type="password" class="form-control" name="pass" id="pass" value="<?php echo $fila['pass']; ?>" required>
                                </div>

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

    if (isset($_POST["editar"])) {

        $nombre = $_POST["nombre"];
        $idrol = $_POST["idrol"];
        $cedula = $_POST["cedula"];
        $curp = $_POST["curp"];
        $turno = $_POST["turno"];
        $pass = $_POST["pass"];
        $pass1 = sha1($pass);

        $idusuario = $_POST["idusuario"];

        $editar = "UPDATE usuarios SET nombre='$nombre',
                                            idrol='$idrol',
                                            cedula='$cedula',
                                            curp='$curp',
                                            turno='$turno',
                                            pass='$pass1' WHERE idusuario = '$idusuario'";

        $editado = $con->query($editar);

        if ($editado > 0) {

            header('location:../extend/alerta.php?msj=EL usuario a sido actualizado&c=us&p=in&t=success');
           
        } else {

            header('location:../extend/alerta.php?msj=ERROR al actualizar usuario&c=us&p=in&t=error');

        }
    }

    $resultado->close();
    $resRol->close();
    $con->close();

}

ob_end_flush();

?>