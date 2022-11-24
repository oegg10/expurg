<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 4 && $_SESSION['idrol'] != 1) {
        header("Location:../../index.php");
    }

    $idc = $_GET['idc'];
    //$idr = $_GET['idr'];

    $sql = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.fc, c.fr, c.ta, c.temperatura, c.glucosa, c.talla, c.peso, c.pabdominal, c.imc, c.notaingresourg, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.idusuario, r.idrecepcion,p.idpaciente,p.nombre,r.edad,p.sexo,r.mtvoconsulta FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion WHERE idconsulta = '$idc'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Editar Paciente</h5>
                    </div>
                    <div class="card-body">

                        <form action="editarConsulta.php" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>Datos del paciente:</h6>
                                </div>

                                <div class="form-group col-lg-8 col-md-8 col-sm-8">
                                    <label>Nombre:</label>
                                    <input type="hidden" name="idconsulta" id="idconsulta" value="<?php echo $idc; ?>">
                                    <!-- <input type="hidden" name="idrecepcion" id="idrecepcion" value="<?php echo $idr; ?>"> -->
                                    <input type="hidden" name="idpaciente" value="<?php echo $fila['idpaciente']; ?>">
                                    <input type="text" name="nombrep" class="form-control" value="<?php echo $fila['nombre']; ?>" readonly>
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
                                    <input type="text" class="form-control" name="fc" id="fc" maxlength="10" placeholder="FC" value="<?php echo $fila['fc']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>FR: rpm</label>
                                    <input type="text" class="form-control" name="fr" id="fr" maxlength="10" placeholder="FR" value="<?php echo $fila['fr']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>TA: mm/Hg</label>
                                    <input type="text" class="form-control" name="ta" id="ta" maxlength="10" placeholder="TA" value="<?php echo $fila['ta']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Temperatura: °C</label>
                                    <input type="text" class="form-control" name="temperatura" id="temperatura" maxlength="10" placeholder="Temp" value="<?php echo $fila['temperatura']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Glucosa: mg/dl</label>
                                    <input type="text" class="form-control" name="glucosa" id="glucosa" maxlength="10" placeholder="Glucosa" value="<?php echo $fila['glucosa']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>Talla:</label>
                                    <input type="text" class="form-control" name="talla" id="talla" maxlength="10" placeholder="Talla" value="<?php echo $fila['talla']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>Peso:</label>
                                    <input type="text" class="form-control" name="peso" id="peso" maxlength="10" placeholder="Peso" value="<?php echo $fila['peso']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>P. Abdominal:</label>
                                    <input type="text" class="form-control" name="pabdominal" id="pabdominal" maxlength="10" placeholder="P. Abdominal" value="<?php echo $fila['pabdominal']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 col-sm-1">
                                    <label>IMC:</label>
                                    <input type="text" class="form-control" name="imc" id="imc" maxlength="10" placeholder="IMC" value="<?php echo $fila['imc']; ?>" readonly>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <h6>NOTAS:</h6>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <textarea name="notaingresourg" id="notaingresourg" rows="10" cols="150" placeholder="Agregar la nota medica del servicio de urgencias" readonly>
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
                                    <label>Fecha Ingreso:</label>
                                    <input type="datetime" class="form-control" name="fechaingreso" id="fechaingreso" value="<?php echo date("d-m-Y H:i:s", strtotime($fila['fechaingreso'])); ?>" readonly>

                                    <label>Atención prehospitalaria (*):</label>
                                    <select class='form-control' name='atnprehosp' id='atnprehosp' disabled>
                                        <option value="<?php echo $fila['atnprehosp']; ?>"><?php echo $fila['atnprehosp']; ?></option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>

                                    <label>Fecha Alta:</label>
                                    <input type="datetime" class="form-control" name="fechaalta" id="fechaalta" value="<?php echo date("d-m-Y H:i:s", strtotime($fila['fechaalta'])); ?>" readonly>

                                    <label>Tipo de Urgencia:</label>
                                    <select class='form-control' name='tipourgencia' id='tipourgencia' disabled>
                                        <option value="<?php echo $fila['tipourgencia']; ?>"><?php echo $fila['tipourgencia']; ?></option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Tiempo de traslado:</label>
                                    <input type="text" class="form-control" name="tiempotraslado" id="tiempotraslado" maxlength="50" placeholder="Tiempo traslado" value="<?php echo $fila['tiempotraslado']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                    <label>Nombre de la unidad:</label>
                                    <input type="text" class="form-control" name="nombreunidad" id="nombreunidad" maxlength="50" placeholder="Nombre de la unidad" value="<?php echo $fila['nombreunidad']; ?>" readonly>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Traslado transitorio:</label>
                                    <select class='form-control' name='trastrans' id='trastrans' disabled>
                                        <option value="<?php echo $fila['trastrans']; ?>"><?php echo $fila['trastrans']; ?></option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-12'>
                                    <label>Motivo de atención (*):</label>
                                    <select class='form-control' name='motivoatencion' id='motivoatencion' disabled>
                                        <option value="<?php echo $fila['motivoatencion']; ?>"><?php echo $fila['motivoatencion']; ?></option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Tipo de cama (*):</label>
                                    <select class='form-control' name='tipocama' id='tipocama' disabled>
                                        <option value="<?php echo $fila['tipocama']; ?>"><?php echo $fila['tipocama']; ?></option>
                                    </select>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>Alta por (*):</label>
                                    <select class='form-control' name='altapor' id='altapor' disabled>
                                        <option value="<?php echo $fila['altapor']; ?>"><?php echo $fila['altapor']; ?></option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                    <label>Nombre de la unidad:</label>
                                    <input type="text" class="form-control" name="otraunidad" id="otraunidad" maxlength="50" value="<?php echo $fila['otraunidad']; ?>" disabled>
                                </div>

                                <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                                    <label>MUJER EN EDAD FERTIL:</label>
                                    <select class='form-control' name='mujeredadfertil' id='mujeredadfertil' disabled>
                                        <option value="<?php echo $fila['mujeredadfertil']; ?>"><?php echo $fila['mujeredadfertil']; ?></option>
                                    </select>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>AFECCIÓN PRINCIPAL:</label></h6>
                                    <input type="text" class="form-control" name="afecprincipal" id="afecprincipal" value="<?php echo $fila['afecprincipal']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad1" id="comorbilidad1" value="<?php echo $fila['comorbilidad1']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad2" id="comorbilidad2" value="<?php echo $fila['comorbilidad2']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="comorbilidad3" id="comorbilidad3" value="<?php echo $fila['comorbilidad3']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>ESPECIALIDAD:</label></h6>
                                    <input type="text" class="form-control" name="interconsulta1" id="interconsulta1" value="<?php echo $fila['interconsulta1']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="interconsulta2" id="interconsulta2" value="<?php echo $fila['interconsulta2']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="interconsulta3" id="interconsulta3" value="<?php echo $fila['interconsulta3']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>PROCEDIMIENTOS:</label></h6>
                                    <input type="text" class="form-control" name="procedim1" id="procedim1" value="<?php echo $fila['procedim1']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim2" id="procedim2" value="<?php echo $fila['procedim2']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim3" id="procedim3" value="<?php echo $fila['procedim3']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim4" id="procedim4" value="<?php echo $fila['procedim4']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="procedim5" id="procedim5" value="<?php echo $fila['procedim5']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <h6><label>MEDICAMENTOS Y PRESENTACIÓN:</label></h6>
                                    <input type="text" class="form-control" name="medicamento1" id="medicamento1" value="<?php echo $fila['medicamento1']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="medicamento2" id="medicamento2" value="<?php echo $fila['medicamento2']; ?>" disabled>
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control" name="medicamento3" id="medicamento3" value="<?php echo $fila['medicamento3']; ?>" disabled>
                                </div>

                            </div>



                            <!-- 12 -->

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">

                                <a href="repCons1.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    </body>

    </html>

<?php

}

ob_end_flush();

?>