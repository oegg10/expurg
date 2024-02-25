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
                    </div>

                    <div class="card-body">

                        <form action="ins_paciente.php" method="POST" autocomplete="off" onsubmit="return validar();">
                            <div class="row">

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP(*) | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <!-- num. de expediente oculto -->
                                    <input type="hidden" name="expediente" id="expediente">
                                    <!-- ============================================== -->
                                    <input type="text" class="form-control" name="curp" id="curp" autofocus minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" required onblur="may(this.value, this.id)" onkeyup="busqueda();">
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del paciente" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha nacimiento:</label>
                                    <input type="date" class="form-control" name="fechanac" id="fechanac" readonly>
                                </div>

                                <!-- 12 -->

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosCurp"></div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad nacimiento:</label>
                                    <input type="text" class="form-control" name="entidadnac" id="entidadnac" readonly>
                                </div>

                                <!--<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                                </div>-->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Sexo:</label>
                                    <input type="text" class="form-control" name="sexo" id="sexo" readonly>
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
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save" onclick="enviarFormulario()"> Guardar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div id="error"></div>
                    
                </div>
                <?php include "../extend/footer.php"; ?>
            </div>
        </div>
    </div>

    <script>

        function entidadNac() {

            let curp = document.getElementById("curp").value;
            
            const estadoNacimiento = curp.substring(13,11);
            const sexoCurp = curp.substring(10,11);

            //=============== EXTRAE LA ENTIDAD DE NACIMIENTO DE LA CURP =================

            switch (estadoNacimiento) {
                case "AS":
                    //console.log("AGUASCALIENTES");
                    document.getElementById("entidadnac").value = "AGUASCALIENTES";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "BC":
                    document.getElementById("entidadnac").value = "BAJA CALIFORNIA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "BS":
                    document.getElementById("entidadnac").value = "BAJA CALIFORNIA SUR";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "CC":
                    document.getElementById("entidadnac").value = "CAMPECHE";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "CL":
                    document.getElementById("entidadnac").value = "COAHUILA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "CM":
                    document.getElementById("entidadnac").value = "COLIMA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "CS":
                    document.getElementById("entidadnac").value = "CHIAPAS";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "CH":
                    document.getElementById("entidadnac").value = "CHIHUAHUA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "DF":
                    document.getElementById("entidadnac").value = "CIUDAD DE MEXICO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "DG":
                    document.getElementById("entidadnac").value = "DURANGO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "GT":
                    document.getElementById("entidadnac").value = "GUANAJUATO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "GR":
                    document.getElementById("entidadnac").value = "GUERRERO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "HG":
                    document.getElementById("entidadnac").value = "HIDALGO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "JC":
                    document.getElementById("entidadnac").value = "JALISCO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "MC":
                    document.getElementById("entidadnac").value = "MEXICO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "MN":
                    document.getElementById("entidadnac").value = "MICHOACAN";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "MS":
                    document.getElementById("entidadnac").value = "MORELOS";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "NT":
                    document.getElementById("entidadnac").value = "NAYARIT";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "NL":
                    document.getElementById("entidadnac").value = "NUEVO LEON";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "OC":
                    document.getElementById("entidadnac").value = "OAXACA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "PL":
                    document.getElementById("entidadnac").value = "PUEBLA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "QT":
                    document.getElementById("entidadnac").value = "QUERETARO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "QR":
                    document.getElementById("entidadnac").value = "QUINTANA ROO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "SP":
                    document.getElementById("entidadnac").value = "SAN LUIS POTOSI";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "SL":
                    document.getElementById("entidadnac").value = "SINALOA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "SR":
                    document.getElementById("entidadnac").value = "SONORA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "TC":
                    document.getElementById("entidadnac").value = "TABASCO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "TS":
                    document.getElementById("entidadnac").value = "TAMAULIPAS";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "TL":
                    document.getElementById("entidadnac").value = "TLAXCALA";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "VZ":
                    document.getElementById("entidadnac").value = "VERACRUZ";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "YN":
                    document.getElementById("entidadnac").value = "YUCATAN";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "ZS":
                    document.getElementById("entidadnac").value = "ZACATECAS";
                    document.getElementById("entidadnac").style.color = "black";
                    break;
                case "NE":
                    document.getElementById("entidadnac").value = "NACIDO EN EL EXTRANJERO";
                    document.getElementById("entidadnac").style.color = "black";
                    break;

                default:
                    document.getElementById("entidadnac").value = "FAVOR DE VERIFICAR LA CURP";
                    document.getElementById("entidadnac").style.color = "red";
                
            }

            //=============== EXTRAE EL SEXO DE LA CURP =================

            if (sexoCurp == "H") {
                document.getElementById("sexo").value = "Masculino";
                document.getElementById("sexo").style.color = "black";
            } else if(sexoCurp == "M") {
                document.getElementById("sexo").value = "Femenino";
                document.getElementById("sexo").style.color = "black";
            }else{
                document.getElementById("sexo").value = "FAVOR DE VERIFICAR LA CURP";
                document.getElementById("sexo").style.color = "red";
            }

            //=============== EXTRAE LA FECHA DE NACIMIENTO DE LA CURP =================
            
            var fechaNacimiento = curp.substring(4, 10); // Extraer yymmdd
            
            var año = parseInt(fechaNacimiento.substring(0, 2));
            var mes = parseInt(fechaNacimiento.substring(2, 4)) - 1; // Meses en JavaScript son de 0 a 11
            var dia = parseInt(fechaNacimiento.substring(4, 6));
            
            var digitoGeneracion = curp.charAt(16); // Dígito que indica la generación (siglo XX o XXI)
            
            if (digitoGeneracion === '0' || digitoGeneracion === '1') {
                año += 1900; // Siglo XX
            } else {
                año += 2000; // Siglo XXI
            }
            
            var fecha = new Date(año, mes, dia);
            
            // Formatear la fecha al formato "yyyy-mm-dd"
            var fechaFormateada = fecha.toISOString().substring(0, 10);
            
            document.getElementById("fechanac").value = fechaFormateada;
            //============== FIN EXTRAE LA FECHA DE NACIMIENTO DE LA CURP ================


        }

        curp.addEventListener("blur", entidadNac);

        //=========== VALIDACION DE CAMPOS =======================
        function enviarFormulario() {

            //VARIABLES A VALIDAR ================================
            let curp = document.getElementById("curp").value;
            let nombre = document.getElementById("nombre").value;
            let fechanac = document.getElementById("fechanac").value;
            let entidadnac = document.getElementById("entidadnac").value;
            let sexo = document.getElementById("sexo").value;
            let edocivil = document.getElementById("edocivil").value;
            let afiliacion = document.getElementById("afiliacion").value;
            let domicilio = document.getElementById("domicilio").value;
            let colonia = document.getElementById("colonia").value;
            let municipio = document.getElementById("municipio").value;
            let localidad = document.getElementById("localidad").value;
            let entidaddom = document.getElementById("entidaddom").value;

            let mensajesError = [];

            if (curp.length < 18) {
                alert("La CURP debe tener al menos 18 caracteres");
                return;
            }

            if (nombre === "" || nombre === NULL) {
                mensajesError.push("El nombre no debe estar vacío");
            }

            if (fechanac === "" || fechanac === NULL) {
                mensajesError.push("La fecha de nacimiento no debe estar vacía");
            }

            if (entidadnac === "" || entidadnac === NULL || entidadnac === "FAVOR DE VERIFICAR LA CURP") {
                mensajesError.push("La entidad de nacimiento no debe estar vacía");
            }

            if (sexo === "" || sexo === NULL || sexo === "FAVOR DE VERIFICAR LA CURP") {
                mensajesError.push("El campo sexo no debe estar vacío");
            }

            if (edocivil === "" || edocivil === NULL) {
                mensajesError.push("El estado civil no debe estar vacío");
            }

            if (afiliacion === "" || afiliacion === NULL) {
                mensajesError.push("La afiliación no debe estar vacía");
            }

            if (domicilio === "" || domicilio === NULL) {
                mensajesError.push("El domicilio no debe estar vacío");
            }

            if (colonia === "" || colonia === NULL) {
                mensajesError.push("La colonia no debe estar vacía");
            }

            if (municipio === "" || municipio === NULL) {
                mensajesError.push("El municipio no debe estar vacío");
            }

            if (localidad === "" || localidad === NULL) {
                mensajesError.push("La localidad no debe estar vacía");
            }

            if (entidaddom === "" || entidaddom === NULL) {
                mensajesError.push("La entidad de domicilio no debe estar vacía");
            }

            error.innerHTML = mensajesError.join(", ");

            return false;

        }

    </script>

    <script src="validaCurp/funcion.js"></script>


    </body>

    </html>

<?php
}

ob_end_flush();
?>