<style>
    .error {
        background-color: #ff9185;
        font-size: 12px;
        padding: 10px;
    }

    .correcto {
        background-color: #A0DEA7;
        font-size: 12px;
        padding: 10px;
    }
</style>
<?php

include "../extend/header.php";

//date_default_timezone_set('America/Chihuahua'); //Establece la zona horaria en Chihuahua
//date_default_timezone_set('America/Mexico_City'); //Establece la zona horaria en México

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location: ../../index.php");
    }

    $id = $_GET['idrecep'];
    //FECHA Y HORA
    //$fecha_inicio = date("Y-m-d h:i:s");

    $sql = "SELECT r.idrecepcion,r.fechahorarecep,p.idpaciente,p.nombre,r.edad,p.sexo,r.mtvoconsulta FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente WHERE r.idrecepcion = '$id'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================

    //Captura de datos
    if (!empty($_POST)) {

        $idrecepcion = isset($_POST["idrecepcion"]) ? mysqli_real_escape_string($con, $_POST['idrecepcion']) : "";
        $fechaingreso = isset($_POST["fechaingreso"]) ? mysqli_real_escape_string($con, $_POST['fechaingreso']) : "";
        $fechaalta = isset($_POST["fechaalta"]) ? mysqli_real_escape_string($con, $_POST['fechaalta']) : "";

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

        $notaingresourg = trim($notaingresourg);
        $idusuario = $_SESSION['idusuario'];


        if ($altapor === 'Observación') {

            /*
            LISTA DE CONDICION
            1 CONSULTADO
            2 EN OBSERVACION
            */

            //Realizamos la inserción de los datos si el tipo de cama es Observación
            $sql = "INSERT INTO consultas (idrecepcion, fechaingreso, fc, fr, ta, temperatura, glucosa, talla, peso, pabdominal, imc, notaingresourg, atnprehosp, tipourgencia, tiempotraslado, nombreunidad, trastrans, motivoatencion, tipocama, altapor, otraunidad, ministeriopublico, mujeredadfertil, afecprincipal, comorbilidad1, comorbilidad2, comorbilidad3, interconsulta1, interconsulta2, interconsulta3, procedim1, procedim2, procedim3, procedim4, procedim5, medicamento1, medicamento2, medicamento3, fechaalta, condicion, idusuario) VALUES ('$idrecepcion', '$fechaingreso', '$fc', '$fr', '$ta', '$temperatura', '$glucosa', '$talla', '$peso', '$pabdominal', '$imc', '$notaingresourg', '$atnprehosp', '$tipourgencia', '$tiempotraslado', '$nombreunidad', '$trastrans', '$motivoatencion', '$tipocama', '$altapor', '$otraunidad', '$ministeriopublico', '$mujeredadfertil', '$afecprincipal', '$comorbilidad1', '$comorbilidad2', '$comorbilidad3', '$interconsulta1', '$interconsulta2', '$interconsulta3', '$procedim1', '$procedim2', '$procedim3', '$procedim4', '$procedim5', '$medicamento1', '$medicamento2', '$medicamento3', NOW(), '2', '$idusuario')";

            $resins = $con->query($sql);

            $recepcion = "UPDATE recepciones SET condicion = 2 WHERE idrecepcion = '$id'";
            $consultado = $con->query($recepcion);
        } else {

            //Realizamos la inserción de los datos
            $sql = "INSERT INTO consultas (idrecepcion, fechaingreso, fc, fr, ta, temperatura, glucosa, talla, peso, pabdominal, imc, notaingresourg, atnprehosp, tipourgencia, tiempotraslado, nombreunidad, trastrans, motivoatencion, tipocama, altapor, otraunidad, ministeriopublico, mujeredadfertil, afecprincipal, comorbilidad1, comorbilidad2, comorbilidad3, interconsulta1, interconsulta2, interconsulta3, procedim1, procedim2, procedim3, procedim4, procedim5, medicamento1, medicamento2, medicamento3, fechaalta, condicion, idusuario) VALUES ('$idrecepcion', '$fechaingreso', '$fc', '$fr', '$ta', '$temperatura', '$glucosa', '$talla', '$peso', '$pabdominal', '$imc', '$notaingresourg', '$atnprehosp', '$tipourgencia', '$tiempotraslado', '$nombreunidad', '$trastrans', '$motivoatencion', '$tipocama', '$altapor', '$otraunidad', '$ministeriopublico', '$mujeredadfertil', '$afecprincipal', '$comorbilidad1', '$comorbilidad2', '$comorbilidad3', '$interconsulta1', '$interconsulta2', '$interconsulta3', '$procedim1', '$procedim2', '$procedim3', '$procedim4', '$procedim5', '$medicamento1', '$medicamento2', '$medicamento3', '$fechaalta', '1', '$idusuario')";

            $resins = $con->query($sql);

            $recepcion = "UPDATE recepciones SET condicion = 2 WHERE idrecepcion = '$id'";
            $consultado = $con->query($recepcion);
        }


        if ($resins > 0 && $consultado > 0) {

            echo "<script>
            alert('La consulta se guardo con exito');
            window.location = 'index.php';
        </script>";
        } else {

            echo "<script>
            alert('Error al guardar la consulta');
            window.location = 'index.php';
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

                        <h5>CONSULTA DE URGENCIAS</h5>
                        <hr>
                        <div style="color: red;">
                            <h3>Favor de capturar la fecha y hora de ingreso y la fecha y hora de alta, en formato de 24 horas. Gracias.</h3>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                                <div class="row">

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>Datos del paciente:</h6>
                                    </div>

                                    <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                        <label>Nombre:</label>
                                        <input type="hidden" name="idrecepcion" id="idrecepcion" value="<?php echo $id; ?>">
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

                                    <div class="form-group col-lg-7 col-md-7 col-sm-7">
                                        <h6>NOTA MEDICA DE INGRESO A URGENCIAS:</h6>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                        <label for="fechahorarecep" style="color: blue;">Fecha y hora de recepción urgencias: </label>
                                        <input type="text" style="background-color: aquamarine;" value="<?php echo date("d/m/Y - H:i", strtotime($fila['fechahorarecep'])); ?>" readonly>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <h6>Signos vitales:</h6>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                        <label for="fechaingreso" style="color: red;">Fecha y hora de inicio de la consulta*: </label>
                                        <input type="datetime-local" id="fechaingreso" name="fechaingreso" min="2023-06-01T00:00" required>
                                    </div>

                                    <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                        <label for="fechaalta" style="color: red;">Fecha y hora de alta*: </label>
                                        <input type="datetime-local" id="fechaalta" name="fechaalta" min="2023-06-01T00:00" required>
                                    </div>

                                    <!-- 12 -->

                                    <!-- ========== NOTA MEDICA DE LA CONSULTA DE URGENCIAS ==========-->
                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>FC: lpm</label>
                                        <input type="text" class="form-control" name="fc" id="fc" maxlength="10" placeholder="FC">
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>FR: rpm</label>
                                        <input type="text" class="form-control" name="fr" id="fr" maxlength="10" placeholder="FR">
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>TA: mm/Hg</label>
                                        <input type="text" class="form-control" name="ta" id="ta" maxlength="10" placeholder="TA">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Temperatura: °C</label>
                                        <input type="text" class="form-control" name="temperatura" id="temperatura" maxlength="10" placeholder="Temp">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Glucosa: mg/dl</label>
                                        <input type="text" class="form-control" name="glucosa" id="glucosa" maxlength="10" placeholder="Glucosa">
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>Talla:</label>
                                        <input type="text" class="form-control" name="talla" id="talla" maxlength="10" placeholder="Talla">
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>Peso:</label>
                                        <input type="text" class="form-control" name="peso" id="peso" maxlength="10" placeholder="Peso">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>P. Abdominal:</label>
                                        <input type="text" class="form-control" name="pabdominal" id="pabdominal" maxlength="10" placeholder="P. Abdominal">
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                        <label>IMC:</label>
                                        <input type="text" class="form-control" name="imc" id="imc" maxlength="10" placeholder="IMC">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>NOTAS:</h6>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="notaingresourg" id="notaingresourg" rows="10" cols="150" placeholder="Agregar la nota medica del servicio de urgencias" onblur="may(this.value, this.id)" value="" required>
                                        </textarea>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <h6>Consulta:</h6>
                                        <hr>
                                    </div>

                                    <!-- ======= HOJA DE URGENCIAS =============-->
                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Atención prehospitalaria (*):</label>
                                        <select class='form-control' name='atnprehosp' id='atnprehosp' required>
                                            <option value='' disabled selected>Atención prehospitalaria</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                        </select>
                                    </div>

                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Tipo de Urgencia (*):</label>
                                        <select class='form-control' name='tipourgencia' id='tipourgencia' required>
                                            <option value='' disabled selected>Tipo de urgencia</option>
                                            <option value='CALIFICADA'>CALIFICADA</option>
                                            <option value='NO CALIFICADA'>NO CALIFICADA</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                        <label>Tiempo de traslado:</label>
                                        <input type="text" class="form-control" name="tiempotraslado" id="tiempotraslado" maxlength="50" placeholder="Tiempo traslado" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                        <label>Nombre de la unidad:</label>
                                        <input type="text" class="form-control" name="nombreunidad" id="nombreunidad" maxlength="50" placeholder="Nombre de la unidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Traslado transitorio:</label>
                                        <select class='form-control' name='trastrans' id='trastrans'>
                                            <option value='' disabled selected>Traslado trans.</option>
                                            <option value='NO'>NO</option>
                                            <option value='SI'>SI</option>
                                        </select>
                                    </div>

                                    <!-- 12 -->

                                    <div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-12'>
                                        <label>Motivo de atención (*):</label>
                                        <select class='form-control' name='motivoatencion' id='motivoatencion' required>
                                            <option value='' disabled selected>Motivo de atención</option>
                                            <option value='Accidente, envenenamiento y violencia'>Accidente, envenenamiento y violencia</option>
                                            <option value='Médica'>Médica</option>
                                            <option value='Gineco-obstétrica'>Gineco-obstétrica</option>
                                            <option value='Pediátrica'>Pediátrica</option>
                                        </select>
                                    </div>

                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Tipo de cama (*):</label>
                                        <select class='form-control' name='tipocama' id='tipocama' required>
                                            <option value='' disabled selected>Tipo de cama</option>
                                            <option value='Observación'>Observación</option>
                                            <option value='Choque'>Choque</option>
                                            <option value='Sin cama'>Sin cama</option>
                                        </select>
                                    </div>

                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>Alta por: (*):</label>
                                        <select class='form-control' name='altapor' id='altapor' required>
                                            <option value='' disabled selected>Alta por</option>
                                            <option value='Domicilio'>Domicilio</option>
                                            <option value='Hospitalización'>Hospitalización</option>
                                            <option value='Consulta Externa'>Consulta Externa</option>
                                            <option value='Observación'>Observación</option>
                                            <option value='Traslado a otra unidad'>Traslado a otra unidad</option>
                                            <option value='Fuga'>Fuga</option>
                                            <option value='Defunción'>Defunción</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                        <label>Nombre de la unidad:</label>
                                        <input type="text" class="form-control" name="otraunidad" id="otraunidad" maxlength="50" placeholder="Unidad de traslado" onblur="may(this.value, this.id)">
                                    </div>

                                    <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                        <label>MUJER EN EDAD FERTIL:</label>
                                        <select class='form-control' name='mujeredadfertil' id='mujeredadfertil'>
                                            <option value='' disabled selected>Mujer en edad fertil</option>
                                            <option value='No estaba embarazada ni en el puerperio'>No estaba embarazada ni en el puerperio</option>
                                            <option value='Embarazo'>Embarazo</option>
                                            <option value='Puerperio (de 0 a 42 días después del parto)'>Puerperio (de 0 a 42 días después del parto)</option>
                                        </select>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <h6><label>AFECCIÓN PRINCIPAL:</label></h6>
                                        <input type="text" class="form-control" name="afecprincipal" id="afecprincipal" maxlength="100" placeholder="Afección principal (REQUERIDO), favor de agregar solamente un diagnostico" onblur="may(this.value, this.id)" required>
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="comorbilidad1" id="comorbilidad1" maxlength="100" placeholder="Diagnostico 1, favor de agregar solamente un diagnostico" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="comorbilidad2" id="comorbilidad2" maxlength="100" placeholder="Diagnostico 2, favor de agregar solamente un diagnostico" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="comorbilidad3" id="comorbilidad3" maxlength="100" placeholder="Diagnostico 3, favor de agregar solamente un diagnostico" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <h6><label>ESPECIALIDAD O INTERCONSULTAS:</label></h6>
                                        <input type="text" class="form-control" name="interconsulta1" id="interconsulta1" maxlength="50" placeholder="Especialidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="interconsulta2" id="interconsulta2" maxlength="50" placeholder="Especialidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="interconsulta3" id="interconsulta3" maxlength="50" placeholder="Especialidad" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <h6><label>PROCEDIMIENTOS:</label></h6>
                                        <input type="text" class="form-control" name="procedim1" id="procedim1" maxlength="70" placeholder="Procedimiento 1, favor de agregar solamente un procedimiento" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="procedim2" id="procedim2" maxlength="70" placeholder="Procedimiento 2, favor de agregar solamente un procedimiento" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="procedim3" id="procedim3" maxlength="70" placeholder="Procedimiento 3, favor de agregar solamente un procedimiento" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="procedim4" id="procedim4" maxlength="70" placeholder="Procedimiento 4, favor de agregar solamente un procedimiento" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="procedim5" id="procedim5" maxlength="70" placeholder="Procedimiento 5, favor de agregar solamente un procedimiento" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                        <h6><label>MEDICAMENTOS Y PRESENTACIÓN:</label></h6>
                                        <input type="text" class="form-control" name="medicamento1" id="medicamento1" maxlength="40" placeholder="Medicamento 1" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="medicamento2" id="medicamento2" maxlength="40" placeholder="Medicamento 2" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="medicamento3" id="medicamento3" maxlength="40" placeholder="Medicamento 3" onblur="may(this.value, this.id)">
                                    </div>

                                    <!-- 12 -->

                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="Guardar" id="Guardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
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
        document.getElementById("notaingresourg").value = "";
    </script>

    <script src="validacion.js"></script>
    </body>

    </html>

<?php } ?>