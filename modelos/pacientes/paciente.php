<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Registrar Paciente</h5>

                        <?php
                        $sql = "SELECT expediente FROM pacientes ORDER BY expediente DESC LIMIT 1";

                        $res = $con->query($sql);

                        while ($reg = $res->fetch_array(MYSQLI_BOTH)) {

                            echo "<h6>El último número de expediente otorgado es: <strong style='color: blue;'>". $reg[0]." <- Solo para archivo</strong></h6>" ;
                        }

                        ?>
                    </div>

                    <div class="card-body">

                        <form action="ins_paciente.php" method="POST" autocomplete="off" onsubmit="return validar();">
                            <div class="row">

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP(*) | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <input type="text" class="form-control" name="curp" id="curp" autofocus minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" required onblur="may(this.value, this.id)" onkeyup="busqueda();">
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del paciente" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>No. Expediente | <small><strong style="color: red;">Solo para archivo</strong></small></label>
                                    <input type="text" class="form-control" name="expediente" id="expediente" placeholder="Núm. expediente">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha nacimiento (*):</label>
                                    <input type="date" class="form-control" name="fechanac" id="fechanac" min="1925-01-01">
                                </div>

                                <!-- 12 -->

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosCurp"></div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad nacimiento (*):</label>
                                    <select class="form-control" name="entidadnac" id="entidadnac" required>
                                        <option value="" disabled selected>Entidad Nacimiento</option>
                                        <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                                        <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                                        <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                                        <option value="CAMPECHE">CAMPECHE</option>
                                        <option value="COAHUILA">COAHUILA</option>
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
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Sexo (*):</label>
                                    <select class="form-control" name="sexo" id="sexo" required>
                                        <option value="" disabled selected>Sexo</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Estado conyugal(*):</label>
                                    <select class="form-control" name="edocivil" id="edocivil" required>
                                        <option value="" disabled selected>Estado Conyugal</option>
                                        <option value="EN UNION LIBRE">EN UNION LIBRE</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="SE IGNORA">SE IGNORA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Afiliación (*):</label>
                                    <select class="form-control" name="afiliacion" id="afiliacion" required>
                                        <option value="" disabled selected>Afiliacion</option>
                                        <option value="INSABI">INSABI</option>
                                        <option value="IMSS">IMSS</option>
                                        <option value="ISSSTE">ISSSTE</option>
                                        <option value="PEMEX">PEMEX</option>
                                        <option value="SEDENA">SEDENA</option>
                                        <option value="SEMAR">SEMAR</option>
                                        <option value="GOB. ESTATAL">GOB. ESTATAL</option>
                                        <option value="SEGURO PRIVADO">SEGURO PRIVADO</option>
                                        <option value="NINGUNO">NINGUNO</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>No. Seguro:</label>
                                    <input type="text" class="form-control" name="numafiliacion" id="numafiliacion" maxlength="21" placeholder="No. seguro">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Domicilio (*):</label>
                                    <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="100" placeholder="Domicilio" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Colonia (*):</label>
                                    <input type="text" class="form-control" name="colonia" id="colonia" maxlength="40" placeholder="Colonia" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>C.P.:</label>
                                    <input type="text" class="form-control" name="cp" id="cp" maxlength="5" placeholder="código postal" pattern="[0-9]{5}">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Municipio (*):</label>
                                    <input type="text" class="form-control" name="municipio" id="municipio" maxlength="50" placeholder="Municipio" required onblur="may(this.value, this.id)" value="SALTILLO">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Localidad (*):</label>
                                    <input type="text" class="form-control" name="localidad" id="localidad" maxlength="50" placeholder="Localidad" required onblur="may(this.value, this.id)" value="SALTILLO">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad domicilio (*):</label>
                                    <select class="form-control" name="entidaddom" id="entidaddom" required>
                                        <option value="" disabled selected>Entidad domicilio</option>
                                        <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                                        <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                                        <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                                        <option value="CAMPECHE">CAMPECHE</option>
                                        <option value="COAHUILA">COAHUILA</option>
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Teléfono:</label>
                                    <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="10" placeholder="Teléfono" pattern="[0-9]{10}">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Condición(*):</label>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="Activo">Activo</option>
                                        <option value="Depurado">Depurado</option>
                                        <option value="Defunción">Defunción</option>
                                        <option value="Depurado y nvo. número">Depurado y nvo. número</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p id="mensajeError" style="color: red;"></p>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <?php include "../extend/footer.php"; ?>
            </div>
        </div>
    </div>

    <script src="validaCurp/funcion.js"></script>
    <!-- <script src="validaCurp/validaPaciente.js"></script> -->


    </body>

    </html>

<?php
}

ob_end_flush();
?>