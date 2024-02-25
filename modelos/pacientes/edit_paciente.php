<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM pacientes WHERE idpaciente = '$id'";
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

                        <form action="editar.php" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Expediente:</label>
                                    <input type="hidden" value="<?php echo $fila['idpaciente']; ?>">
                                    <input type="text" class="form-control" name="expediente" id="expediente" maxlength="10" value="<?php echo $fila['expediente']; ?>">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre (*):</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" value="<?php echo $fila['nombre']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>CURP Paciente (*):</label>
                                    <input type="text" class="form-control" name="curp" id="curp" maxlength="18" value="<?php echo $fila['curp']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha nacimiento (*):</label>
                                    <input type="date" class="form-control" name="fechanac" id="fechanac" value="<?php echo $fila['fechanac']; ?>" required>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad nacimiento:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['entidadnac']; ?>" name="entidadnac" id="entidadnac" readonly>
                                </div>

                                <!--<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad nacimiento (*):</label>
                                    <select class="form-control" name="entidadnac" id="entidadnac" required>
                                        <option value="<?php //echo $fila['entidadnac']; ?>"><?php //echo $fila['entidadnac']; ?></option>
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
                                </div>-->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Sexo:</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['sexo']; ?>" name="sexo" id="sexo" readonly>
                                </div>

                                <!--<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Sexo (*):</label>
                                    <select class="form-control" name="sexo" id="sexo" required>
                                        <option value="<?php //echo $fila['sexo']; ?>"><?php //echo $fila['sexo']; ?></option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>-->

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Estado conyugal(*):</label>
                                    <select class="form-control" name="edocivil" id="edocivil" required>
                                        <option value="<?php echo $fila['edocivil']; ?>"><?php echo $fila['edocivil']; ?></option>
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
                                        <option value="<?php echo $fila['afiliacion']; ?>"><?php echo $fila['afiliacion']; ?></option>
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
                                    <input type="text" class="form-control" name="numafiliacion" id="numafiliacion" maxlength="21" value="<?php echo $fila['numafiliacion']; ?>">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Domicilio (*):</label>
                                    <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="100" value="<?php echo $fila['domicilio']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Colonia (*):</label>
                                    <input type="text" class="form-control" name="colonia" id="colonia" maxlength="40" value="<?php echo $fila['colonia']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>C.P.:</label>
                                    <input type="text" class="form-control" name="cp" id="cp" maxlength="5" value="<?php echo $fila['cp']; ?>">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Municipio (*):</label>
                                    <input type="text" class="form-control" name="municipio" id="municipio" maxlength="50" value="<?php echo $fila['municipio']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Localidad (*):</label>
                                    <input type="text" class="form-control" name="localidad" id="localidad" maxlength="50" value="<?php echo $fila['localidad']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Entidad domicilio (*):</label>
                                    <select class="form-control" name="entidaddom" id="entidaddom" required>
                                        <option value="<?php echo $fila['entidaddom']; ?>"><?php echo $fila['entidaddom']; ?></option>
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
                                    <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="10" value="<?php echo $fila['telefono']; ?>" pattern="[0-9]{10}">
                                    <input type="hidden" name="idpaciente" id="idpaciente" value="<?php echo $id; ?>">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <label>Observaciones:</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" value="<?php echo $fila['observaciones']; ?>" placeholder="Observaciones" onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Condición(*):</label>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="<?php echo $fila['estado']; ?>"><?php echo $fila['estado']; ?></option>
                                        <option value="Activo">Activo</option>
                                        <option value="Depurado">Depurado</option>
                                        <option value="Defunción">Defunción</option>
                                        <option value="Depurado y nvo. número">Depurado y nvo. número</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" name="editar"><i class="fa fa-pencil"> Editar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>

        function entidadNac() {

            let curp = document.getElementById("curp").value;
            
            const estadoNacimiento = curp.substring(13,11);
            const sexoCurp = curp.substring(10,11);

            //console.log(sexoCurp);

            switch (estadoNacimiento) {
                case "AS":
                    //console.log("AGUASCALIENTES");
                    document.getElementById("entidadnac").value = "AGUASCALIENTES";
                    break;
                case "BC":
                    document.getElementById("entidadnac").value = "BAJA CALIFORNIA";
                    break;
                case "BS":
                    document.getElementById("entidadnac").value = "BAJA CALIFORNIA SUR";
                    break;
                case "CC":
                    document.getElementById("entidadnac").value = "CAMPECHE";
                    break;
                case "CL":
                    document.getElementById("entidadnac").value = "COAHUILA";
                    break;
                case "CM":
                    document.getElementById("entidadnac").value = "COLIMA";
                    break;
                case "CS":
                    document.getElementById("entidadnac").value = "CHIAPAS";
                    break;
                case "CH":
                    document.getElementById("entidadnac").value = "CHIHUAHUA";
                    break;
                case "DF":
                    document.getElementById("entidadnac").value = "CIUDAD DE MEXICO";
                    break;
                case "DG":
                    document.getElementById("entidadnac").value = "DURANGO";
                    break;
                case "GT":
                    document.getElementById("entidadnac").value = "GUANAJUATO";
                    break;
                case "GR":
                    document.getElementById("entidadnac").value = "GUERRERO";
                    break;
                case "HG":
                    document.getElementById("entidadnac").value = "HIDALGO";
                    break;
                case "JC":
                    document.getElementById("entidadnac").value = "JALISCO";
                    break;
                case "MC":
                    document.getElementById("entidadnac").value = "MEXICO";
                    break;
                case "MN":
                    document.getElementById("entidadnac").value = "MICHOACAN";
                    break;
                case "MS":
                    document.getElementById("entidadnac").value = "MORELOS";
                    break;
                case "NT":
                    document.getElementById("entidadnac").value = "NAYARIT";
                    break;
                case "NL":
                    document.getElementById("entidadnac").value = "NUEVO LEON";
                    break;
                case "OC":
                    document.getElementById("entidadnac").value = "OAXACA";
                    break;
                case "PL":
                    document.getElementById("entidadnac").value = "PUEBLA";
                    break;
                case "QT":
                    document.getElementById("entidadnac").value = "QUERETARO";
                    break;
                case "QR":
                    document.getElementById("entidadnac").value = "QUINTANA ROO";
                    break;
                case "SP":
                    document.getElementById("entidadnac").value = "SAN LUIS POTOSI";
                    break;
                case "SL":
                    document.getElementById("entidadnac").value = "SINALOA";
                    break;
                case "SR":
                    document.getElementById("entidadnac").value = "SONORA";
                    break;
                case "TC":
                    document.getElementById("entidadnac").value = "TABASCO";
                    break;
                case "TS":
                    document.getElementById("entidadnac").value = "TAMAULIPAS";
                    break;
                case "TL":
                    document.getElementById("entidadnac").value = "TLAXCALA";
                    break;
                case "VZ":
                    document.getElementById("entidadnac").value = "VERACRUZ";
                    break;
                case "YN":
                    document.getElementById("entidadnac").value = "YUCATAN";
                    break;
                case "ZS":
                    document.getElementById("entidadnac").value = "ZACATECAS";
                    break;
                case "NE":
                    document.getElementById("entidadnac").value = "NACIDO EN EL EXTRANJERO";
                    break;

                default:
                    document.getElementById("entidadnac").value = "FAVOR DE VERIFICAR LA CURP";
                    document.getElementById("entidadnac").style.color = "red";
                
            }

            if (sexoCurp == "H") {
                document.getElementById("sexo").value = "Masculino";
            } else if(sexoCurp == "M") {
                document.getElementById("sexo").value = "Femenino";
            }else{
                document.getElementById("sexo").value = "FAVOR DE VERIFICAR LA CURP";
                document.getElementById("sexo").style.color = "red";
            }

        }

        curp.addEventListener("blur", entidadNac);

    </script>

</body>

</html>

<?php

}

ob_end_flush();

?>