<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    //Paginación
    /*$paginacion = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes";
    $result_pag = $con->query($paginacion);
    //Sacar el numero de filas
    $row = mysqli_num_rows($result_pag);
    $num_registros = 7;
    $total_pags = ceil($row / $num_registros);

    if (isset($_GET['pag'])) {
        $pagina = $_GET['pag'];
    } else {
        $pagina = 1;
    }

    if ($pagina == 1) {
        $inicio = 0;
    } else {
        $res = $pagina - 1;
        $inicio = ($num_registros * $res);
    }

    /*$pacientes = "SELECT idpaciente, nombre, curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(fechanac)), '%Y')+0 AS edad, sexo, afiliacion, numafiliacion FROM pacientes LIMIT $inicio,$num_registros";

    $resultado = $con->query($pacientes);*/

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Pacientes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="paciente.php" class="btn btn-primary">
                                    Registrar Paciente <span class="fa fa-plus-circle"></span>
                                </a>
                            </div>

                            <div class="col-sm-4">
                            </div>

                            <div class="col-sm-4">
                                <!-- CAJA PARA BUSCAR PACIENTES -->
                                <div class="form-group">
                                    <input type="search" name="buscar_paciente" id="buscar_paciente" class="form-control" placeholder="Buscar Paciente">
                                </div>
                            </div>

                        </div>


                        <hr>

                        <!-- tabla -->
                        <div id="datos">
                            
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php

    $atras = $pagina - 1;
    $adelante = $pagina + 1;

    ?>

    <center>
        <p>TOTAL PAGINAS: <?php echo $total_pags; ?></p>
    </center>
    <div class="row">
        <div class="col-4" align="right">
            <?php if ($pagina > 1) : ?>
                <a href="index.php?pag=<?php echo $atras; ?>" class="page-link"><i class="fa fa-arrow-circle-left"></i></a>
            <?php endif; ?>
        </div>

        <div class="col-4">
            <form action="index.php" method="GET">
                <input type="number" class="form-control" name="pag" size="1" placeholder="Página actual: <?php echo $pagina; ?>" style="width: 404px;">
            </form>
        </div>

        <div class="col-4">
            <?php if ($pagina < $total_pags) : ?>
                <a href="index.php?pag=<?php echo $adelante; ?>" class="page-link"><i class="fa fa-arrow-circle-right"></i></a>
            <?php endif; ?>
        </div>



    </div><br>

    <?php include "../extend/footer.php"; ?>
    
    <!-- script para buscar registros -->
    <script src="validaCurp/buscarpaciente.js"></script>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>