<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 9) {
        header("Location: ../../index.php");
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Consultados en consultorio 1</h5>
                    </div>
                    <div class="card-body">

                        <form action="../reportes/repConsultasExcel.php" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha inicio (*):</label>
                                    <input type="date" class="form-control" name="fechai" id="fechai" min="2019-09-30" value="<?php echo $fechai; ?>" required>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha final (*):</label>
                                    <input type="date" class="form-control" name="fechaf" id="fechaf" min="2019-09-30" value="<?php echo $fechaf; ?>" required>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                    <button class="btn btn-primary" type="submit"><i class="fa fa-archive"> Exportar a Excel</i></button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>


    <?php include "../extend/footer.php"; ?>

    </body>

    </html>

<?php
}

$resultado = null;
$con->close();
ob_end_flush();
?>