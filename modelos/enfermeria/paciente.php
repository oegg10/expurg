<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 6) {
        header("Location:../../index.php");
    }

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    <h5>Registrar Paciente</h5>
                </div>
                <div class="card-body">

                <form action="ins_paciente.php" method="POST" autocomplete="off">
                        <div class="row">

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Expediente:</label>
                                <input type="text" class="form-control" name="expediente" id="expediente" maxlength="10" placeholder="No. Expediente" autofocus>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre (*):</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del paciente" required onblur="may(this.value, this.id)">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>CURP Paciente (*):</label>
                                <input type="text" class="form-control" name="curp" id="curp" maxlength="18" placeholder="CURP" required onblur="may(this.value, this.id)">
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Fecha nacimiento (*):</label>
                                <input type="date" class="form-control" name="fechanac" id="fechanac" required>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Entidad nacimiento (*):</label>
                                <select class="form-control" name="entidadnac" id="entidadnac" required>
                                    <option value="" disabled selected>Entidad Nacimiento</option>
                                    <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                                    <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                                    <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                                    <option value="CAMPECHE">CAMPECHE</option>
                                    <option value="COAHUILA DE ZARAGOZA">COAHUILA DE ZARAGOZA</option>
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
                                    <option value="MICHOACAN DE OCAMPO">MICHOACAN DE OCAMPO</option>
                                    <option value="MORELOS">MORELOS</option>
                                    <option value="NAYARIT">NAYARIT</option>
                                    <option value="NUEVO LEON">NUEVO LEON</option>
                                    <option value="OAXACA">OAXACA</option>
                                    <option value="PUEBLA">PUEBLA</option>
                                    <option value="QUERETARO ARTEAGA">QUERETARO ARTEAGA</option>
                                    <option value="QUINTANA ROO">QUINTANA ROO</option>
                                    <option value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
                                    <option value="SINALOA">SINALOA</option>
                                    <option value="SONORA">SONORA</option>
                                    <option value="TABASCO">TABASCO</option>
                                    <option value="TAMAULIPAS">TAMAULIPAS</option>
                                    <option value="TLAXCALA">TLAXCALA</option>
                                    <option value="VERACRUZ DE IGNACIO DE LA LLAVE">VERACRUZ DE IGNACIO DE LA LLAVE</option>
                                    <option value="YUCATAN">YUCATAN</option>
                                    <option value="ZACATECAS">ZACATECAS</option>
                                    <option value="ESTADOS UNIDOS DE NORTEAMERICA">ESTADOS UNIDOS DE NORTEAMERICA</option>
                                    <option value="OTROS PAISES DE LATINOAMERICA">OTROS PAISES DE LATINOAMERICA</option>
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

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
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

                            <!-- 12 -->

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Afiliación (*):</label>
                                <select class="form-control" name="afiliacion" id="afiliacion" required>
                                    <option value="" disabled selected>Afiliacion</option>
                                    <option value="SEGURO POPULAR">SEGURO POPULAR</option>
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

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Domicilio (*):</label>
                                <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="100" placeholder="Domicilio" required onblur="may(this.value, this.id)">
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Colonia (*):</label>
                                <input type="text" class="form-control" name="colonia" id="colonia" maxlength="40" placeholder="Colonia" required onblur="may(this.value, this.id)">
                            </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>C.P.:</label>
                                <input type="text" class="form-control" name="cp" id="cp" maxlength="5" placeholder="código postal">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Municipio (*):</label>
                                <input type="text" class="form-control" name="municipio" id="municipio" maxlength="50" placeholder="Municipio" required onblur="may(this.value, this.id)">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Localidad (*):</label>
                                <input type="text" class="form-control" name="localidad" id="localidad" maxlength="50" placeholder="Localidad" required onblur="may(this.value, this.id)">
                            </div>

                            <!-- 12 -->

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Entidad domicilio (*):</label>
                                <select class="form-control" name="entidaddom" id="entidaddom" required>
                                    <option value="" disabled selected>Entidad domicilio</option>
                                    <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                                    <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                                    <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                                    <option value="CAMPECHE">CAMPECHE</option>
                                    <option value="COAHUILA DE ZARAGOZA">COAHUILA DE ZARAGOZA</option>
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
                                    <option value="MICHOACAN DE OCAMPO">MICHOACAN DE OCAMPO</option>
                                    <option value="MORELOS">MORELOS</option>
                                    <option value="NAYARIT">NAYARIT</option>
                                    <option value="NUEVO LEON">NUEVO LEON</option>
                                    <option value="OAXACA">OAXACA</option>
                                    <option value="PUEBLA">PUEBLA</option>
                                    <option value="QUERETARO ARTEAGA">QUERETARO ARTEAGA</option>
                                    <option value="QUINTANA ROO">QUINTANA ROO</option>
                                    <option value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
                                    <option value="SINALOA">SINALOA</option>
                                    <option value="SONORA">SONORA</option>
                                    <option value="TABASCO">TABASCO</option>
                                    <option value="TAMAULIPAS">TAMAULIPAS</option>
                                    <option value="TLAXCALA">TLAXCALA</option>
                                    <option value="VERACRUZ DE IGNACIO DE LA LLAVE">VERACRUZ DE IGNACIO DE LA LLAVE</option>
                                    <option value="YUCATAN">YUCATAN</option>
                                    <option value="ZACATECAS">ZACATECAS</option>
                                    <option value="ESTADOS UNIDOS DE NORTEAMERICA">ESTADOS UNIDOS DE NORTEAMERICA</option>
                                    <option value="OTROS PAISES DE LATINOAMERICA">OTROS PAISES DE LATINOAMERICA</option>
                                    <option value="OTROS PAISES">OTROS PAISES</option>
                                    <option value="NO ESPECIFICADO">NO ESPECIFICADO</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Teléfono:</label>
                                <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="10" placeholder="Teléfono" pattern="[0-9]{10}">
                            </div>

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

<?php
}

ob_end_flush();
?>