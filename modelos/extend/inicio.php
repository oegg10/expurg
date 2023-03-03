<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    /*========RECEPCIONES HOY=========================================================*/
    $recepcionesHoy = "SELECT IFNULL(count(fechahorarecep),0) as totalhoy FROM recepciones WHERE DATE(fechahorarecep)=curdate()";
    $recHoy = $con->query($recepcionesHoy);
    $recepHoy = $recHoy->fetch_assoc();
    /*==============================================================================*/
    /*========CONSULTAS HOY=========================================================*/
    $consultasHoy = "SELECT IFNULL(count(fechahorarecep),0) as conultashoy FROM recepciones WHERE DATE(fechahorarecep)=curdate() AND condicion = 2";
    $consHoy = $con->query($consultasHoy);
    $cons_Hoy = $consHoy->fetch_assoc();
    /*==============================================================================*/
    /*========NSP HOY=========================================================*/
    $nspHoy = "SELECT IFNULL(count(fechahorarecep),0) as nsphoy FROM recepciones WHERE DATE(fechahorarecep)=curdate() AND condicion = 3";
    $respnspHoy = $con->query($nspHoy);
    $nsp_Hoy = $respnspHoy->fetch_assoc();
    /*==============================================================================*/

    /*========TOTAL DE RECEPCIONES=========================================================*/
    $totrecep = "SELECT IFNULL(count(fechahorarecep),0) as totrecepciones FROM recepciones";
    $respTotRecep = $con->query($totrecep);
    $totalRecepciones = $respTotRecep->fetch_assoc();
    /*==============================================================================*/
    /*========TOTAL DE CONSULTAS=========================================================*/
    $totconsul = "SELECT IFNULL(count(fechahorarecep),0) as totconsultas FROM recepciones WHERE condicion = 2";
    $respTotConsultas = $con->query($totconsul);
    $totalConsultas = $respTotConsultas->fetch_assoc();
    /*==============================================================================*/
    /*========TOTAL DE NSP=========================================================*/
    $totalnsp = "SELECT IFNULL(count(fechahorarecep),0) as totnsp FROM recepciones WHERE condicion = 3";
    $respTotnsp = $con->query($totalnsp);
    $total_nsp = $respTotnsp->fetch_assoc();
    /*==============================================================================*/
    /*========TOTAL POR MES=========================================================*/
    //$totalMes = "SELECT MonthName(fechahorarecep) AS mes, count(*) AS total FROM recepciones WHERE year(fechahorarecep) = year(curdate()) group by MonthName(fechahorarecep)";
    //$respMes = $con->query($totalMes);

    $totalMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $respMes = $con->query($totalMes);
    /*==============================================================================*/
    /*========EMBARAZOS POR MES=========================================================*/

    /*$embarazoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE embarazo='SI' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $embMes = $con->query($embarazoMes);*/

    $embarazoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='GINECOLOGIA' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $embMes = $con->query($embarazoMes);

    /*==============================================================================*/

    /*======== CONSULTORIO 1========================================================*/

    $consultorio1Mes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='CONSULTA GENERAL DE URGENCIAS' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $cons1Mes = $con->query($consultorio1Mes);

    /*==============================================================================*/

    /*======== CONTROL TERMICO Y ENCAMADOS =========================================*/

    $control_encamadosMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala<>'CONSULTA GENERAL DE URGENCIAS' AND sala<>'GINECOLOGIA' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $otrosMes = $con->query($control_encamadosMes);

    /*==============================================================================*/


    /*========NO SE PRESENTO POR MES=========================================================*/

    $nosepresentoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS nsp FROM recepciones WHERE condicion=3 AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $nspMes = $con->query($nosepresentoMes);
    /*==============================================================================*/



?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Inicio</h5>
                    </div>
                    <div class="card-body">

                        <h6 class="box-title">Estadísticas</h6>
                        <hr>

                        <!--===========================================================
                        RECEPCIONES HOY
                        ============================================================-->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="card border-success col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Recepciónes</div>
                                    <div class="card-body text-success">
                                        <h5 class="card-title">Recepciones hoy</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $recepHoy['totalhoy']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                                <div class="card border-info col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Consultas</div>
                                    <div class="card-body text-info">
                                        <h5 class="card-title">Consultados hoy</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $cons_Hoy['conultashoy']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                                <div class="card border-danger col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Recepciónes</div>
                                    <div class="card-body text-danger">
                                        <h5 class="card-title">N.S.P. hoy</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $nsp_Hoy['nsphoy']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br><br>

                        <!-- =============================================================== -->
                        <div class="row">

                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <h3>Recepciones por MES</h3>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $respMes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        
                                        <td>"  . $reg['mes'] . "</td>
                                        <td>"  . $reg['anio'] . "</td>

                                        <td>" . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--================ CONSULTORIO 1 POR MES =====================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <h3>Consultorio 1 por MES</h3>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Consultas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $cons1Mes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['mes'] . "</td>
                                        <td>"  . $reg['anio'] . "</td>

                                        <td>" . $reg['emb'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Consultas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--================ EMBARAZOS POR MES ===================================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <h3>Embarazos por MES</h3>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Embarazos</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $embMes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['mes'] . "</td>
                                        <td>"  . $reg['anio'] . "</td>

                                        <td>" . $reg['emb'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Embarazos</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--=========== CONTROL TERMICO Y ENCAMADOS POR MES ============-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <h4>Control T. y encamados por MES</h4>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Consultas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $otrosMes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['mes'] . "</td>
                                        <td>"  . $reg['anio'] . "</td>

                                        <td>" . $reg['emb'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Consultas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--================ NO SE PRESENTO POR MES ====================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <h3>N.S.P. por MES</h3>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>NSP</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $nspMes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['mes'] . "</td>
                                        <td>"  . $reg['anio'] . "</td>

                                        <td>" . $reg['nsp'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>NSP</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <br><br>

                        <!--===========================================================
                        RECEPCIONES TOTAL
                        ============================================================-->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="card border-success col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Recepciónes</div>
                                    <div class="card-body text-success">
                                        <h5 class="card-title">Total de recepciones</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $totalRecepciones['totrecepciones']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                                <div class="card border-info col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Consultas</div>
                                    <div class="card-body text-info">
                                        <h5 class="card-title">Total de Consultas</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $totalConsultas['totconsultas']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                                <div class="card border-danger col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card-header">Recepciónes</div>
                                    <div class="card-body text-danger">
                                        <h5 class="card-title">Total de N.S.P.</h5>
                                        <p class="card-text">
                                            <h1>
                                                <strong><?php echo $total_nsp['totnsp']; ?></strong>
                                            </h1>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br><br>

                    </div>
                    <?php include "../extend/footer.php"; ?>
                </div>
            </div>
        </div>
    </div>

<?php

    $con->close();
}

ob_end_flush();
?>