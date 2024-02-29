<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];
    $idusuario = $_SESSION['idusuario'];

    $sql = "SELECT * FROM desconocidos WHERE iddesconocido = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    $usuariosql = "SELECT * FROM usuarios WHERE idusuario = '$idusuario'";
    $resusuario = $con->query($usuariosql);
    $filausuario = $resusuario->fetch_assoc();

    //============================================================

?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-9">
                        <img src="../../public/img/urgencias.jpg" alt="logo SSC" width="500px">
                    </div>

                    <div class="col-sm-3">
                        <span style="font-size: 10px">Recepción: <small><?php echo $filausuario['nombre']; ?></small></span>
                        <p><span style="font-size: 10px">Turno: <small><?php echo $filausuario['turno']; ?></small></span></p>
                        <span>Folio:</span>
                    </div>

                    <input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 20%; text-align: center; height: 36px;"><strong> Fecha alta</strong></td>
                                    <td style="width: 80%; text-align: center; height: 36px;"><strong>Motivo de ingreso</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 18px;">
                                    <td style="width: 20%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><strong><?php echo $fila['fechaalta']; ?></strong></td>
                                    <td style="width: 80%; padding: 0; height: 18px; font-size: 22px;"><strong><?php echo $fila['mtvoingreso']; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 15%; text-align: center; height: 36px;"><strong>Sexo</strong></td>
                                    <td style="width: 85%; text-align: center; height: 36px;"><strong>Rasgos particulares</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 15%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><strong><?php echo $fila['sexo']; ?></strong></td>
                                    <td style="width: 85%; padding: 0; height: 18px; font-size: 22px"><strong><?php echo $fila['rasgos']; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 60%; text-align: center; height: 36px;"><strong>Dónde fue encontrado</strong></td>
                                    <td style="width: 30%; text-align: center; height: 36px;"><strong>Quién lo trajo</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Edad aparente</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width:60%; padding: 0; height: 18px; font-size: 22px"><strong><?php echo $fila['encontrado']; ?></strong></td>
                                    <td style="width: 30%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><strong><?php echo $fila['trasladado']; ?></strong></td>
                                    <td style="width: 10%; padding: 0; height: 18px; font-size: 22px; text-align:center;"><strong><?php echo $fila['edadaparente']; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>