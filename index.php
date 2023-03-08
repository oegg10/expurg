<?php

include_once "conexion/conexion.php";

session_start();

if (isset($_SESSION['idusuario'])) {
    header("Location: modelos/extend/inicio.php");
}

if (!empty($_POST)) {
    $usuario = mysqli_real_escape_string($con, $_POST['user']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $pass1 = sha1($pass);

    //$sql = "SELECT idusuario,nombre,idrol,cedula,curp,turno FROM usuarios WHERE usuario = '$usuario' AND pass = '$pass1' AND condicion = 1";
    $sql = "SELECT u.idusuario,u.nombre,u.idrol,r.rol as nivel,u.cedula,u.curp,u.turno FROM usuarios u INNER JOIN roles r ON u.idrol = r.idrol WHERE usuario = '$usuario' AND pass = '$pass1' AND condicion = 1";
    $resultado = $con->query($sql);
    $filas = $resultado->num_rows;

    if ($filas > 0) {
        $fila = $resultado->fetch_assoc();
        $_SESSION['idusuario'] = $fila['idusuario'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['idrol'] = $fila['idrol'];
        $_SESSION['nivel'] = $fila['nivel'];
        $_SESSION['cedula'] = $fila['cedula'];
        $_SESSION['curp'] = $fila['curp'];
        $_SESSION['turno'] = $fila['turno'];

        header("Location: modelos/extend/inicio.php");
    } else {
        echo "<script>
                alert('EL usuario y/o contraseña son incorrectos');
                window.location = 'index.php';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar Expediente Urgencias</title>

    <!--CSS-->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/font-awesome.min.css">

    <script src="public/js/jquery-3.4.1.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <center>
        <div style="padding-top: 50px;">
            <img class="mb-4" src="public/img/logos.jpg" alt="" width="260" height="130">
            <h1 class="h3 mb-3 font-weight-normal">Ingrese sus datos</h1>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <div class="form-group col-3">
                    <label for="user" class="sr-only">Usuario</label>
                    <input type="text" name="user" class="form-control" placeholder="Usuario" required autofocus>
                </div>

                <div class="form-group col-3">
                    <label for="pass" class="sr-only">Contraseña</label>
                    <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
                </div>

                <div class="col-3">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="ingresar" value="Ingresar">Ingresar</button>
                </div>
            </form>
            <p class="mt-5 mb-3 text-muted">&copy; ver: 3.0 - Estadística H.G.S. 2019 - 2023</p>

        </div>
    </center>
</body>

</html>