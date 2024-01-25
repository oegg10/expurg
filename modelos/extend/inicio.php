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
    $totalMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $respMes = $con->query($totalMes);
    /*==============================================================================*/

    /*========GINECOLOGIA POR MES=========================================================*/
    $embarazoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='GINECOLOGIA' AND YEAR(fechahorarecep) = YEAR(curdate()) AND condicion = 2 GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    //$embarazoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='GINECOLOGIA' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    $embMes = $con->query($embarazoMes);
    /*==============================================================================*/

    /*======== CONSULTORIO 1========================================================*/
    $consultorio1Mes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='CONSULTA GENERAL DE URGENCIAS' AND YEAR(fechahorarecep) = YEAR(curdate()) AND condicion = 2 GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    //$consultorio1Mes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala='CONSULTA GENERAL DE URGENCIAS' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    $cons1Mes = $con->query($consultorio1Mes);
    /*==============================================================================*/

    /*======== CONTROL TERMICO Y ENCAMADOS =========================================*/
    $control_encamadosMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala<>'CONSULTA GENERAL DE URGENCIAS' AND sala<>'GINECOLOGIA' AND sala<>'CLINICA DE HERIDAS' AND YEAR(fechahorarecep) = YEAR(curdate()) AND condicion = 2 GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    //$control_encamadosMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS emb FROM recepciones WHERE sala<>'CONSULTA GENERAL DE URGENCIAS' AND sala<>'GINECOLOGIA' AND sala<>'CLINICA DE HERIDAS' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";

    $otrosMes = $con->query($control_encamadosMes);
    /*==============================================================================*/

    /*========RECEPCIONES CLINICA DE HERIDAS========================================*/
    $rCheridas = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS clinheridas FROM recepciones WHERE sala LIKE 'CLINICA DE HERIDAS' AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $rClinicaHeridas = $con->query($rCheridas);
    /*==============================================================================*/

     /*=================== LESIONES POR MES ========================================*/
     $ClesionesMes = "SELECT MonthName(c.fechaingreso) AS mes, YEAR(c.fechaingreso) AS anio, count(*) AS lesiones FROM lesiones l INNER JOIN consultas c ON l.idconsulta = c.idconsulta WHERE YEAR(c.fechaingreso) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(c.fechaingreso) DESC, MONTH(c.fechaingreso) DESC";
     $cLesionesXmes = $con->query($ClesionesMes);
     /*==============================================================================*/

    /*========NO SE PRESENTO POR MES=========================================================*/
    $nosepresentoMes = "SELECT MonthName(fechahorarecep) AS mes, YEAR(fechahorarecep) AS anio, count(*) AS nsp FROM recepciones WHERE condicion=3 AND YEAR(fechahorarecep) = YEAR(curdate()) GROUP BY mes ORDER BY YEAR(fechahorarecep) DESC, MONTH(fechahorarecep) DESC";
    $nspMes = $con->query($nosepresentoMes);
    /*==============================================================================*/

    /*======== RECEPCIONES POR AÑO =================================================*/
    $rPa = "SELECT YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones GROUP BY anio ORDER BY YEAR(fechahorarecep) DESC";
    $recepcionesPorAnio = $con->query($rPa);
    /*==============================================================================*/

    /*======== RECEPCIONES POR AÑO GINECOLOGIA ======================================*/
    $rPaE = "SELECT YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE sala='GINECOLOGIA' GROUP BY anio ORDER BY YEAR(fechahorarecep) DESC";
    $recepcionesPorAnioEmbarazo = $con->query($rPaE);
    /*==============================================================================*/

    /*======== RECEPCIONES POR AÑO URGENCIAS ========================================*/
    $rPaU = "SELECT YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE sala<>'GINECOLOGIA' AND sala<>'CLINICA DE HERIDAS' GROUP BY anio ORDER BY YEAR(fechahorarecep) DESC";
    $recepcionesPorAnioUrgencias = $con->query($rPaU);
    /*==============================================================================*/

    /*======== CLINICA DE HERIDAS POR AÑO ==========================================*/
    $rPaCHeridas = "SELECT YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE sala='CLINICA DE HERIDAS' GROUP BY anio ORDER BY YEAR(fechahorarecep) DESC";
    $recepcionesPorAnioCHeridas = $con->query($rPaCHeridas);
    /*==============================================================================*/

    /*======== LESIONES POR AÑO ==========================================*/
    $rPaLesiones = "SELECT YEAR(c.fechaingreso) AS anio, count(*) AS total FROM lesiones l INNER JOIN consultas c ON l.idconsulta = c.idconsulta GROUP BY anio ORDER BY YEAR(c.fechaingreso) DESC";
    $lesionesPa = $con->query($rPaLesiones);
    /*==============================================================================*/

    /*======== N.S.P. POR AÑO ==========================================*/
    $rNSPPa = "SELECT YEAR(fechahorarecep) AS anio, count(*) AS total FROM recepciones WHERE condicion = 3 GROUP BY anio ORDER BY YEAR(fechahorarecep) DESC";
    $NSPporAnio = $con->query($rNSPPa);
    /*==============================================================================*/



?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Inicio | <strong>Sistema de Urgencias y Archivo HGS.</strong></h5>
                    </div>
                    <div class="card-body">

                        <h6 class="box-title">Estadísticas</h6>
                        <hr>

                        <!--===========================================================
                        RECEPCIONES HOY
                        ============================================================-->
                        <div class="container">
                            <div class="row justify-content-center">

                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <img src="../../public/img/logohgs.jpg" alt="logohgs" width="201" height="142" style="margin-top: 25px;">
                                    <!--<img class="mb-4" src="public/img/logohgs.jpg" alt="" width="50" height="50">-->
                                </div>

                                <div class="card border-success col-lg-3 col-md-3 col-sm-3">
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

                                <div class="card border-info col-lg-3 col-md-3 col-sm-3">
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

                                <div class="card border-danger col-lg-3 col-md-3 col-sm-3">
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

                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Recepciones por MES</h5>
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
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Consultorio 1 por MES</h5>
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

                            <!--================ GINECOLOGIA POR MES ===================================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Ginecología por MES</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Ginecología</th>
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
                                            <th>Ginecología</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- 12 -->

                            <!--=========== CONTROL TERMICO Y ENCAMADOS POR MES ============-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>Control T. y encamados por MES</h5>
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

                            <!--================ RECEPCIONES CLINICA DE HERIDAS ====================-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>Clínica de heridas por mes</h5>
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
                                        while ($reg = $rClinicaHeridas->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                            <td>"  . $reg['mes'] . "</td>
                                            <td>"  . $reg['anio'] . "</td>
    
                                            <td>" . $reg['clinheridas'] . "</td>";
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

                            <!--================ LESIONES POR MES ====================-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>Lesiones por mes</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Lesiones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $cLesionesXmes->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                            <td>"  . $reg['mes'] . "</td>
                                            <td>"  . $reg['anio'] . "</td>
    
                                            <td>" . $reg['lesiones'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Lesiones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--================ NO SE PRESENTO POR MES ====================-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>N.S.P. por MES</h5>
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

                            <!-- 12 -->

                        </div>

                        <br><br>

                        <div class="row">
                            <!--================ RECEPCIONES POR AÑO ====================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Recepciones por año</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $recepcionesPorAnio->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <!--================ RECEPCIONES POR AÑO EMBARAZO ====================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Recepciones año Ginecología</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $recepcionesPorAnioEmbarazo->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <span style="color: red;">La división de consultorios se realizó a partir del 2022</span>
                            </div>

                            <!--================ RECEPCIONES POR AÑO URGENCIAS ====================-->
                            <div class="table-responsive col-lg-4 col-md-4 col-sm-4">
                                <h5>Recepciones año urgencias</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $recepcionesPorAnioUrgencias->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <span style="color: red;">La división de consultorios se realizó a partir del 2022</span>
                            </div>

                            <!-- 12 -->

                        </div>
                        <br><br>

                        <div class="row">
                            <!--======== RECEPCIONES POR AÑO CLINICA DE HERIDAS ============-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>Clínica heridas por año</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $recepcionesPorAnioCHeridas->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <span style="color: red;">La división de clínica de heridas empezó a finales de 2023</span>
                            </div>

                            <!--======== LESIONES POR AÑO ============-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>Lesiones por año</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $lesionesPa->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <span style="color: red;">Lesiones capturadas en este sistema</span>
                            </div>

                            <!--================ N.S.P. POR AÑO ====================-->
                            <div class="table-responsive col-lg-3 col-md-3 col-sm-3">
                                <h5>N.S.P. por año</h5>
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #757579; color: white;">
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($reg = $NSPporAnio->fetch_array(MYSQLI_BOTH)) {
                                            //setlocale (LC_ALL, "es_MX");
                                            echo "<tr>
                                        <td>"  . $reg['anio'] . "</td>
                                        <td>"  . $reg['total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Año</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- 8 -->

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
                                    <div class="card-header">Consultas N.S.P.</div>
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