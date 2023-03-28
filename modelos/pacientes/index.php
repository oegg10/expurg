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
    $paginacion = "SELECT p.idpaciente, p.expediente, p.nombre, p.curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(p.fechanac)), '%Y')+0 AS edad, p.sexo, p.fechanac, p.estado, p.fechaalta, p.idusuario, u.nombre AS usuario FROM pacientes p INNER JOIN usuarios u ON p.idusuario=u.idusuario ORDER BY idpaciente DESC";
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

    $pacientes = "SELECT p.idpaciente, p.expediente, p.nombre, p.curp, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(p.fechanac)), '%Y')+0 AS edad, p.sexo, p.fechanac, p.estado, p.fechaalta, p.idusuario, p.condicion, u.nombre AS usuario FROM pacientes p INNER JOIN usuarios u ON p.idusuario=u.idusuario ORDER BY idpaciente DESC LIMIT $inicio,$num_registros";

    $resultado = $con->query($pacientes);

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
                                <!-- FORMULARIO PARA BUSCAR PACIENTES -->
                                <form action="buscarpaciente.php" method="GET" autocomplete="off">
                                    <div class="form-group">
                                        <input type="search" name="buscar" id="buscar" class="form-control" placeholder="Buscar Paciente">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-search"> Buscar</i></button>
                                    </div>
                                </form>
                            </div>

                        </div>


                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla1" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Expediente</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>CURP</th>
                                        <th>Fecha nac.</th>
                                        <th>Estado</th>
                                        <th>Fecha alta</th>
                                        <th>Registró/Modificó</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                                                <td>" . $reg['expediente'] . "</td>
                                                <td>" . $reg['nombre'] . "</td>
                                                <td>" . $reg['sexo'] . "</td>
                                                <td>" . $reg['edad'] . "</td>
                                                <td>" . $reg['curp'] . "</td>
                                                <td>" . date("d-m-Y", strtotime($reg['fechanac'])) . "</td>";

                                        //==========CONDICION DEL PACIENTE=========
                                        if ($reg['condicion'] == 1) {
                                            echo "<td><span class='text-primary'><strong>Activo</strong></span></td>";
                                        } elseif ($reg['condicion'] == 0) {
                                            echo "<td><span class='text-danger'><strong>Desactivado</strong></span></td>";
                                        }
                                        
                                        //=============ESTADO DEL EXPEDIENTE=========================
                                        /*if ($reg['estado'] == 'Activo') {
                                            echo "<td><span class='text-primary'><strong>Activo</strong></span></td>";
                                        } elseif ($reg['estado'] == 'Depurado') {
                                            echo "<td><span class='text-info'><strong>Depurado</strong></span></td>";
                                        } elseif ($reg['estado'] == 'Defunción') {
                                            echo "<td><span class='text-danger'><strong>Defunción</strong></span></td>";
                                        } elseif ($reg['estado'] == 'Depurado y nvo. número') {
                                            echo "<td><span class='text-warning'><strong>Depurado y nvo. número</strong></span></td>";
                                        }*/

                                        //<td>" . $reg['estado'] . "</td>
                                        echo "<td>" . $reg['fechaalta'] . "</td>
                                                <td>" . $reg['usuario'] . "</td>
                                                
                                                <td class='btn-group'>
                                                    <a href='../../modelos/recepcion/recepcion.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-success' title='Crear recepción'><i class='fa fa-check'></i></a>
                                                    <a href='../../modelos/reportes/repPaciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-secundary' title='Historial del paciente'><i class='fa fa-address-book-o'></i></a>
                                                    <a href='../pacientes/edit_paciente.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-warning' title='Editar paciente'><i class='fa fa-pencil'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Expediente</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>CURP</th>
                                    <th>Fecha nac.</th>
                                    <th>Estado</th>
                                    <th>Fecha alta</th>
                                    <th>Registró/Modificó</th>
                                    <th>Opciones</th>
                                </tfoot>
                            </table>
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

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>