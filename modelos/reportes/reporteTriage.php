<?php

session_start();

ob_start();

include "../../conexion/conexion.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../index.php");
}

ini_set("display_errors", 1);

$id = $_GET['idtriage'];

$sqltriage = "SELECT r.fechahorarecep,t.idrecepcion,t.inicio,t.fechatermino,p.nombre as nombrep,p.sexo,r.edad,t.fc,t.fr,t.ta,t.temperatura,t.glucosa,t.mtvoconsulta,t.semaforo,t.notamedica,u.nombre as nombrem,u.cedula,u.curp FROM recepciones r INNER JOIN triages t ON r.idrecepcion = t.idrecepcion INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON t.idusuario = u.idusuario WHERE idtriage = '$id'";
$resultado = $con->query($sqltriage);
$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Triage</title>

    <!--CSS-->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">

    <!--DataTable-->
    <script src="../../public/js/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/bootstrap.bundle.min.js"></script>

    <style>
        input{
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="../../public/img/logos.jpg" align="left" width="200px" height="100px">
                <h1 align="center" style="padding-top: 30px;">HOSPITAL GENERAL DE SALTILLO</h1>
            </div>
        </div>
    </div>
    <br>
    <hr>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>TRIAGE</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Fecha y hora de llegada a recepción de urgencias:</label>
                                <input type="hidden" value="<?php echo $id; ?>">
                                <input type="text" class="form-control" value="<?php echo $fila['fechahorarecep']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Fecha y hora de inicio del triage:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['inicio']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Fecha y hora de termino del triage:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['fechatermino']; ?>" readonly>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombrep']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Sexo:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['sexo']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Edad:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>"
                                    readonly>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Signos vitales: FC:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['fc']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>FR:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['fr']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>TA:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['ta']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Temperatura:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['temperatura']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Glucosa:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['glucosa']; ?>"
                                    readonly>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Motivo de la consulta:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['mtvoconsulta']; ?>"
                                    readonly>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Semaforo:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['semaforo']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Fecha y hora de la atención:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['inicio']; ?>"
                                    readonly>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Nota médica:</label>
                                <textarea class="form-control" cols="100" rows="20" readonly><?php echo $fila['notamedica']; ?></textarea>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h6>DATOS DEL MEDICO:</h6>
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombrem']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>CURP:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['curp']; ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Cedula:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['cedula']; ?>"
                                    readonly>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php ob_end_flush(); ?>