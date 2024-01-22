<?php

ob_start();

include "../extend/header.php";
include_once "funcionesConsulta.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location:../../index.php");
    }

    $id = $_GET['idc'];
    $idr = $_GET['idr'];

    $sql = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.fc, c.fr, c.ta, c.temperatura, c.glucosa, c.talla, c.peso, c.pabdominal, c.imc, c.notaingresourg, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.lesion_es, c.lesiones, c.condicion, c.idusuario, r.idrecepcion,p.idpaciente,p.nombre,r.edad,p.sexo,r.mtvoconsulta FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion WHERE idconsulta = '$id' AND r.idrecepcion = '$idr'";

    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //echo $fila["mujeredadfertil"];

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php
        $idconsulta = isset($_POST["idconsulta"]) ? mysqli_real_escape_string($con, $_POST['idconsulta']) : "";

        //NOTA DE INGRESO DE URGENCIAS
        $fc = isset($_POST["fc"]) ? mysqli_real_escape_string($con, $_POST['fc']) : "";
        $fr = isset($_POST["fr"]) ? mysqli_real_escape_string($con, $_POST['fr']) : "";
        $ta = isset($_POST["ta"]) ? mysqli_real_escape_string($con, $_POST['ta']) : "";
        $temperatura = isset($_POST["temperatura"]) ? mysqli_real_escape_string($con, $_POST['temperatura']) : "";
        $glucosa = isset($_POST["glucosa"]) ? mysqli_real_escape_string($con, $_POST['glucosa']) : "";
        $talla = isset($_POST["talla"]) ? mysqli_real_escape_string($con, $_POST['talla']) : "";
        $peso = isset($_POST["peso"]) ? mysqli_real_escape_string($con, $_POST['peso']) : "";
        $pabdominal = isset($_POST["pabdominal"]) ? mysqli_real_escape_string($con, $_POST['pabdominal']) : "";
        $imc = isset($_POST["imc"]) ? mysqli_real_escape_string($con, $_POST['imc']) : "";
        $notaingresourg = isset($_POST["notaingresourg"]) ? mysqli_real_escape_string($con, $_POST['notaingresourg']) : "";

        //HOJA DE URGENCIAS
        $atnprehosp = isset($_POST["atnprehosp"]) ? mysqli_real_escape_string($con, $_POST['atnprehosp']) : "";
        $tipourgencia = isset($_POST["tipourgencia"]) ? mysqli_real_escape_string($con, $_POST['tipourgencia']) : "";
        $tiempotraslado = isset($_POST["tiempotraslado"]) ? mysqli_real_escape_string($con, $_POST['tiempotraslado']) : "";
        $nombreunidad = isset($_POST["nombreunidad"]) ? mysqli_real_escape_string($con, $_POST['nombreunidad']) : "";
        $trastrans = isset($_POST["trastrans"]) ? mysqli_real_escape_string($con, $_POST['trastrans']) : "";
        $motivoatencion = isset($_POST["motivoatencion"]) ? mysqli_real_escape_string($con, $_POST['motivoatencion']) : "";
        $tipocama = isset($_POST["tipocama"]) ? mysqli_real_escape_string($con, $_POST['tipocama']) : "";
        $altapor = isset($_POST["altapor"]) ? mysqli_real_escape_string($con, $_POST['altapor']) : "";
        $otraunidad = isset($_POST["otraunidad"]) ? mysqli_real_escape_string($con, $_POST['otraunidad']) : "";
        $ministeriopublico = isset($_POST["ministeriopublico"]) ? mysqli_real_escape_string($con, $_POST['ministeriopublico']) : "";
        $mujeredadfertil = isset($_POST["mujeredadfertil"]) ? mysqli_real_escape_string($con, $_POST['mujeredadfertil']) : "";
        $afecprincipal = isset($_POST["afecprincipal"]) ? mysqli_real_escape_string($con, $_POST['afecprincipal']) : "";
        $comorbilidad1 = isset($_POST["comorbilidad1"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad1']) : "";
        $comorbilidad2 = isset($_POST["comorbilidad2"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad2']) : "";
        $comorbilidad3 = isset($_POST["comorbilidad3"]) ? mysqli_real_escape_string($con, $_POST['comorbilidad3']) : "";
        $interconsulta1 = isset($_POST["interconsulta1"]) ? mysqli_real_escape_string($con, $_POST['interconsulta1']) : "";
        $interconsulta2 = isset($_POST["interconsulta2"]) ? mysqli_real_escape_string($con, $_POST['interconsulta2']) : "";
        $interconsulta3 = isset($_POST["interconsulta3"]) ? mysqli_real_escape_string($con, $_POST['interconsulta3']) : "";
        $procedim1 = isset($_POST["procedim1"]) ? mysqli_real_escape_string($con, $_POST['procedim1']) : "";
        $procedim2 = isset($_POST["procedim2"]) ? mysqli_real_escape_string($con, $_POST['procedim2']) : "";
        $procedim3 = isset($_POST["procedim3"]) ? mysqli_real_escape_string($con, $_POST['procedim3']) : "";
        $procedim4 = isset($_POST["procedim4"]) ? mysqli_real_escape_string($con, $_POST['procedim4']) : "";
        $procedim5 = isset($_POST["procedim5"]) ? mysqli_real_escape_string($con, $_POST['procedim5']) : "";
        $medicamento1 = isset($_POST["medicamento1"]) ? mysqli_real_escape_string($con, $_POST['medicamento1']) : "";
        $medicamento2 = isset($_POST["medicamento2"]) ? mysqli_real_escape_string($con, $_POST['medicamento2']) : "";
        $medicamento3 = isset($_POST["medicamento3"]) ? mysqli_real_escape_string($con, $_POST['medicamento3']) : "";
        $lesion_es = isset($_POST["lesion_es"]) ? mysqli_real_escape_string($con, $_POST['lesion_es']) : "";
        $lesiones = isset($_POST["lesiones"]) ? mysqli_real_escape_string($con, $_POST['lesiones']) : "";

        $notaingresourg = trim($notaingresourg);

        $idusuario = $_SESSION['idusuario'];

        //VALIDAR MINISTERIO PUBLICO ===================
        if ($ministeriopublico === "") {
            $ministeriopublico = "NO";
        }else{
            $ministeriopublico = $ministeriopublico;
        }

        //VALIDAR MUJER EN EDAD FERTIL =================
        if ($fila['sexo'] === "Femenino" && $mujeredadfertil === "") {
            $mujeredadfertil = "No estaba embarazada ni en el puerperio";
        }elseif ($fila['sexo'] === "Masculino") {
            $mujeredadfertil = "";
        }else{
            $mujeredadfertil = $mujeredadfertil;
        }

        //VALIDAR QUE LESIONES NO VENGA VACIO ===================
        if ($lesion_es === "" || $lesion_es == NULL) {
            $lesion_es = "NO HAY LESION";
        }
        if ($lesiones === "" || $lesiones == NULL) {
            $lesiones = "NO";
        }
        if ($lesion_es === "NO HAY LESION" || $lesion_es === "SUBSECUENTE") {
            $lesiones = "NO";
        }else {
            $lesion_es = $lesion_es;
            $lesiones = $lesiones;
        }

        //EDICION DE DATOS ==========================================================================
        $editarC1 = "UPDATE consultas SET fc='$fc',
                                    fr='$fr',
                                    ta='$ta',
                                    temperatura='$temperatura',
                                    glucosa='$glucosa',
                                    talla='$talla',
                                    peso='$peso',
                                    pabdominal='$pabdominal',
                                    imc='$imc',
                                    notaingresourg='$notaingresourg',
                                    atnprehosp='$atnprehosp',
                                    tipourgencia='$tipourgencia',
                                    tiempotraslado='$tiempotraslado',
                                    nombreunidad='$nombreunidad',
                                    trastrans='$trastrans',
                                    motivoatencion='$motivoatencion',
                                    tipocama='$tipocama',
                                    altapor='$altapor',
                                    otraunidad='$otraunidad',
                                    ministeriopublico='$ministeriopublico',
                                    mujeredadfertil='$mujeredadfertil',
                                    afecprincipal='$afecprincipal',
                                    comorbilidad1='$comorbilidad1',
                                    comorbilidad2='$comorbilidad2',
                                    comorbilidad3='$comorbilidad3',
                                    interconsulta1='$interconsulta1',
                                    interconsulta2='$interconsulta2',
                                    interconsulta3='$interconsulta3',
                                    procedim1='$procedim1',
                                    procedim2='$procedim2',
                                    procedim3='$procedim3',
                                    procedim4='$procedim4',
                                    procedim5='$procedim5',
                                    medicamento1='$medicamento1',
                                    medicamento2='$medicamento2',
                                    medicamento3='$medicamento3',
                                    condicion='1',
                                    idusuario='$idusuario' WHERE idconsulta = '$idconsulta'";

        $editadoC1 = $con->query($editarC1);

        if ($editadoC1 > 0) {
            header('location:../extend/alerta.php?msj=Consulta actualizada&c=pac&p=in&t=success');
            $con->close();
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar consulta&c=pac&p=in&t=error');
        }

        $con->close();

    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Editar Paciente</h5>
                    </div>
                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>Datos del paciente:</h6>
                                </div>

                                <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idconsulta" id="idconsulta" value="<?php echo $id; ?>">
                                    <input type="hidden" name="idrecepcion" id="idrecepcion" value="<?php echo $idr; ?>">
                                    <input type="hidden" name="idpaciente" value="<?php echo $fila['idpaciente']; ?>">
                                    <input type="text" name="nombrep" class="form-control" value="<?php echo $fila['nombre']; ?>" disabled>
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
                                    <h6>NOTA MEDICA DE INGRESO A URGENCIAS:</h6>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>Signos vitales:</h6>
                                </div>

                                <!-- 12 -->

                                <!-- ========== NOTA MEDICA DE LA CONSULTA DE URGENCIAS ==========-->
                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>FC: lpm</label>
                                    <input type="text" class="form-control" name="fc" id="fc" maxlength="10" placeholder="FC" value="<?php echo $fila['fc']; ?>">
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>FR: rpm</label>
                                    <input type="text" class="form-control" name="fr" id="fr" maxlength="10" placeholder="FR" value="<?php echo $fila['fr']; ?>">
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>TA: mm/Hg</label>
                                    <input type="text" class="form-control" name="ta" id="ta" maxlength="10" placeholder="TA" value="<?php echo $fila['ta']; ?>">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Temperatura: °C</label>
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" maxlength="10" placeholder="Temp" value="<?php echo $fila['temperatura']; ?>">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Glucosa: mg/dl</label>
                                    <input type="text" class="form-control" name="glucosa" id="glucosa" maxlength="10" placeholder="Glucosa" value="<?php echo $fila['glucosa']; ?>">
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>Talla:</label>
                                    <input type="text" class="form-control" name="talla" id="talla" maxlength="10" placeholder="Talla" value="<?php echo $fila['talla']; ?>">
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>Peso:</label>
                                    <input type="text" class="form-control" name="peso" id="peso" maxlength="10" placeholder="Peso" value="<?php echo $fila['peso']; ?>">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>P. Abdominal:</label>
                                    <input type="text" class="form-control" name="pabdominal" id="pabdominal" maxlength="10" placeholder="P. Abdominal" value="<?php echo $fila['pabdominal']; ?>">
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>IMC:</label>
                                    <input type="text" class="form-control" name="imc" id="imc" maxlength="10" placeholder="IMC" value="<?php echo $fila['imc']; ?>">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>NOTAS:</h6>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <textarea name="notaingresourg" id="notaingresourg" rows="10" cols="150" placeholder="Agregar la nota medica del servicio de urgencias" onClick="borra()" onblur="may(this.value, this.id)" required>
                                            <?php echo $fila['notaingresourg']; ?>
                                        </textarea>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>Consulta:</h6>
                                    <hr>
                                </div>

                                <!-- ======= HOJA DE URGENCIAS =============-->
                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <!-- Este campo está oculto -->
                                    <input type="hidden" class="form-control" name="fechaingreso" id="fechaingreso" value="<?php echo date("Y-m-d H:i:s"); ?>">

                                    <label>Atención prehospitalaria (*):</label>
                                    <select class='form-control' name='atnprehosp' id='atnprehosp' required>
                                        <option value="<?php echo $fila['atnprehosp']; ?>"><?php echo $fila['atnprehosp']; ?></option>
                                        <option value='NO'>NO</option>
                                        <option value='SI'>SI</option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Tipo de Urgencia (*):</label>
                                    <select class='form-control' name='tipourgencia' id='tipourgencia' required>
                                        <option value="<?php echo $fila['tipourgencia']; ?>"><?php echo $fila['tipourgencia']; ?></option>
                                        <option value='CALIFICADA'>CALIFICADA</option>
                                        <option value='NO CALIFICADA'>NO CALIFICADA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Tiempo de traslado:</label>
                                    <input type="text" class="form-control" name="tiempotraslado" id="tiempotraslado" maxlength="50" placeholder="Tiempo traslado" onblur="may(this.value, this.id)" value="<?php echo $fila['tiempotraslado']; ?>">
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                    <label>Nombre de la unidad:</label>
                                    <input type="text" class="form-control" name="nombreunidad" id="nombreunidad" maxlength="50" placeholder="Nombre de la unidad" onblur="may(this.value, this.id)" value="<?php echo $fila['nombreunidad']; ?>">
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Traslado transitorio:</label>
                                    <select class='form-control' name='trastrans' id='trastrans'>
                                        <option value="<?php echo $fila['trastrans']; ?>"><?php echo $fila['trastrans']; ?></option>
                                        <option value='NO'>NO</option>
                                        <option value='SI'>SI</option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Motivo de atención (*):</label>
                                    <select class='form-control' name='motivoatencion' id='motivoatencion' required>
                                        <option value="<?php echo $fila['motivoatencion']; ?>"><?php echo $fila['motivoatencion']; ?></option>
                                        <option value='Accidente, envenenamiento y violencia'>Accidente, envenenamiento y violencia</option>
                                        <option value='Médica'>Médica</option>
                                        <option value='Gineco-obstétrica'>Gineco-obstétrica</option>
                                        <option value='Pediátrica'>Pediátrica</option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Tipo de cama (*):</label>
                                    <select class='form-control' name='tipocama' id='tipocama' required>
                                        <option value="<?php echo $fila['tipocama']; ?>"><?php echo $fila['tipocama']; ?></option>
                                        <option value='Observación'>Observación</option>
                                        <option value='Choque'>Choque</option>
                                        <option value='Sin cama'>Sin cama</option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label style="color: red;">Alta por (*):</label>
                                    <select class='form-control border-danger' name='altapor' id='altapor'>
                                        <option value='<?php echo $fila['altapor']; ?>'><?php echo $fila['altapor']; ?></option>
                                        <option value='Domicilio'>Domicilio</option>
                                        <option value='Hospitalización'>Hospitalización</option>
                                        <option value='Consulta Externa'>Consulta Externa</option>
                                        <option value='Observación'>Observación</option>
                                        <option value='Traslado a otra unidad'>Traslado a otra unidad</option>
                                        <option value='Fuga'>Fuga</option>
                                        <option value='Defunción'>Defunción</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Nombre de la unidad:</label>
                                    <input type="text" class="form-control" name="otraunidad" id="otraunidad" maxlength="50" placeholder="Unidad de traslado" onblur="may(this.value, this.id)" value="<?php echo $fila['otraunidad']; ?>">
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Ministerio público*:</label>
                                    <select class='form-control' name='ministeriopublico' id='ministeriopublico' required>
                                    <option value="<?php echo $fila['ministeriopublico']; ?>"><?php echo $fila['ministeriopublico']; ?></option>
                                        <option value='NO'>NO</option>
                                        <option value='SI'>SI</option>
                                    </select>
                                </div>

                                <?php

                                if ($fila['sexo'] === "Masculino") {

                                    echo '<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <label>MUJER EN EDAD FERTIL:</label>
                                            <select class="form-control" name="mujeredadfertil" id="mujeredadfertil" disabled="true">
                                                <option value=""></option>
                                            </select>
                                        </div>';
                                } else {

                                    echo '<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <label>MUJER EN EDAD FERTIL:</label>
                                            <select class="form-control" name="mujeredadfertil" id="mujeredadfertil">
                                                <!--<option value="<?php echo $fila["mujeredadfertil"]; ?>"><?php echo $fila["mujeredadfertil"]; ?></option>-->
                                                <option value="No estaba embarazada ni en el puerperio">No estaba embarazada ni en el puerperio</option>
                                                <option value="Embarazo">Embarazo</option>
                                                <option value="Puerperio (de 0 a 42 días después del parto)">Puerperio (de 0 a 42 días después del parto)</option>
                                            </select>
                                        </div>';
                                }

                                ?>


                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>AFECCIÓN PRINCIPAL:</label></h6>
                                    <input type="text" class="form-control" name="afecprincipal" id="afecprincipal" maxlength="100" placeholder="Afección principal (REQUERIDO), favor de agregar solamente un diagnostico" onblur="may(this.value, this.id)" value="<?php echo $fila['afecprincipal']; ?>" required>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad1" id="comorbilidad1" maxlength="100" placeholder="Diagnostico 1, favor de agregar solamente un diagnostico" value="<?php echo $fila['comorbilidad1']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad2" id="comorbilidad2" maxlength="100" placeholder="Diagnostico 2, favor de agregar solamente un diagnostico" value="<?php echo $fila['comorbilidad2']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad3" id="comorbilidad3" maxlength="100" placeholder="Diagnostico 3, favor de agregar solamente un diagnostico" value="<?php echo $fila['comorbilidad3']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>ESPECIALIDAD:</label></h6>
                                    <input type="text" class="form-control" name="interconsulta1" id="interconsulta1" maxlength="50" placeholder="Especialidad" value="<?php echo $fila['interconsulta1']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="interconsulta2" id="interconsulta2" maxlength="50" placeholder="Especialidad" value="<?php echo $fila['interconsulta2']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="interconsulta3" id="interconsulta3" maxlength="50" placeholder="Especialidad" value="<?php echo $fila['interconsulta3']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>PROCEDIMIENTOS:</label></h6>
                                    <input type="text" class="form-control" name="procedim1" id="procedim1" maxlength="70" placeholder="Procedimiento 1, favor de agregar solamente un procedimiento" value="<?php echo $fila['procedim1']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim2" id="procedim2" maxlength="70" placeholder="Procedimiento 2, favor de agregar solamente un procedimiento" value="<?php echo $fila['procedim2']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim3" id="procedim3" maxlength="70" placeholder="Procedimiento 3, favor de agregar solamente un procedimiento" value="<?php echo $fila['procedim3']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim4" id="procedim4" maxlength="70" placeholder="Procedimiento 4, favor de agregar solamente un procedimiento" value="<?php echo $fila['procedim4']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim5" id="procedim5" maxlength="70" placeholder="Procedimiento 5, favor de agregar solamente un procedimiento" value="<?php echo $fila['procedim5']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>MEDICAMENTOS Y PRESENTACIÓN:</label></h6>
                                    <input type="text" class="form-control" name="medicamento1" id="medicamento1" maxlength="40" placeholder="Medicamento 1" value="<?php echo $fila['medicamento1']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="medicamento2" id="medicamento2" maxlength="40" placeholder="Medicamento 2" value="<?php echo $fila['medicamento2']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="medicamento3" id="medicamento3" maxlength="40" placeholder="Medicamento 3" value="<?php echo $fila['medicamento3']; ?>" onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-12'>
                                    <label style="color: red;">Hay lesión, es 1ra vez o subsecuente?:</label>
                                    <select class='form-control' name='lesion_es' id='lesion_es' required>
                                        <option value="<?php echo $fila['lesion_es']; ?>" selected><?php echo $fila['lesion_es']; ?></option>
                                        <option value='NO HAY LESION'>NO HAY LESION</option>
                                        <option value='PRIMERA VEZ'>PRIMERA VEZ</option>
                                        <option value='SUBSECUENTE'>SUBSECUENTE</option>
                                    </select>
                                    <span></span>
                                </div>

                                <div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-12'>
                                    <label style="color: red;">Se realiza hoja de lesiones(*)?:</label>
                                    <select class='form-control' name='lesiones' id='lesiones' required>
                                        <option value="<?php echo $fila['lesiones']; ?>" selected><?php echo $fila['lesiones']; ?></option>
                                        <option value='NO'>NO</option>
                                        <option value='SI'>SI</option>
                                    </select>
                                    <span></span>
                                </div>

                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="Actualizar" id="Actualizar"><i class="fa fa-save"> Actualizar</i></button>
                                <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>

        //Cambios en tipo de cama y alta por:
        $("#tipocama").change(function() {

            if (document.getElementById("tipocama").value == "Observación") {

                $("#altapor").val("Observación");
                $('#altapor option:not(:selected)').attr('disabled', true);

            } else if (document.getElementById("tipocama").value != "Observación") {
                $('#altapor option:not(:selected)').attr('disabled', false);
                document.getElementById("altapor").focus();
            }

        });

        //Cambios en lesiones
        $("#lesion_es").change(function() {

            if (document.getElementById("lesion_es").value == "SUBSECUENTE" || document.getElementById("lesion_es").value == "NO HAY LESION") {

                $("#lesiones").val("NO");
                $('#lesiones option:not(:selected)').attr('disabled', true);

            } else if (document.getElementById("lesion_es").value == "PRIMERA VEZ") {
                $("#lesiones").val("");
                $('#lesiones option:not(:selected)').attr('disabled', false);
                document.getElementById("lesiones").focus();
            }

        });
        
    </script>

    </body>

    </html>

<?php

}

ob_end_flush();

?>