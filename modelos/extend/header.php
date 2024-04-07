<?php

session_start();

include "../../conexion/conexion.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Urgencias y Archivo HGS</title>

    <link rel="icon" href="../../public/img/logohgs.jpg">
    
    <?php require_once "scripts.php"; ?>

    <style>
        .error {
            border: solid 2px #ff0000;
        }

        .invalido {
            border: solid 1px red;
            box-shadow: 0 0 10px red;
        }
        
        .valido{
            border: solid 1px greenyellow;
            box-shadow: 0 0 10px greenyellow;
        }

        .errorSpan {
            color: red;
            display: block;
        }
    </style>

    <script src="../../public/js/jquery.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="../../public/img/logohgs.jpg" alt="logos" width="50px" height="35px"> Sis UA HGS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if ($_SESSION['idrol'] == 1) { ?>
            <!-- MENU ADMIN -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuarios/index.php">Usuarios</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reportes Excel C1
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="../consultas/consultasExcel.php">Consultas C1</a>
                            <a class="dropdown-item" href="../lesiones/lesionesExcel.php">Lesiones C1</a>


                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reportes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../reportes/productividad.php">Productividad</a>
                            <a class="dropdown-item" href="../reportes/reporteRecepcion.php">Reporte por Recepcionista</a>
                            <a class="dropdown-item" href="../reportes/reporteConsultados.php">Reportes de Consultas y lesiones</a>
                            <a class="dropdown-item" href="../reportes/reporteNSP.php">Pacientes N.S.P.</a>
                            <a class="dropdown-item" href="../reportes/triageReporte.php">Triages</a>
                            <a class="dropdown-item" href="../reportes/repCons1.php">Consultorio 1</a>

                        </div>
                    </li>
                </ul>

            </div>
            <!-- FIN MENU ADMIN -->

        <?php } elseif ($_SESSION['idrol'] == 2) { ?>

            <!-- MENU MEDICO -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultas/index.php">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultas/consultadosXmedico.php">Consultados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultas/noConsultados.php">No Consultados</a>
                    </li>
                </ul>
            </div>
            <!-- FIN MENU MEDICO -->

        <?php } elseif ($_SESSION['idrol'] == 3) { ?>

            <!-- MENU RECEPCIONISTA -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../pacientes/index.php"><b>Pacientes</b></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../recepcion/index.php">Recepción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../desconocidos/index.php">Desconocidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../reportes/reporteConsultados.php">Consultados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../reportes/reporteNSP.php">No se presentó</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../recepcion/consultorio1.php">Cons1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.curp-gratis.com.mx/consulta-curp" target="_blank">CURP</a>
                    </li>
                </ul>
            </div>
            <!-- FIN MENU RECEPCIONISTA -->

        <?php } elseif ($_SESSION['idrol'] == 4) { ?>
            <!-- MENU EXTERNO -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Estádistica</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reportes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../reportes/repCalidad.php">Dpto. Calidad</a>
                            <a class="dropdown-item" href="../reportes/repCons1.php">Consulta pacientes C1</a>
                            <a class="dropdown-item" href="#">Otros reportes</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- FIN MENU EXTERNO -->

        <?php } elseif ($_SESSION['idrol'] == 5) { ?>
            <!-- MENU TRIAGE -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../triages/index.php">Triage</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../reportes/triageReporte.php">Reportes</a>
                    </li>
                </ul>
            </div>
            <!-- FIN MENU TRIAGE -->

        <?php } elseif ($_SESSION['idrol'] == 6) { ?>
            <!-- MENU ENFERMERIA -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../enfermeria/index.php">Pacientes</a>
                    </li>
                </ul>
            </div>
            <!-- FIN MENU ENFERMERIA -->

        <?php } elseif ($_SESSION['idrol'] == 7) { ?>

            <!-- MENU ARCHIVO -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../archivo/index.php">Expedientes</a>
                    </li>

                    <!-- Menu Consulta Externa -->
                    <li class="nav-item">
                        <a class="nav-link" href="../citasCE/index.php">Citas C.E.</a>
                    </li>
                    <!-- FIN Menu Consulta Externa -->

                    <!-- Citas por fecha -->
                    <li class="nav-item">
                        <a class="nav-link" href="../citasCE/citasXFecha.php">Citas fecha</a>
                    </li>
                    <!-- FIN Citas por fecha -->

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.curp-gratis.com.mx/consulta-curp" target="_blank">CURP</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Otros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../medicos/index.php">Medicos</a>
                            <a class="dropdown-item" href="../servicios/index.php">Servicios</a>
                        </div>
                    </li>
                    
                </ul>
            </div>
            <!-- FIN MENU ARCHIVO -->



        <?php } elseif ($_SESSION['idrol'] == 8) { ?>

            <!-- MENU CONSULTA -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultasadmon/urgenciasindex.php">Urgencias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../consultasadmon/archivoindex.php">Expedientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../reportes/repCons1.php">Consultorio1</a>
                    </li>

                </ul>
            </div>
            <!-- FIN MENU CONSULTA -->


        <?php } elseif ($_SESSION['idrol'] == 9) { ?>

            <!-- MENU REPORTEADOR -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reportes Excel C1
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="../consultas/consultasExcel.php">Consultas C1</a>
                            <a class="dropdown-item" href="../lesiones/lesionesExcel.php">Lesiones C1</a>


                        </div>
                    </li>

                </ul>
            </div>
            <!-- FIN MENU REPORTEADOR -->


        <?php } ?>








        <!-- NOMBRE DEL USUARIO Y SALIDA -->
        <div>
            <ul class="nav navbar-nav ml-auto">
                <li style="padding-right: 3rem; color: white;"><span class="fa fa-user"></span> <?php echo $_SESSION['nombre'] ?></li>
                <li style="padding-right: 3rem; color: white;"><?php echo $_SESSION['nivel'] ?></li>
                <li><a href="../extend/salir.php" class="btn btn-dark btn-sm"><span class="fa fa-sign-out"></span> Salir</a></li>
            </ul>

        </div>

    </nav>