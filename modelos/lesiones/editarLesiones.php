<?php

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    $id = $_GET['idl'];

    $sql = "SELECT r.idrecepcion, p.idpaciente, p.nombre, p.entidaddom, p.municipio, p.localidad, p.domicilio, p.colonia, p.cp, r.edad,p.sexo, r.mtvoconsulta, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, l.idlesion, l.idconsulta, l.escolaridad, l.leerescribir, l.discapacidad, l.referidopor, l.nombre_unidad, l.fecha_ocurrencia, l.diafestivo, l.sitio_ocurrencia, l.sitio_ocurrencia_otro, l.lesion_entidad, l.lesion_municipio, l.lesion_localidad, l.lesion_cp, l.lesion_domicilio, l.lesion_colonia, l.intensionalidad, l.agente_lesion, l.agente_otro, l.toxicomanias, l.otras_toxicomanias, l.lesionad_es, l.equipo_seguridad, l.que_eq_seguridad, l.otro_eq_seguridad, l.tipo_violencia, l.num_agresores, l.parentesco_afectado, l.sexo_agresor, l.edad_agresor, l.bajoefectos_agresor, l.evento_autoinflingido, l.servicio, l.otro_servicio, l.tipoatencion, l.otro_tipoatencion, l.areaanatomica, l.consec_resultante, l.causaexterna, l.condicion, l.idusuario FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN lesiones l ON l.idconsulta = c.idconsulta WHERE l.idlesion = '$id'";
    
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //================ VARIABLES DE DOMICILIO ================================================

    $var_entidaddom = $fila["entidaddom"];
    $var_municipio = $fila["municipio"];
    $var_localidad = $fila["localidad"];
    $var_domicilio = $fila["domicilio"];
    $var_colonia = $fila["colonia"];
    $var_cp = $fila["cp"];

    //========================================================================================

    //Captura de datos
    if (!empty($_POST)) {

        //$idconsulta = isset($_POST["idconsulta"]) ? mysqli_real_escape_string($con, $_POST['idconsulta']) : "";
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


        //Realizamos la inserción de los datos
        $sql_lesiones = "UPDATE lesiones SET escolaridad='$escolaridad',
                                            leerescribir='$leerescribir',
                                            discapacidad='$discapacidad',
                                            referidopor='$referidopor',
                                            nombre_unidad='$nombre_unidad',
                                            fecha_ocurrencia='$fecha_ocurrencia',
                                            diafestivo='$diafestivo',
                                            sitio_ocurrencia='$sitio_ocurrencia',
                                            sitio_ocurrencia_otro='$sitio_ocurrencia_otro',
                                            lesion_entidad='$lesion_entidad',
                                            lesion_municipio='$lesion_municipio',
                                            lesion_localidad='$lesion_localidad',
                                            lesion_cp='$lesion_cp',
                                            lesion_domicilio='$lesion_domicilio',
                                            lesion_colonia='$lesion_colonia',
                                            intensionalidad='$intensionalidad',
                                            agente_lesion='$agente_lesion',
                                            agente_otro='$agente_otro',
                                            toxicomanias='$toxicomanias',
                                            otras_toxicomanias='$otras_toxicomanias',
                                            lesionad_es='$lesionad_es',
                                            equipo_seguridad='$equipo_seguridad',
                                            que_eq_seguridad='$que_eq_seguridad',
                                            otro_eq_seguridad='$otro_eq_seguridad',
                                            tipo_violencia='$tipo_violencia',
                                            num_agresores='$num_agresores',
                                            parentesco_afectado='$parentesco_afectado',
                                            sexo_agresor='$sexo_agresor',
                                            edad_agresor='$edad_agresor',
                                            bajoefectos_agresor='$bajoefectos_agresor',
                                            evento_autoinflingido='$evento_autoinflingido',
                                            servicio='$servicio',
                                            otro_servicio='$otro_servicio',
                                            tipoatencion='$tipoatencion',
                                            otro_tipoatencion='$otro_tipoatencion',
                                            areaanatomica='$areaanatomica',
                                            consec_resultante='$consec_resultante',
                                            causaexterna='$causaexterna',
                                            condicion='1',
                                            idusuario='$idusuario' WHERE idlesion = '$id'";

        $editLesiones = $con->query($sql_lesiones);


        if ($editLesiones > 0) {
            //NO HAY INDEX EN PAGINA DE LESIONES

            echo "<script>
            alert('La modificación de la lesión se guardo con exito');
            window.location = '../consultas/index.php';
        </script>";
        } else {

            echo "<script>
            alert('Error al modificar la lesión');
            window.location = '../consultas/index.php';
        </script>";
        }

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
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                                <div class="row">

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>Datos del paciente:</h6>
                                    </div>

                                    <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                        <label>Nombre:</label>

                                        <input type="hidden" name="idlesion" id="idlesion" value="<?php echo $id; ?>">

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

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>LESIONES Y CAUSAS DE VIOLENCIA</h6>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Escolaridad (*):</label>
                                        <select class='form-control' name='escolaridad' id='escolaridad' required>
                                            <option value="<?php echo $fila['escolaridad']; ?>" selected><?php echo $fila['escolaridad']; ?></option>
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
                                            <option value="<?php echo $fila['leerescribir']; ?>" selected><?php echo $fila['leerescribir']; ?></option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>¿Tiene alguna discapacidad preexistente? (*):</label>
                                        <select class='form-control' name='discapacidad' id='discapacidad' required>
                                            <option value="<?php echo $fila['discapacidad']; ?>" selected><?php echo $fila['discapacidad']; ?></option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                            <option value='SE IGNORA'>SE IGNORA</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Usuario referido por (*):</label>
                                        <select class='form-control' name='referidopor' id='referidopor' onchange='mostrarReferido(this.value);' required>
                                            <option value="<?php echo $fila['referidopor']; ?>" selected><?php echo $fila['referidopor']; ?></option>
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
                                        <input type="text" class="form-control" name="nombre_unidad" id="nombre_unidad" maxlength="100" value="<?php echo $fila['nombre_unidad']; ?>" placeholder="Nombre de la unidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label for="fecha_ocurrencia" style="color: red;">Fecha y hora de la ocurrencia(*): </label>
                                        <input type="datetime-local" id="fecha_ocurrencia" name="fecha_ocurrencia" min="2023-06-01T00:00" value="<?php echo $fila['fecha_ocurrencia']; ?>" required>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>¿El día se considera festivo?(*):</label>
                                        <select class='form-control' name='diafestivo' id='diafestivo' required>
                                            <option value="<?php echo $fila['diafestivo']; ?>" selected><?php echo $fila['diafestivo']; ?></option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                        </select>
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                        <label>¿Sitio de ocurrencia del evento?(*):</label>
                                        <select class='form-control' name='sitio_ocurrencia' id='sitio_ocurrencia' onchange='SitioOcurrencia(this.value);' required>
                                            <option value="<?php echo $fila['sitio_ocurrencia']; ?>" selected><?php echo $fila['sitio_ocurrencia']; ?></option>
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
                                        <input type="text" class="form-control" name="sitio_ocurrencia_otro" id="sitio_ocurrencia_otro" maxlength="100" value="<?php echo $fila['sitio_ocurrencia_otro']; ?>" placeholder="Otro lugar" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Entidad federativa (*):</label>
                                        <select class="form-control" name="lesion_entidad" id="lesion_entidad" required>
                                            <option value="<?php echo $fila['lesion_entidad']; ?>" selected><?php echo $fila['lesion_entidad']; ?></option>
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
                                        <input type="text" class="form-control" name="lesion_municipio" id="lesion_municipio" maxlength="100" value="<?php echo $fila['lesion_municipio']; ?>" placeholder="Municipio" required onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Localidad (*):</label>
                                        <input type="text" class="form-control" name="lesion_localidad" id="lesion_localidad" maxlength="100" value="<?php echo $fila['lesion_localidad']; ?>" placeholder="Localidad" required onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <label>C.P.:</label>
                                        <input type="text" class="form-control" name="lesion_cp" id="lesion_cp" maxlength="5" value="<?php echo $fila['lesion_cp']; ?>" placeholder="código postal" pattern="[0-9]{5}">
                                        <span></span>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                        <label>Domicilio (*):</label>
                                        <input type="text" class="form-control" name="lesion_domicilio" id="lesion_domicilio" maxlength="100" value="<?php echo $fila['lesion_domicilio']; ?>" placeholder="Domicilio" required onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <label>Colonia (*):</label>
                                        <input type="text" class="form-control" name="lesion_colonia" id="lesion_colonia" maxlength="100" value="<?php echo $fila['lesion_colonia']; ?>" placeholder="Colonia" required onblur="may(this.value, this.id)">
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
                                            <option value="<?php echo $fila['intensionalidad']; ?>" selected><?php echo $fila['intensionalidad']; ?></option>
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
                                            <option value="<?php echo $fila['agente_lesion']; ?>" selected><?php echo $fila['agente_lesion']; ?></option>
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
                                        <input type="text" class="form-control" name="agente_otro" id="agente_otro" maxlength="100" value="<?php echo $fila['agente_otro']; ?>" placeholder="Colonia" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Se sospecha que el paciente estaba bajo efectos de:(*):</label>
                                        <select class='form-control' name='toxicomanias' id='toxicomanias' required>
                                            <option value="<?php echo $fila['toxicomanias']; ?>" selected><?php echo $fila['toxicomanias']; ?></option>
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
                                        <input type="text" class="form-control" name="otras_toxicomanias" id="otras_toxicomanias" maxlength="100" value="<?php echo $fila['otras_toxicomanias']; ?>" placeholder="Otras de las anteriores" onblur="may(this.value, this.id)">
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
                                                <option value="<?php echo $fila['lesionad_es']; ?>" selected><?php echo $fila['lesionad_es']; ?></option>
                                                <option value='CONDUCTOR'>CONDUCTOR</option>
                                                <option value='OCUPANTE'>OCUPANTE</option>
                                                <option value='PEATÓN'>PEATÓN</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Usó equipo de seguridad:</label>
                                            <select class='form-control' name='equipo_seguridad' id='equipo_seguridad' onchange='equipoSeguridad(this.value);'>
                                                <option value="<?php echo $fila['equipo_seguridad']; ?>" selected><?php echo $fila['equipo_seguridad']; ?></option>
                                                <option value='SI'>SI</option>
                                                <option value='NO'>NO</option>
                                                <option value='SE IGNORA'>SE IGNORA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>¿Qué equipo de seguridad utilizó?:</label>
                                            <select class='form-control' name='que_eq_seguridad' id='que_eq_seguridad' onchange='otroEquipoSeguridad(this.value);'>
                                                <option value="<?php echo $fila['que_eq_seguridad']; ?>" selected><?php echo $fila['que_eq_seguridad']; ?></option>
                                                <option value='CINTURÓN DE SEGURIDAD'>CINTURÓN DE SEGURIDAD</option>
                                                <option value='CASCO'>CASCO</option>
                                                <option value='SILLÍN PORTA INFANTE'>SILLÍN PORTA INFANTE</option>
                                                <option value='OTRO'>OTRO</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" id="otroEquipoTxt">
                                            <label>Otro especifique:</label>
                                            <input type="text" class="form-control" name="otro_eq_seguridad" id="otro_eq_seguridad" maxlength="100" value="<?php echo $fila['otro_eq_seguridad']; ?>" placeholder="Otras de las anteriores" onblur="may(this.value, this.id)">
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
                                                <option value="<?php echo $fila['tipo_violencia']; ?>" selected><?php echo $fila['tipo_violencia']; ?></option>
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
                                                <option value="<?php echo $fila['num_agresores']; ?>" selected><?php echo $fila['num_agresores']; ?></option>
                                                <option value='UNICA(O)'>UNICA(O)</option>
                                                <option value='MÁS DE UNA(O)'>MÁS DE UNA(O)</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                            <label>Parentesco con la/el afectada(o):</label>
                                            <select class='form-control' name='parentesco_afectado' id='parentesco_afectado'>
                                                <option value="<?php echo $fila['parentesco_afectado']; ?>" selected><?php echo $fila['parentesco_afectado']; ?></option>
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
                                                <option value="<?php echo $fila['sexo_agresor']; ?>" selected><?php echo $fila['sexo_agresor']; ?></option>
                                                <option value='HOMBRE'>HOMBRE</option>
                                                <option value='MUJER'>MUJER</option>
                                                <option value='INTERSEXUAL'>INTERSEXUAL</option>
                                                <option value='SE IGNORA'>SE IGNORA</option>
                                                <option value='NO ESPECIFICADO'>NO ESPECIFICADO</option>
                                            </select>
                                        </div>

                                        <!-- 12 -->

                                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <label>Edad del/la agresor(a):</label>
                                            <input type="text" class="form-control" name="edad_agresor" id="edad_agresor" maxlength="3" value="<?php echo $fila['edad_agresor']; ?>" placeholder="Edad" pattern="[0-9]{1,3}">
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                            <label>El/la agreso(a) se sospecha que actuó bajo los efectos de:</label>
                                            <select class='form-control' name='bajoefectos_agresor' id='bajoefectos_agresor'>
                                                <option value="<?php echo $fila['bajoefectos_agresor']; ?>" selected><?php echo $fila['bajoefectos_agresor']; ?></option>
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
                                                <option value="<?php echo $fila['evento_autoinflingido']; ?>" selected><?php echo $fila['evento_autoinflingido']; ?></option>
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
                                            <option value="<?php echo $fila['servicio']; ?>" selected><?php echo $fila['servicio']; ?></option>
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
                                        <input type="text" class="form-control" name="otro_servicio" id="otro_servicio" maxlength="50" value="<?php echo $fila['otro_servicio']; ?>" placeholder="Especifique el servicio" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Tipo de atención:(*):</label>
                                        <select class='form-control' name='tipoatencion' id='tipoatencion' required>
                                            <option value="<?php echo $fila['tipoatencion']; ?>" selected><?php echo $fila['tipoatencion']; ?></option>
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
                                        <input type="text" class="form-control" name="otro_tipoatencion" id="otro_tipoatencion" maxlength="100" value="<?php echo $fila['otro_tipoatencion']; ?>" placeholder="Otros tipos" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Área anatómica de mayor gravedad:(*):</label>
                                        <select class='form-control' name='areaanatomica' id='areaanatomica' required>
                                            <option value="<?php echo $fila['areaanatomica']; ?>" selected><?php echo $fila['areaanatomica']; ?></option>
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
                                            <option value="<?php echo $fila['consec_resultante']; ?>" selected><?php echo $fila['consec_resultante']; ?></option>
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
                                        <input type="text" class="form-control" name="causaexterna" id="causaexterna" maxlength="200" value="<?php echo $fila['causaexterna']; ?>" placeholder="Especifique la descripción de la afección de causa externa" onblur="may(this.value, this.id)">
                                        <span></span>
                                    </div>

                                    <!-- 12 -->


                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="Guardar" id="Guardar"><i class="fa fa-save"> Modificar</i></button>
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
        //$(document).ready(function() {
        //})

        //========= VARIABLES DE DOMICILIO ==========
        var l_entidaddom = '<?php echo $var_entidaddom; ?>';
        var l_municipio = '<?php echo $var_municipio; ?>';
        var l_localidad = '<?php echo $var_localidad; ?>';
        var l_domicilio = '<?php echo $var_domicilio; ?>';
        var l_colonia = '<?php echo $var_colonia; ?>';
        var l_cp = '<?php echo $var_cp; ?>';
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
    </script>

    <script src="validacionLesiones.js"></script>

    </body>

    </html>

<?php } ?>