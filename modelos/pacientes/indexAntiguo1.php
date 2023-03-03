<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Buscar Paciente | Ingrese la CURP</h5>
                    </div>
                    <div class="card-body">

                        <!--<form action="ins_paciente.php" method="POST" autocomplete="off" onsubmit="return validar();">-->
                        
                            <div class="row">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>CURP del Paciente</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" autofocus placeholder="CURP DEL PACIENTE" onkeyup="busqueda();">
                                </div>

                                <!-- 12 -->

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosPaciente"></div>

                                <!-- 12 -->

                            </div>

                        <!--</form>-->
                    </div>
                </div>
                <?php include "../extend/footer.php"; ?>
            </div>
        </div>
    </div>

    <script src="buscadorpacientes/funcion.js"></script>

</body>

</html>

<?php
}

ob_end_flush();
?>