<?php

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    $id = $_GET['idc'];

    $sql = "SELECT r.idrecepcion, p.idpaciente, p.nombre, p.entidaddom, p.municipio, p.localidad, p.domicilio, p.colonia, p.cp, r.edad, p.sexo, r.mtvoconsulta, c.fechaingreso, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.causaext FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion WHERE c.idconsulta = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //================ VARIABLES DE DOMICILIO ================================================

    $var_entidaddom = $fila["entidaddom"];
    $var_municipio = $fila["municipio"];
    $var_localidad = $fila["localidad"];
    $var_domicilio = $fila["domicilio"];
    $var_colonia = $fila["colonia"];
    $var_cp = $fila["cp"];

    $fechaingreso = $fila["fechaingreso"];

    //===========================================================================

    //Captura de datos
    if (!empty($_POST)) {

        $idconsulta = isset($_POST["idconsulta"]) ? mysqli_real_escape_string($con, $_POST['idconsulta']) : "";
        $escolaridad = isset($_POST["escolaridad"]) ? mysqli_real_escape_string($con, $_POST['escolaridad']) : "";
        $leerescribir = isset($_POST["leerescribir"]) ? mysqli_real_escape_string($con, $_POST['leerescribir']) : "";
        $discapacidad = isset($_POST["discapacidad"]) ? mysqli_real_escape_string($con, $_POST['discapacidad']) : "";
        $referidopor = isset($_POST["referidopor"]) ? mysqli_real_escape_string($con, $_POST['referidopor']) : "";
        $nombre_unidad = isset($_POST["nombre_unidad"]) ? mysqli_real_escape_string($con, $_POST['nombre_unidad']) : "";
        $fecha_ocurrencia = isset($_POST["fecha_ocurrencia"]) ? mysqli_real_escape_string($con, $_POST['fecha_ocurrencia']) : "";
        $diafestivo = isset($_POST["diafestivo"]) ? mysqli_real_escape_string($con, $_POST['diafestivo']) : "";
        $sitio_ocurrencia = isset($_POST["sitio_ocurrencia"]) ? mysqli_real_escape_string($con, $_POST['sitio_ocurrencia']) : "";
        $sitio_ocurrencia_otro = isset($_POST["sitio_ocurrencia_otro"]) ? mysqli_real_escape_string($con, $_POST['sitio_ocurrencia_otro']) : "";
        $lesion_entidad = isset($_POST["lesion_entidad"]) ? mysqli_real_escape_string($con, $_POST['lesion_entidad']) : "";
        $lesion_municipio = isset($_POST["lesion_municipio"]) ? mysqli_real_escape_string($con, $_POST['lesion_municipio']) : "";
        $lesion_localidad = isset($_POST["lesion_localidad"]) ? mysqli_real_escape_string($con, $_POST['lesion_localidad']) : "";
        $lesion_cp = isset($_POST["lesion_cp"]) ? mysqli_real_escape_string($con, $_POST['lesion_cp']) : "";
        $lesion_domicilio = isset($_POST["lesion_domicilio"]) ? mysqli_real_escape_string($con, $_POST['lesion_domicilio']) : "";
        $lesion_colonia = isset($_POST["lesion_colonia"]) ? mysqli_real_escape_string($con, $_POST['lesion_colonia']) : "";
        $intensionalidad = isset($_POST["intensionalidad"]) ? mysqli_real_escape_string($con, $_POST['intensionalidad']) : "";
        $agente_lesion = isset($_POST["agente_lesion"]) ? mysqli_real_escape_string($con, $_POST['agente_lesion']) : "";
        $agente_otro = isset($_POST["agente_otro"]) ? mysqli_real_escape_string($con, $_POST['agente_otro']) : "";
        $toxicomanias = isset($_POST["toxicomanias"]) ? mysqli_real_escape_string($con, $_POST['toxicomanias']) : "";
        $otras_toxicomanias = isset($_POST["otras_toxicomanias"]) ? mysqli_real_escape_string($con, $_POST['otras_toxicomanias']) : "";

        //======================== VEHICULO DE MOTOR =======================================
        $lesionad_es = isset($_POST["lesionad_es"]) ? mysqli_real_escape_string($con, $_POST['lesionad_es']) : "";
        $equipo_seguridad = isset($_POST["equipo_seguridad"]) ? mysqli_real_escape_string($con, $_POST['equipo_seguridad']) : "";
        $que_eq_seguridad = isset($_POST["que_eq_seguridad"]) ? mysqli_real_escape_string($con, $_POST['que_eq_seguridad']) : "";
        $otro_eq_seguridad = isset($_POST["otro_eq_seguridad"]) ? mysqli_real_escape_string($con, $_POST['otro_eq_seguridad']) : "";

        //======================== VIOLENCIA ===============================================
        $tipo_violencia = isset($_POST["tipo_violencia"]) ? mysqli_real_escape_string($con, $_POST['tipo_violencia']) : "";
        $num_agresores = isset($_POST["num_agresores"]) ? mysqli_real_escape_string($con, $_POST['num_agresores']) : "";
        $parentesco_afectado = isset($_POST["parentesco_afectado"]) ? mysqli_real_escape_string($con, $_POST['parentesco_afectado']) : "";
        $sexo_agresor = isset($_POST["sexo_agresor"]) ? mysqli_real_escape_string($con, $_POST['sexo_agresor']) : "";
        $edad_agresor = isset($_POST["edad_agresor"]) ? mysqli_real_escape_string($con, $_POST['edad_agresor']) : "";
        $bajoefectos_agresor = isset($_POST["bajoefectos_agresor"]) ? mysqli_real_escape_string($con, $_POST['bajoefectos_agresor']) : "";
        $evento_autoinflingido = isset($_POST["evento_autoinflingido"]) ? mysqli_real_escape_string($con, $_POST['evento_autoinflingido']) : "";

        //======================================================================================
        $servicio = isset($_POST["servicio"]) ? mysqli_real_escape_string($con, $_POST['servicio']) : "";
        $otro_servicio = isset($_POST["otro_servicio"]) ? mysqli_real_escape_string($con, $_POST['otro_servicio']) : "";
        $tipoatencion = isset($_POST["tipoatencion"]) ? mysqli_real_escape_string($con, $_POST['tipoatencion']) : "";
        $otro_tipoatencion = isset($_POST["otro_tipoatencion"]) ? mysqli_real_escape_string($con, $_POST['otro_tipoatencion']) : "";
        $areaanatomica = isset($_POST["areaanatomica"]) ? mysqli_real_escape_string($con, $_POST['areaanatomica']) : "";
        $consec_resultante = isset($_POST["consec_resultante"]) ? mysqli_real_escape_string($con, $_POST['consec_resultante']) : "";
        $causaexterna = isset($_POST["causaexterna"]) ? mysqli_real_escape_string($con, $_POST['causaexterna']) : "";


        $idusuario = $_SESSION['idusuario'];



        /* VALIDACION DE DATOS */

            //======= Realizamos la inserción de los datos =========
            $sql_lesiones = "INSERT INTO lesiones (idconsulta, escolaridad, leerescribir, discapacidad, referidopor, nombre_unidad, fecha_ocurrencia, diafestivo, sitio_ocurrencia, sitio_ocurrencia_otro, lesion_entidad, lesion_municipio, lesion_localidad, lesion_cp, lesion_domicilio, lesion_colonia, intensionalidad, agente_lesion, agente_otro, toxicomanias, otras_toxicomanias, lesionad_es, equipo_seguridad, que_eq_seguridad, otro_eq_seguridad, tipo_violencia, num_agresores, parentesco_afectado, sexo_agresor, edad_agresor, bajoefectos_agresor, evento_autoinflingido, servicio, otro_servicio, tipoatencion, otro_tipoatencion, areaanatomica, consec_resultante, causaexterna, condicion, idusuario) VALUES ('$idconsulta', '$escolaridad', '$leerescribir', '$discapacidad', '$referidopor', '$nombre_unidad', '$fecha_ocurrencia', '$diafestivo', '$sitio_ocurrencia', '$sitio_ocurrencia_otro', '$lesion_entidad', '$lesion_municipio', '$lesion_localidad', '$lesion_cp', '$lesion_domicilio', '$lesion_colonia', '$intensionalidad', '$agente_lesion', '$agente_otro', '$toxicomanias', '$otras_toxicomanias', '$lesionad_es', '$equipo_seguridad', '$que_eq_seguridad', '$otro_eq_seguridad', '$tipo_violencia', '$num_agresores', '$parentesco_afectado', '$sexo_agresor', '$edad_agresor', '$bajoefectos_agresor', '$evento_autoinflingido', '$servicio', '$otro_servicio', '$tipoatencion', '$otro_tipoatencion', '$areaanatomica', '$consec_resultante', '$causaexterna', '1', '$idusuario')";

            $insLesiones = $con->query($sql_lesiones);


            //Editamos la tabla consultas el campo cap_lesiones con valor 1
            $sql_caplesion = "UPDATE consultas SET cap_lesion = '1' WHERE idconsulta = '$idconsulta'";

            $caplesion = $con->query($sql_caplesion);


            if ($insLesiones > 0 && $caplesion > 0) {
                //NO HAY INDEX EN PAGINA DE LESIONES

                echo "<script>
                alert('La captura de lesiones se guardo con exito');
                window.location = '../consultas/index.php';
                    </script>";
            } else {

                echo "<script>
                alert('Error al guardar la captura de lesiones');
                window.location = '../consultas/index.php';
                    </script>";
            }

            $insLesiones->close();
            $con->close();
        
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">

                        <h5>HOJA DE LESIONES</h5>
                        <hr>
                        <div style="color: red;">
                            <h5>Este apartado de lesiones está aún en fase de prueba, favor de reportar cualquier "anomalía" al dr. Iván o al departamento de estadística. Gracias</h5>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <form id="formLesion" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                                <div class="row">

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>Datos del paciente:</h6>
                                    </div>

                                    <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                        <label>Nombre:</label>
                                        <input type="hidden" name="idconsulta" id="idconsulta" value="<?php echo $id; ?>">
                                        <input type="hidden" name="idpaciente" value="<?php echo $fila['idpaciente']; ?>">
                                        <input type="text" name="nombrep" id="nombrep" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Sexo:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['sexo']; ?>" readonly name="sexo" id="sexo">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Edad:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['edad']; ?>" readonly name="edad" id="edad">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Motivo de la consulta:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['mtvoconsulta']; ?>" readonly name="mtvoconsulta" id="mtvoconsulta">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>DIAGNOSTICOS</h6>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <label>Diagnostico 1:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['afecprincipal']; ?>" readonly>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <label>Diagnostico 2:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['comorbilidad1']; ?>" readonly>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <label>Diagnostico 3:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['comorbilidad2']; ?>" readonly>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <label>Diagnostico 4:</label>
                                        <input type="text" class="form-control" value="<?php echo $fila['comorbilidad3']; ?>" readonly>
                                    </div>

                                    <!-- 12 -->

                                    <!-- LESIONES Y CAUSAS DE VIOLENCIA -->

                                    <div class="form-group col-lg-9 col-md-9 col-sm-9">
                                        <h6>LESIONES Y CAUSAS DE VIOLENCIA</h6>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label for="fechainicio" style="color: red;">Fecha y hora de inicio de la consulta: </label>
                                        <input type="datetime-local" style="background-color: black; color:white;" id="fechainicio" name="fechainicio" value="<?php echo date("Y-m-d H:i:s", strtotime($fechaingreso)); ?>" readonly>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Escolaridad (*):</label>
                                        <select class='form-control' name='escolaridad' id='escolaridad' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='NINGUNA'>NINGUNA</option>
                                            <option value='PRIMARIA COMPLETA'>PRIMARIA COMPLETA</option>
                                            <option value='PRIMARIA INCOMPLETA'>PRIMARIA INCOMPLETA</option>
                                            <option value='SECUNDARIA COMPLETA'>SECUNDARIA COMPLETA</option>
                                            <option value='SECUNDARIA INCOMPLETA'>SECUNDARIA INCOMPLETA</option>
                                            <option value='BACHILLERATO O PREPARATORIA COMPLETA'>BACHILLERATO O PREPARATORIA COMPLETA</option>
                                            <option value='BACHILLERATO O PREPARATORIA INCOMPLETA'>BACHILLERATO O PREPARATORIA INCOMPLETA</option>
                                            <option value='LICENCIATURA O PROFESIONAL COMPLETO'>LICENCIATURA O PROFESIONAL COMPLETO</option>
                                            <option value='LICENCIATURA O PROFESIONAL INCOMPLETO'>LICENCIATURA O PROFESIONAL INCOMPLETO</option>
                                            <option value='NO APLICA'>NO APLICA</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                            <option value='POSGRADO COMPLETO'>POSGRADO COMPLETO</option>
                                            <option value='POSGRADO INCOMPLETO'>POSGRADO INCOMPLETO</option>
                                            <option value='PREESCOLAR COMPLETA'>PREESCOLAR COMPLETA</option>
                                            <option value='PREESCOLAR INCOMPLETA'>PREESCOLAR INCOMPLETA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Sabe leer y escribir? (*):</label>
                                        <select class='form-control' name='leerescribir' id='leerescribir' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>¿Tiene alguna discapacidad preexistente? (*):</label>
                                        <select class='form-control' name='discapacidad' id='discapacidad' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Usuario referido por (*):</label>
                                        <select class='form-control' name='referidopor' id='referidopor' onchange='mostrarReferido(this.value);' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='UNIDAD MEDICA'>UNIDAD MEDICA</option>
                                            <option value='PROCURACIÓN DE JUSTICIA'>PROCURACIÓN DE JUSTICIA</option>
                                            <option value='SECRETARÍA DE EDUCACIÓN'>SECRETARÍA DE EDUCACIÓN</option>
                                            <option value='DESARROLLO SOCIAL'>DESARROLLO SOCIAL</option>
                                            <option value='DIF'>DIF</option>
                                            <option value='OTRAS INSTITUCIONES GUBERNAMENTALES'>OTRAS INSTITUCIONES GUBERNAMENTALES</option>
                                            <option value='OTRAS INSTITUCIONES NO GUBERNAMENTALES'>OTRAS INSTITUCIONES NO GUBERNAMENTALES</option>
                                            <option value='SIN REFERENCIA (INICIATIVA PROPIA)'>SIN REFERENCIA (INICIATIVA PROPIA)</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3" id="nombreUnidad">
                                        <label>Nombre de la unidad:</label>
                                        <input type="text" class="form-control" name="nombre_unidad" id="nombre_unidad" maxlength="100" placeholder="Nombre de la unidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label for="fecha_ocurrencia" style="color: red;">Fecha y hora de la ocurrencia(*): </label>
                                        <input type="datetime-local" id="fecha_ocurrencia" name="fecha_ocurrencia" min="2023-06-01T00:00" required>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>¿El día se considera festivo?(*):</label>
                                        <select class='form-control' name='diafestivo' id='diafestivo' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                        <label>¿Sitio de ocurrencia del evento?(*):</label>
                                        <select class='form-control' name='sitio_ocurrencia' id='sitio_ocurrencia' onchange='SitioOcurrencia(this.value);' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='VIVIENDA'>VIVIENDA</option>
                                            <option value='INSTITUCIÓN RESIDENCIAL'>INSTITUCIÓN RESIDENCIAL</option>
                                            <option value='ESCUELA'>ESCUELA</option>
                                            <option value='ÁREA DE DEPORTE Y ATLETISMO'>ÁREA DE DEPORTE Y ATLETISMO</option>
                                            <option value='VÍA PÚBLICA (PEATÓN)'>VÍA PÚBLICA (PEATÓN)</option>
                                            <option value='COMERCIO Y ÁREAS DE SERVICIO'>COMERCIO Y ÁREAS DE SERVICIO</option>
                                            <option value='TRABAJO'>TRABAJO</option>
                                            <option value='GRANJA'>GRANJA</option>
                                            <option value='CLUB, CANTINA, BAR'>CLUB, CANTINA, BAR</option>
                                            <option value='VEHÍCULO AUTOMOTOR PÚBLICO'>VEHÍCULO AUTOMOTOR PÚBLICO</option>
                                            <option value='VEHÍCULO AUTOMOTOR PRIVADO'>VEHÍCULO AUTOMOTOR PRIVADO</option>
                                            <option value='OTRO LUGAR'>OTRO LUGAR</option>
                                            <option value='LUGAR NO ESPECIFICADO'>LUGAR NO ESPECIFICADO</option>
                                            <option value='NO APLICA'>NO APLICA</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4" id="sitioOcurrenciaOtro">
                                        <label>Sitio ocurrencia "otro":</label>
                                        <input type="text" class="form-control" name="sitio_ocurrencia_otro" id="sitio_ocurrencia_otro" maxlength="100" placeholder="Otro lugar" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Entidad federativa (*):</label>
                                        <select class="form-control" name="lesion_entidad" id="lesion_entidad" required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value="COAHUILA">COAHUILA</option>
                                            <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                                            <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                                            <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                                            <option value="CAMPECHE">CAMPECHE</option>
                                            <option value="COLIMA">COLIMA</option>
                                            <option value="CHIAPAS">CHIAPAS</option>
                                            <option value="CHIHUAHUA">CHIHUAHUA</option>
                                            <option value="CIUDAD DE MEXICO">CIUDAD DE MEXICO</option>
                                            <option value="DURANGO">DURANGO</option>
                                            <option value="GUANAJUATO">GUANAJUATO</option>
                                            <option value="GUERRERO">GUERRERO</option>
                                            <option value="HIDALGO">HIDALGO</option>
                                            <option value="JALISCO">JALISCO</option>
                                            <option value="MEXICO">MEXICO</option>
                                            <option value="MICHOACAN">MICHOACAN</option>
                                            <option value="MORELOS">MORELOS</option>
                                            <option value="NAYARIT">NAYARIT</option>
                                            <option value="NUEVO LEON">NUEVO LEON</option>
                                            <option value="OAXACA">OAXACA</option>
                                            <option value="PUEBLA">PUEBLA</option>
                                            <option value="QUERETARO">QUERETARO</option>
                                            <option value="QUINTANA ROO">QUINTANA ROO</option>
                                            <option value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
                                            <option value="SINALOA">SINALOA</option>
                                            <option value="SONORA">SONORA</option>
                                            <option value="TABASCO">TABASCO</option>
                                            <option value="TAMAULIPAS">TAMAULIPAS</option>
                                            <option value="TLAXCALA">TLAXCALA</option>
                                            <option value="VERACRUZ">VERACRUZ</option>
                                            <option value="YUCATAN">YUCATAN</option>
                                            <option value="ZACATECAS">ZACATECAS</option>
                                            <option value="E.E.U.U.">E.E.U.U.</option>
                                            <option value="OTROS PAISES DE LATAM">OTROS PAISES DE LATAM</option>
                                            <option value="OTROS PAISES">OTROS PAISES</option>
                                            <option value="NO ESPECIFICADO">NO ESPECIFICADO</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Municipio (*):</label>
                                        <input type="text" class="form-control" name="lesion_municipio" id="lesion_municipio" maxlength="100" placeholder="Municipio" required onblur="may(this.value, this.id)" value="SALTILLO">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Localidad (*):</label>
                                        <input type="text" class="form-control" name="lesion_localidad" id="lesion_localidad" maxlength="100" placeholder="Localidad" required onblur="may(this.value, this.id)" value="SALTILLO">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <label>C.P.:</label>
                                        <input type="text" class="form-control" name="lesion_cp" id="lesion_cp" maxlength="5" placeholder="código postal" pattern="[0-9]{5}">
                                        <span></span>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                        <label>Domicilio (*):</label>
                                        <input type="text" class="form-control" name="lesion_domicilio" id="lesion_domicilio" maxlength="100" placeholder="Domicilio" required onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <label>Colonia (*):</label>
                                        <input type="text" class="form-control" name="lesion_colonia" id="lesion_colonia" maxlength="100" placeholder="Colonia" required onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6><strong>Circunstancias en las que ocurrió el evento</strong></h6>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Intencionalidad(*):</label>
                                        <select class='form-control' name='intensionalidad' id='intensionalidad' onchange='mostrarViolencia(this.value);' required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value='ACCIDENTAL'>ACCIDENTAL</option>
                                            <option value='VIOLENCIA FAMILIAR'>VIOLENCIA FAMILIAR</option>
                                            <option value='VIOLENCIA NO FAMILIAR'>VIOLENCIA NO FAMILIAR</option>
                                            <option value='AUTO INFLIGIDO'>AUTO INFLIGIDO</option>
                                            <option value='TRATA DE PERSONAS'>TRATA DE PERSONAS</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                        <label>¿Agente de la lesión?(*):</label>
                                        <select class='form-control' name='agente_lesion' id='agente_lesion' onchange='mostrarAccidente(this.value);' required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value='FUEGO, FLAMA, SUSTANCIA CALIENTE/VAPOR'>FUEGO, FLAMA, SUSTANCIA CALIENTE/VAPOR</option>
                                            <option value='INTOXICACIÓN POR DROGAS O MEDICAMENTOS'>INTOXICACIÓN POR DROGAS O MEDICAMENTOS</option>
                                            <option value='PIE O MANO'>PIE O MANO</option>
                                            <option value='CAÍDA'>CAÍDA</option>
                                            <option value='OBJETO CONTUNDENTE'>OBJETO CONTUNDENTE</option>
                                            <option value='OBJETO PUNZO CORTANTE'>OBJETO PUNZO CORTANTE</option>
                                            <option value='GOLPE CONTRA PISO O PARED'>GOLPE CONTRA PISO O PARED</option>
                                            <option value='CUERPO EXTRAÑO'>CUERPO EXTRAÑO</option>
                                            <option value='EXPLOSIÓN'>EXPLOSIÓN</option>
                                            <option value='ASFIXIA O SOFOCACIÓN'>ASFIXIA O SOFOCACIÓN</option>
                                            <option value='MÚLTIPLES AGENTES'>MÚLTIPLES AGENTES</option>
                                            <option value='PROYECTIL DE ARMA DE FUEGO'>PROYECTIL DE ARMA DE FUEGO</option>
                                            <option value='AHORCAMIENTO'>AHORCAMIENTO</option>
                                            <option value='RADIACIÓN'>RADIACIÓN</option>
                                            <option value='SUSTANCIAS QUÍMICAS'>SUSTANCIAS QUÍMICAS</option>
                                            <option value='CORRIENTE ELÉCTRICA'>CORRIENTE ELÉCTRICA</option>
                                            <option value='HERRAMIENTA O MAQUINARIA'>HERRAMIENTA O MAQUINARIA</option>
                                            <option value='SACUDIDAS'>SACUDIDAS</option>
                                            <option value='DESASTRE NATURAL'>DESASTRE NATURAL</option>
                                            <option value='VEHÍCULO DE MOTOR'>VEHÍCULO DE MOTOR</option>
                                            <option value='AHOGAMIENTO POR SUMERSIÓN'>AHOGAMIENTO POR SUMERSIÓN</option>
                                            <option value='PIQUETE/MORDEDURA DE ANIMAL'>PIQUETE/MORDEDURA DE ANIMAL</option>
                                            <option value='FUERZAS DE LA NATURALEZA'>FUERZAS DE LA NATURALEZA</option>
                                            <option value='INTOXICACIÓN POR PLANTAS, HONGOS VENENOSOS'>INTOXICACIÓN POR PLANTAS, HONGOS VENENOSOS</option>
                                            <option value='OTRA'>OTRA</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                            <option value='NO APLICA'>NO APLICA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="agenteOtro">
                                        <label>Otra especifique:</label>
                                        <input type="text" class="form-control" name="agente_otro" id="agente_otro" maxlength="100" placeholder="Colonia" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Se sospecha que el paciente estaba bajo efectos de:(*):</label>
                                        <select class='form-control' name='toxicomanias' id='toxicomanias' required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value='ALCOHOL'>ALCOHOL</option>
                                            <option value='DROGA POR INDICACIÓN MEDICA'>DROGA POR INDICACIÓN MEDICA</option>
                                            <option value='DROGAS ILEGALES'>DROGAS ILEGALES</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                            <option value='NINGUNA'>NINGUNA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Otras especifique:</label>
                                        <input type="text" class="form-control" name="otras_toxicomanias" id="otras_toxicomanias" maxlength="100" placeholder="Otras de las anteriores" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <!-- ==================== VEHICULO DE MOTOR =================== -->
                                    <div class="row" id="vehiculoMotor">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <h6><strong>Accidente</strong></h6>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>La/El Lesionada(o) es:</label>
                                            <select class='form-control' name='lesionad_es' id='lesionad_es'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='CONDUCTOR'>CONDUCTOR</option>
                                                <option value='OCUPANTE'>OCUPANTE</option>
                                                <option value='PEATÓN'>PEATÓN</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Usó equipo de seguridad:</label>
                                            <select class='form-control' name='equipo_seguridad' id='equipo_seguridad' onchange='equipoSeguridad(this.value);'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='SI'>SI</option>
                                                <option value='NO'>NO</option>
                                                <option value='SE IGNORA'>SE IGNORA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>¿Qué equipo de seguridad utilizó?:</label>
                                            <select class='form-control' name='que_eq_seguridad' id='que_eq_seguridad' onchange='otroEquipoSeguridad(this.value);'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='CINTURÓN DE SEGURIDAD'>CINTURÓN DE SEGURIDAD</option>
                                                <option value='CASCO'>CASCO</option>
                                                <option value='SILLÍN PORTA INFANTE'>SILLÍN PORTA INFANTE</option>
                                                <option value='OTRO'>OTRO</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="otroEquipoTxt">
                                            <label>Otro especifique:</label>
                                            <input type="text" class="form-control" name="otro_eq_seguridad" id="otro_eq_seguridad" maxlength="100" placeholder="Otras de las anteriores" onblur="may(this.value, this.id)">
                                        </div>
                                    </div>

                                    <!-- 12 -->

                                    <!-- ==================== VIOLENCIAS =================== -->
                                    <div class="row" id="violencia">

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <h6><strong>Violencia</strong></h6>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Tipo de violencia:</label>
                                            <select class='form-control' name='tipo_violencia' id='tipo_violencia'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='VIOLENCIA FÍSICA'>VIOLENCIA FÍSICA</option>
                                                <option value='VIOLENCIA SEXUAL'>VIOLENCIA SEXUAL</option>
                                                <option value='VIOLENCIA PSICOLÓGICA'>VIOLENCIA PSICOLÓGICA</option>
                                                <option value='VIOLENCIA ECONÓMICA/PATRIMONIAL'>VIOLENCIA ECONÓMICA/PATRIMONIAL</option>
                                                <option value='ABANDONO Y/O NEGLIGENCIA'>ABANDONO Y/O NEGLIGENCIA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Num. de agresores:</label>
                                            <select class='form-control' name='num_agresores' id='num_agresores'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='UNICA(O)'>UNICA(O)</option>
                                                <option value='MÁS DE UNA(O)'>MÁS DE UNA(O)</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Parentesco con la/el afectada(o):</label>
                                            <select class='form-control' name='parentesco_afectado' id='parentesco_afectado'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='NO ESPECIFICADO'>NO ESPECIFICADO</option>
                                                <option value='PADRE'>PADRE</option>
                                                <option value='MADRE'>MADRE</option>
                                                <option value='CÓNYUGE/PAREJA/NOVIA(O)'>CÓNYUGE/PAREJA/NOVIA(O)</option>
                                                <option value='OTRO PARIENTE'>OTRO PARIENTE</option>
                                                <option value='PADRASTRO'>PADRASTRO</option>
                                                <option value='MADRASTRA'>MADRASTRA</option>
                                                <option value='HIJA/HIJO'>HIJA/HIJO</option>
                                                <option value='CONOCIDO SIN PARENTESCO'>CONOCIDO SIN PARENTESCO</option>
                                                <option value='DESCONOCIDO'>DESCONOCIDO</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Sexo del/la agresor(a):</label>
                                            <select class='form-control' name='sexo_agresor' id='sexo_agresor'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='HOMBRE'>HOMBRE</option>
                                                <option value='MUJER'>MUJER</option>
                                                <option value='INTERSEXUAL'>INTERSEXUAL</option>
                                                <option value='SE IGNORA'>SE IGNORA</option>
                                                <option value='NO ESPECIFICADO'>NO ESPECIFICADO</option>
                                            </select>
                                        </div>

                                        <!-- 12 value="<?php //echo isset($leerescribir)?$leerescribir:""; ?>"-->

                                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <label>Edad del/la agresor(a):</label>
                                            <input type="text" class="form-control" name="edad_agresor" id="edad_agresor" maxlength="3" placeholder="Edad agresor" pattern="[0-9]{1,3}">
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                            <label>El/la agreso(a) se sospecha que actuó bajo los efectos de:</label>
                                            <select class='form-control' name='bajoefectos_agresor' id='bajoefectos_agresor'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='ALCOHOL'>ALCOHOL</option>
                                                <option value='DROGA POR INDICACIÓN MÉDICA'>DROGA POR INDICACIÓN MÉDICA</option>
                                                <option value='DROGAS ILEGALES'>DROGAS ILEGALES</option>
                                                <option value='SE IGNORA'>SE IGNORA</option>
                                                <option value='NINGUNA'>NINGUNA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                            <label>En caso de evento autoinfligido, el evento ocurrió:</label>
                                            <select class='form-control' name='evento_autoinflingido' id='evento_autoinflingido'>
                                                <option value="" disabled selected>Elija una opción</option>
                                                <option value='ÚNICA VEZ'>ÚNICA VEZ</option>
                                                <option value='REPETIDO'>REPETIDO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6><strong>Atencíon médica</strong></h6>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Servicio que otorgó la atención:(*):</label>
                                        <select class='form-control' name='servicio' id='servicio' onchange='otroServicio(this.value);' required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value='URGENCIAS'>URGENCIAS</option>
                                            <option value='CONSULTA EXTERNA'>CONSULTA EXTERNA</option>
                                            <option value='HOSPITALIZACIÓN'>HOSPITALIZACIÓN</option>
                                            <option value='SERVICIO ESPECIALIZADO DE ATENCIÓN A LA VIOLENCIA'>SERVICIO ESPECIALIZADO DE ATENCIÓN A LA VIOLENCIA</option>
                                            <option value='OTRO SERVICIO'>OTRO SERVICIO</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="otroServicio">
                                        <label>Especifique el servicio:</label>
                                        <input type="text" class="form-control" name="otro_servicio" id="otro_servicio" maxlength="50" placeholder="Especifique el servicio" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Tipo de atención:(*):</label>
                                        <select class='form-control' name='tipoatencion' id='tipoatencion' required>
                                            <option value="" disabled selected>Elija una opción</option>
                                            <option value='TRATAMIENTO MÉDICO'>TRATAMIENTO MÉDICO</option>
                                            <option value='TRATAMIENTO PSICOLÓGICO'>TRATAMIENTO PSICOLÓGICO</option>
                                            <option value='TRATAMIENTO QUIRÚRGICO'>TRATAMIENTO QUIRÚRGICO</option>
                                            <option value='TRATAMIENTO PSIQUIÁTRICO'>TRATAMIENTO PSIQUIÁTRICO</option>
                                            <option value='CONSEJERÍA'>CONSEJERÍA</option>
                                            <option value='OTRO'>OTRO</option>
                                            <option value='PÍLDORA ANTICONCEPTIVA DE EMERGENCIA'>PÍLDORA ANTICONCEPTIVA DE EMERGENCIA</option>
                                            <option value='PROFILAXIS VIH'>PROFILAXIS VIH</option>
                                            <option value='PROFILAXIS OTRAS ITS'>PROFILAXIS OTRAS ITS</option>
                                            <option value='IVE (INTERRUPCIÓN VOLUNTARIA DEL EMBARAZO)'>IVE (INTERRUPCIÓN VOLUNTARIA DEL EMBARAZO)</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Otros tipos de atención, especifique:</label>
                                        <input type="text" class="form-control" name="otro_tipoatencion" id="otro_tipoatencion" maxlength="100" placeholder="Otros tipos" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Área anatómica de mayor gravedad:(*):</label>
                                        <select class='form-control' name='areaanatomica' id='areaanatomica' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='CABEZA'>CABEZA</option>
                                            <option value='CARA'>CARA</option>
                                            <option value='REGIÓN OCULAR'>REGIÓN OCULAR</option>
                                            <option value='CUELLO'>CUELLO</option>
                                            <option value='COLUMNA VERTEBRAL'>COLUMNA VERTEBRAL</option>
                                            <option value='EXTREMIDADES SUPERIORES'>EXTREMIDADES SUPERIORES</option>
                                            <option value='MANO'>MANO</option>
                                            <option value='TÓRAX'>TÓRAX</option>
                                            <option value='ESPALDA Y/O GLÚTEOS'>ESPALDA Y/O GLÚTEOS</option>
                                            <option value='ABDOMEN'>ABDOMEN</option>
                                            <option value='PELVIS'>PELVIS</option>
                                            <option value='REGIÓN GENITAL'>REGIÓN GENITAL</option>
                                            <option value='EXTREMIDADES INFERIORES'>EXTREMIDADES INFERIORES</option>
                                            <option value='PIES'>PIES</option>
                                            <option value='MÚLTIPLES'>MÚLTIPLES</option>
                                            <option value='OTROS'>OTROS</option>
                                            <option value='NO HUBO LESIÓN'>NO HUBO LESIÓN</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                        <label>Consecuencia resultante de mayor gravedad:(*):</label>
                                        <select class='form-control' name='consec_resultante' id='consec_resultante' required>
                                            <option value='' disabled selected>Elija una opción</option>
                                            <option value='LACERACIÓN/ABRASIÓN'>LACERACIÓN/ABRASIÓN</option>
                                            <option value='APLASTAMIENTO'>APLASTAMIENTO</option>
                                            <option value='CICATRICES'>CICATRICES</option>
                                            <option value='DEPRESIÓN'>DEPRESIÓN</option>
                                            <option value='CONTUSIÓN / MALLUGAMIENTO'>CONTUSIÓN / MALLUGAMIENTO</option>
                                            <option value='CONGELAMIENTO'>CONGELAMIENTO</option>
                                            <option value='ABORTO'>ABORTO</option>
                                            <option value='TRASTORNOS DE ANSIEDAD / ESTRÉS POSTRAUMÁTICO'>TRASTORNOS DE ANSIEDAD / ESTRÉS POSTRAUMÁTICO</option>
                                            <option value='QUEMADURA / CORROSIÓN'>QUEMADURA / CORROSIÓN</option>
                                            <option value='ASFIXIA'>ASFIXIA</option>
                                            <option value='EMBARAZO'>EMBARAZO</option>
                                            <option value='TRASTORNOS PSIQUIÁTRICOS'>TRASTORNOS PSIQUIÁTRICOS</option>
                                            <option value='LUXACIÓN / ESGUINCE'>LUXACIÓN / ESGUINCE</option>
                                            <option value='HERIDA'>HERIDA</option>
                                            <option value='INFECCIÓN DE TRANSMISIÓN SEXUAL'>INFECCIÓN DE TRANSMISIÓN SEXUAL</option>
                                            <option value='MÚLTIPLE'>MÚLTIPLE</option>
                                            <option value='AMPUTACIÓN / AVULSIÓN'>AMPUTACIÓN / AVULSIÓN</option>
                                            <option value='FRACTURA'>FRACTURA</option>
                                            <option value='DEFUNCIÓN'>DEFUNCIÓN</option>
                                            <option value='MALESTAR EMOCIONAL'>MALESTAR EMOCIONAL</option>
                                            <option value='TRASTORNO DEL ESTADO DE ÁNIMO'>TRASTORNO DEL ESTADO DE ÁNIMO</option>
                                            <option value='OTRA'>OTRA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <label>Descripción de la afección de causa externa(*):</label>
                                        <input type="text" class="form-control" name="causaexterna" id="causaexterna" value="<?php echo $fila['causaext']; ?>" readonly>
                                        <span></span>
                                    </div>

                                    <!-- 12 -->


                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="Guardar" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="../consultas/index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>
                        </div>

                        </form>

                        <div id="error"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </main>

    <?php include "../extend/footer.php"; ?>

    <script>

        let formulario = document.getElementById("formLesion");
        //======== VALIDA FECHAS ====================
        let fechainicio = document.getElementById("fechainicio");
        let fecha_ocurrencia = document.getElementById("fecha_ocurrencia");

        //formulario.addEventListener("blur", rojoValidaEdadAgresor, true);
        
        fecha_ocurrencia.addEventListener("blur", function () {
            
            //console.log("saliste del campo de fecha de ocurrencia");

            let fechaInicio1 = new Date(fechainicio.value);
            let fechaI = fechaInicio1.getTime();
            let fechaOcurre1 = new Date(fecha_ocurrencia.value);
            let fechaO = fechaOcurre1.getTime();

            //console.log("FechaO = " + fechaO);
            //console.log("FechaI = " + fechaI);

            //FECHA DE OCURRENCIA MAYOR A LA DE LA CONSULTA
            if (fechaO > fechaI) {
            alert("La fecha de la ocurrencia no debe ser mayor a la de inicio de la consulta.");

            fecha_ocurrencia.value = '';
            document.getElementById("fecha_ocurrencia").focus();

            }


        });
        //========= FIN VALIDA FECHAS ===============

        //========= VARIABLES DE DOMICILIO ==========
        let l_entidaddom = '<?php echo $var_entidaddom; ?>';
        let l_municipio = '<?php echo $var_municipio; ?>';
        let l_localidad = '<?php echo $var_localidad; ?>';
        let l_domicilio = '<?php echo $var_domicilio; ?>';
        let l_colonia = '<?php echo $var_colonia; ?>';
        let l_cp = '<?php echo $var_cp; ?>';
        //===========================================

        $("#nombreUnidad").hide();
        $("#sitioOcurrenciaOtro").hide();
        $("#agenteOtro").hide();
        $("#vehiculoMotor").hide();
        $("#otroEquipoTxt").hide();
        $("#violencia").hide();
        $("#otroServicio").hide();

        function mostrarReferido(value) {

            if (value == "UNIDAD MEDICA") {
                // habilitamos
                $("#nombreUnidad").show();
            }
        }

        function SitioOcurrencia(value) {

            if (value == "VIVIENDA") {

                $("#lesion_entidad").val(l_entidaddom);
                $("#lesion_municipio").val(l_municipio);
                $("#lesion_localidad").val(l_localidad);
                $("#lesion_cp").val(l_cp);
                $("#lesion_domicilio").val(l_domicilio);
                $("#lesion_colonia").val(l_colonia);

            } else if (value == "OTRO LUGAR") {
                // habilitamos
                $("#sitioOcurrenciaOtro").show();

            } else if (value == "SE IGNORA" || value == "NO APLICA" || value == "LUGAR NO ESPECIFICADO") {

                $("#lesion_entidad").prop('disabled', true);
                $("#lesion_municipio").prop('disabled', true);
                $("#lesion_localidad").prop('disabled', true);
                $("#lesion_cp").prop('disabled', true);
                $("#lesion_domicilio").prop('disabled', true);
                $("#lesion_colonia").prop('disabled', true);

            }

        }

        function mostrarViolencia(value) {

            if (value == "VIOLENCIA FAMILIAR" || value == "VIOLENCIA NO FAMILIAR") {
                // habilitamos
                $("#violencia").show();
            }

        }

        function mostrarAccidente(value) {

            if (value == "VEHÍCULO DE MOTOR") {
                // habilitamos
                $("#vehiculoMotor").show();
            }

        }

        function equipoSeguridad(value) {

            if (value == "NO" || value == "SE IGNORA") {

                $("#que_eq_seguridad").prop('disabled', true);
                $("#otro_eq_seguridad").prop('disabled', true);

            }

        }

        function otroEquipoSeguridad(value) {

            if (value == "OTRO") {

                $("#otroEquipoTxt").show();

            }

        }

        function otroServicio(value) {

            if (value == "OTRO SERVICIO") {

                $("#otroServicio").show();

            }

        }


        //Declaración de variables
        let escolaridad = document.getElementById("escolaridad");
        let leerescribir = document.getElementById("leerescribir");
        let discapacidad = document.getElementById("discapacidad");
        let referidopor = document.getElementById("referidopor");
        let diafestivo = document.getElementById("diafestivo");
        let sitio_ocurrencia = document.getElementById("sitio_ocurrencia");
        let lesion_entidad = document.getElementById("lesion_entidad");
        let lesion_municipio = document.getElementById("lesion_municipio");
        let lesion_localidad = document.getElementById("lesion_localidad");
        let lesion_domicilio = document.getElementById("lesion_domicilio");
        let lesion_colonia = document.getElementById("lesion_colonia");
        let intensionalidad = document.getElementById("intensionalidad");
        let agente_lesion = document.getElementById("agente_lesion");
        let toxicomanias = document.getElementById("toxicomanias");
        let num_agresores = document.getElementById("num_agresores");
        let edad_agresor = document.getElementById("edad_agresor");
        let servicio = document.getElementById("servicio");
        let tipoatencion = document.getElementById("tipoatencion");
        let areaanatomica = document.getElementById("areaanatomica");
        let consec_resultante = document.getElementById("consec_resultante");
        let causaexterna = document.getElementById("causaexterna");

        //VALIDACION CON EVENTOS
        const validarCamposVacios = (e) => {

            let campo = e.target;
            let valorcampo = e.target.value;

            if (valorcampo.trim().length == 0) {
                campo.classList.add("invalido");
                campo.nextElementSibling.classList.add("errorSpan");
                campo.nextElementSibling.innerText = "Este campo es requerido";
            }else{
                campo.classList.add("valido");
                campo.nextElementSibling.classList.remove("errorSpan");
                campo.nextElementSibling.innerText = "";
            }

        }

        //VALIDACION DE DATOS DEL AGRESOR
        formulario.addEventListener("blur", rojoValidaEdadAgresor, true);
        
        function rojoValidaEdadAgresor(){

            if (num_agresores.value == "UNICA(O)") {

                if (parentesco_afectado.value === "") {
                    document.getElementById("parentesco_afectado").style.border = "solid 1px red";
                    document.getElementById("parentesco_afectado").style.boxShadow = "0 0 10px red";
                }else{
                    document.getElementById("parentesco_afectado").style.border = "solid 1px greenyellow";
                    document.getElementById("parentesco_afectado").style.boxShadow = "0 0 10px greenyellow";
                }

                if (sexo_agresor.value === "") {
                    document.getElementById("sexo_agresor").style.border = "solid 1px red";
                    document.getElementById("sexo_agresor").style.boxShadow = "0 0 10px red";
                }else{
                    document.getElementById("sexo_agresor").style.border = "solid 1px greenyellow";
                    document.getElementById("sexo_agresor").style.boxShadow = "0 0 10px greenyellow";
                }

                if (edad_agresor.value === "") {
                    document.getElementById("edad_agresor").style.border = "solid 1px red";
                    document.getElementById("edad_agresor").style.boxShadow = "0 0 10px red";
                }else{
                    document.getElementById("edad_agresor").style.border = "solid 1px greenyellow";
                    document.getElementById("edad_agresor").style.boxShadow = "0 0 10px greenyellow";
                }

                if (bajoefectos_agresor.value === "") {
                    document.getElementById("bajoefectos_agresor").style.border = "solid 1px red";
                    document.getElementById("bajoefectos_agresor").style.boxShadow = "0 0 10px red";
                }else{
                    document.getElementById("bajoefectos_agresor").style.border = "solid 1px greenyellow";
                    document.getElementById("bajoefectos_agresor").style.boxShadow = "0 0 10px greenyellow";
                }
                
            }

        }

        //CAMPOS A VALIDAR:
        escolaridad.addEventListener("blur", validarCamposVacios);
        leerescribir.addEventListener("blur", validarCamposVacios);
        discapacidad.addEventListener("blur", validarCamposVacios);
        referidopor.addEventListener("blur", validarCamposVacios);
        fecha_ocurrencia.addEventListener("blur", validarCamposVacios);
        diafestivo.addEventListener("blur", validarCamposVacios);
        sitio_ocurrencia.addEventListener("blur", validarCamposVacios);
        lesion_entidad.addEventListener("blur", validarCamposVacios);
        lesion_municipio.addEventListener("blur", validarCamposVacios);
        lesion_localidad.addEventListener("blur", validarCamposVacios);
        lesion_domicilio.addEventListener("blur", validarCamposVacios);
        lesion_colonia.addEventListener("blur", validarCamposVacios);
        intensionalidad.addEventListener("blur", validarCamposVacios);
        agente_lesion.addEventListener("blur", validarCamposVacios);
        toxicomanias.addEventListener("blur", validarCamposVacios);
        servicio.addEventListener("blur", validarCamposVacios);
        tipoatencion.addEventListener("blur", validarCamposVacios);
        areaanatomica.addEventListener("blur", validarCamposVacios);
        consec_resultante.addEventListener("blur", validarCamposVacios);
        causaexterna.addEventListener("blur", validarCamposVacios);

        

        //causaexterna = $.trim(causaexterna);


        let error = document.getElementById("error");
        error.style.color = "red";

        function enviarFormulario() {

            let mensajesError = [];

            if (escolaridad.value === "") {

                mensajesError.push("La escolaridad no puede estar vacía");

            }

            if (leerescribir.value === "") {

                mensajesError.push("Leer y escribir no puede estar vacío");

            }

            if (discapacidad.value === "") {

                mensajesError.push("Discapacidad no puede estar vacío");

            }

            if (referidopor.value === "") {

                mensajesError.push("Referido por: no puede estar vacío");

            }

            if (fecha_ocurrencia === "") {
                mensajesError.push("La fecha de ocurrencia no debe estar vacía");
            }

            if (diafestivo.value === "") {

                mensajesError.push("Día festivo no puede estar vacío");

            }

            if (sitio_ocurrencia.value === "") {

                mensajesError.push("Sitio de ocurrencia no puede estar vacío");

            }

            if (lesion_entidad.value === "") {

                mensajesError.push("La entidad de ocurrencia no puede estar vacía");

            }

            if (lesion_municipio.value === "") {

                mensajesError.push("Municipio de ocurrencia no puede estar vacío");

            }

            if (lesion_localidad.value === "") {

                mensajesError.push("Localidad de ocurrencia no puede estar vacío");

            }

            if (lesion_domicilio.value === null || lesion_domicilio.value === "") {

                mensajesError.push("Domicilio de ocurrencia no puede estar vacío");

            }

            if (lesion_colonia.value === "") {

                mensajesError.push("Colonia de ocurrencia no puede estar vacía");

            }

            if (intensionalidad.value === "") {

                mensajesError.push("La intencionalidad no puede estar vacía");

            }

            if (agente_lesion.value === "") {

                mensajesError.push("Agente de lesión no puede estar vacía");

            }

            if (toxicomanias.value === "") {

                mensajesError.push("La sospecha que el paciente bajo efectos de: no puede estar vacía");

            }

            if (num_agresores.value === "UNICA(O)" && edad_agresor.value ==="") {

                mensajesError.push("La edad del agresor no puede estar vacía");

            }

            if (servicio.value === "") {

                mensajesError.push("El servicio no puede estar vacío");

            }

            if (tipoatencion.value === "") {

                mensajesError.push("El tipo de atención no puede estar vacío");

            }

            if (intensionalidad.value === "") {

                mensajesError.push("El área anatómica no puede estar vacía");

            }

            if (consec_resultante.value === "") {

                mensajesError.push("La consecuencia resultante no puede estar vacía");

            }
            
            error.innerHTML = mensajesError.join(", ");

            return false;

        }

    </script>

    <!--<script src="validacionLesiones.js"></script>-->

    </body>

    </html>

<?php } ?>