<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

        $fechai = $_POST['fechai'];
        $fechaf = $_POST['fechaf'];

        $recepciones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.medico, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 2 AND DATE(r.fechahorarecep) >= '$fechai' AND DATE(r.fechahorarecep) <= '$fechaf'";

        $resultado = $con->query($recepciones);

        //LESIONES
        $sqlLesiones = "SELECT p.nombre AS paciente, p.sexo, c.fechaingreso, r.edad, r.mtvoconsulta, u.nombre AS medico FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN lesiones l ON l.idconsulta = c.idconsulta INNER JOIN usuarios u ON u.idusuario = c.idusuario WHERE DATE(c.fechaingreso) >= '$fechai' AND DATE(c.fechaingreso) <= '$fechaf'";

        $lesiones = $con->query($sqlLesiones);
    } else {

        $recepciones = "SELECT r.idrecepcion, r.idpaciente, p.nombre, p.sexo, DATE(r.fechahorarecep) as fecha, r.fechahorarecep, r.edad, r.mtvoconsulta, r.embarazo, r.medico, r.semgesta, r.sala, r.referencia, r.observaciones, r.condicion FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente WHERE r.condicion = 2 AND DATE(r.fechahorarecep) = CURDATE()";

        $resultado = $con->query($recepciones);

        $sqlLesiones = "SELECT p.nombre AS paciente, p.sexo, c.fechaingreso, r.edad, r.mtvoconsulta, u.nombre AS medico FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN lesiones l ON l.idconsulta = c.idconsulta INNER JOIN usuarios u ON u.idusuario = c.idusuario WHERE DATE(c.fechaingreso) = CURDATE()";

        $lesiones = $con->query($sqlLesiones);
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Reporte por fecha(s)</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="form-group col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Fecha inicio (*):</label>
                                        <input type="date" class="form-control" name="fechai" id="fechai" min="2019-09-30" value="<?php echo $fechai; ?>" required>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Fecha final (*):</label>
                                        <input type="date" class="form-control" name="fechaf" id="fechaf" min="2019-09-30" value="<?php echo $fechaf; ?>" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-archive"> Recargar tabla con fechas seleccionadas</i></button>
                                    </div>
                                </div>

                            </form>

                            <form action="ConsultasAnioExcel.php" method="get" class="form-group col-lg-3 col-md-3 col-sm-3" id="formConsulta">

                                <!-- CONSULTAS POR AÑO -->
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Consultas por Año (*):</label>
                                    <select name="anioConsultas" id="anioConsultas" onchange='habilitaBtnConsultas(this.value);'>
                                        <option value="">Selecione el año</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-danger" type="submit" onclick="enviarFormConsultas()" id="btnConsultasExcel"><i class="fa fa-archive"> Exportar Consultas Excel</i></button>
                                    </div>
                                </div>
                                

                            </form>


                            <form action="LesionesAnioExcel.php" method="get" class="form-group col-lg-3 col-md-3 col-sm-3" id="formLesion">

                                <!-- LESIONES CONSULTORIO 1 POR AÑO -->
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Lesiones por Año (*):</label>
                                    <select name="anioLesiones" id="anioLesiones" onchange='habilitaBtnLesiones(this.value);'>
                                        <option value="">Selecione el año</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                    </select>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-danger" type="submit" onclick="enviarFormLesiones()" id="btnLesionesExcel"><i class="fa fa-archive"> Exportar Lesiones Excel</i></button>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <hr>

                        <!-- CONSULTAS -->
                        <h6>Consultas</h6>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Embarazo</th>
                                        <th>Semanas</th>
                                        <th>Sala</th>
                                        <th>Motivo consulta</th>
                                        <th>Médico</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($reg['sexo'] == 'Femenino') {

                                            $reg['sexo'] = "F";

                                            if ($reg['embarazo'] == 'NO') {
                                                $reg['semgesta'] = "";
                                            }
                                        } elseif ($reg['sexo'] == 'Masculino') {

                                            $reg['sexo'] = "M";
                                            $reg['embarazo'] = '';
                                            $reg['semgesta'] = '';
                                        }

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($reg['fechahorarecep'])) . "</td>
                                        <td>" . $reg['nombre'] . "</td>
                                        <td>" . $reg['sexo'] . "</td>
                                        <td>" . $reg['edad'] . "</td>
                                        <td>" . $reg['embarazo'] . "</td>
                                        <td>" . $reg['semgesta'] . "</td>
                                        <td>" . $reg['sala'] . "</td>
                                        <td>" . $reg['mtvoconsulta'] . "</td>
                                        <td>" . $reg['medico'] . "</td>
                                        <td>" . $reg['observaciones'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Embarazo</th>
                                    <th>Semanas</th>
                                    <th>Sala</th>
                                    <th>Motivo consulta</th>
                                    <th>Médico</th>
                                    <th>Observaciones</th>
                                </tfoot>
                            </table>
                        </div>

                        <!-- LESIONES -->

                        <hr>

                        <h6>Lesiones</h6>
                        <div class="table-responsive display nowrap" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                        <th>Motivo consulta</th>
                                        <th>Médico</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($lesion = $lesiones->fetch_array(MYSQLI_BOTH)) {

                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($lesion['sexo'] == 'Femenino') {

                                            $lesion['sexo'] = "F";
                                        } elseif ($lesion['sexo'] == 'Masculino') {

                                            $lesion['sexo'] = "M";
                                        }

                                        echo "<tr>
                                        <td>" . date("d-m-Y H:i:s", strtotime($lesion['fechaingreso'])) . "</td>
                                        <td>" . $lesion['paciente'] . "</td>
                                        <td>" . $lesion['sexo'] . "</td>
                                        <td>" . $lesion['edad'] . "</td>
                                        <td>" . $lesion['mtvoconsulta'] . "</td>
                                        <td>" . $lesion['medico'] . "</td>
                                        </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Motivo consulta</th>
                                    <th>Médico</th>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>

        let formConsulta = document.getElementById("formConsulta");
        let formLesion = document.getElementById("formLesion");

        let anioConsultas = document.getElementById("anioConsultas");
        let anioLesiones = document.getElementById("anioLesiones");
        
        //Se deshabilita el boton de exportar las consultas por año a excel
        let btnConsultasExcel = document.getElementById('btnConsultasExcel');
        btnConsultasExcel.disabled = true;

         //Se deshabilita el boton de exportar las lesiones por año a excel
         let btnLesionesExcel = document.getElementById('btnLesionesExcel');
        btnLesionesExcel.disabled = true;

        //Se habilita el boton de exportar las consultas por año a excel
        function habilitaBtnConsultas(){
            if (anioConsultas.value != "") {
                btnConsultasExcel.disabled = false;
            }else{
                btnConsultasExcel.disabled = true;
            }
        }

        //Se habilita el boton de exportar las consultas por año a excel
        function habilitaBtnLesiones(){
            if (anioLesiones.value != "") {
                btnLesionesExcel.disabled = false;
            }else{
                btnLesionesExcel.disabled = true;
            }
        }

        function enviarFormConsultas() {

            let mensajesError = [];

            if (anioConsultas.value == null || anioConsultas.value == "") {
                document.getElementById("anioConsultas").style.backgroundColor = "red";
                document.getElementById("anioConsultas").style.color = "white";
                document.getElementById("anioConsultas").focus();
                //mensajesError.push("Seleccione un año");
                return false;
            }

            //errorConsultas.innerHTML = mensajesError.join(", ");

            return false;

        }

        function enviarFormLesiones() {

            let mensajesError = [];

            if (anioLesiones.value == null || anioLesiones.value == "") {
                document.getElementById("anioLesiones").style.backgroundColor = "red";
                document.getElementById("anioLesiones").style.color = "white";
                document.getElementById("anioLesiones").focus();
                //mensajesError.push("Seleccione un año");
                return false;
            }

            //errorConsultas.innerHTML = mensajesError.join(", ");

            return false;

        }


    </script>

    </body>

    </html>

<?php
}

$resultado = null;
ob_end_flush();
?>