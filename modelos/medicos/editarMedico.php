<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 7) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM medicos WHERE idmedico = '$id'";
    $resultado = $con->query($sql);

    //Consulta de servicios
    $servicioSql = "SELECT idservicio, nombreservicio FROM servicios WHERE condicion = 1 ORDER BY nombreservicio";
    $resultServicio = $con->query($servicioSql);

    if (!empty($_POST)) {

        //https://www.php.net/manual/es/function.preg-replace.php      
        $idmedico = mysqli_real_escape_string($con, $_POST['idmedico']);
        $nombremedico = mysqli_real_escape_string($con, $_POST['nombremedico']);
        $curp = mysqli_real_escape_string($con, $_POST['curp']);
        $cedula = mysqli_real_escape_string($con, $_POST['cedula']);
        $idservicio = mysqli_real_escape_string($con, $_POST['idservicio']);
        $diasconsulta = implode(", ", $_POST['diasconsulta']);
        $numpacientes = mysqli_real_escape_string($con, $_POST['numpacientes']);

        //========================================================================================

        //Realizamos la inserción de los datos
        $editar = "UPDATE medicos SET nombremedico='$nombremedico', 
                                      curp='$curp', 
                                      cedula='$cedula',
                                      idservicio='$idservicio',
                                      diasconsulta='$diasconsulta',
                                      numpacientes='$numpacientes' WHERE idmedico = '$idmedico'";

        $editado = $con->query($editar);

        if ($editado > 0) {
            header('location:../extend/alerta.php?msj=EL registro a sido actualizado&c=medicos&p=in&t=success');
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar registro&c=medicos&p=in&t=error');
        }

        $con->close();

    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Editar Medico</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        while($fila = $resultado->fetch_assoc()){
                            $diasl = explode(", ", $fila['diasconsulta']);
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Nombre Medico*:</label>
                                    <input type="hidden" name="idmedico" id="idmedico" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" name="nombremedico" id="nombremedico" maxlength="200" value="<?php echo $fila['nombremedico']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <!-- 12 -->

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>CURP*:</label>
                                    <input type="text" class="form-control" name="curp" id="curp" minlength="18" maxlength="18" value="<?php echo $fila['curp']; ?>" required onblur="may(this.value, this.id)">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Cédula*:</label>
                                    <input type="text" class="form-control" name="cedula" id="cedula" maxlength="20" value="<?php echo $fila['cedula']; ?>" required>
                                </div>

                                <!-- 12 -->

                                <!-- ====== SELECT SERVICIOS ====== -->
                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label>Servicio (*):</label>
                                    <select class="form-control" name="idservicio" id="idservicio" required>
                                    <option value="" disabled selected>Seleccione Opción</option>
                                        <?php
                                            while ($servicio = $resultServicio->fetch_array(MYSQLI_BOTH)) {
                                                $idservicio = $servicio['idservicio'];
                                                $nombreservicio = $servicio['nombreservicio'];

                                        ?>
                                            <option value="<?php echo $idservicio; ?>"><?php echo $nombreservicio; ?></option>

                                        <?php
                                            }
                                        ?>
                                        
                                    </select>
                                </div>

                                <div class="form-group col-lg-5 col-md-5 col-sm-5">
                                    <label for="diasconsulta">Días de consulta (*)</label><br>
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Lunes" <?php if(in_array("Lunes", $diasl)) { echo "checked"; } ?>> Lunes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Martes" <?php if(in_array("Martes", $diasl)) { echo "checked"; } ?>> Martes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Miercoles" <?php if(in_array("Miercoles", $diasl)) { echo "checked"; } ?>> Miercoles
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Jueves" <?php if(in_array("Jueves", $diasl)) { echo "checked"; } ?>> Jueves
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Viernes" <?php if(in_array("Viernes", $diasl)) { echo "checked"; } ?>> Viernes
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Sábado" <?php if(in_array("Sábado", $diasl)) { echo "checked"; } ?>> Sábado
                                    <input type="checkbox" name="diasconsulta[]" id="diasconsulta" value="Domingo" <?php if(in_array("Domingo", $diasl)) { echo "checked"; } ?>> Domingo
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <label>Num. pacientes(*):</label>
                                    <input type="number" class="form-control" name="numpacientes" id="numpacientes" min="1" max="20" required>
                                </div>

                                <!-- FIN FORMULARIO -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" onclick="enviarFormulario()" name="editar"><i class="fa fa-pencil"> Editar</i></button>
                                    <a href="index.php" type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Cancelar</i></a>
                                </div>

                            </div>

                        </form>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    <script>

        let nombremedico = document.getElementById("nombremedico");
        let curp = document.getElementById("curp");
        let cedula = document.getElementById("cedula");
        let idservicio = document.getElementById("idservicio");
        let numpacientes = document.getElementById("numpacientes");

        //VALIDACION CAMPOS VACIOS
        const validarCamposVacios = (e) => {

            let campo = e.target;
            let valorcampo = e.target.value;

            if (valorcampo.trim().length == 0) {
                campo.classList.add("invalido");
                campo.nextElementSibling.classList.add("errorSpan");
                campo.nextElementSibling.innerText = "Este campo es requerido";
            } else {
                campo.classList.add("valido");
                campo.nextElementSibling.classList.remove("errorSpan");
                campo.nextElementSibling.innerText = "";
            }

        }

        nombremedico.addEventListener("blur", validarCamposVacios);
        curp.addEventListener("blur", validarCamposVacios);
        cedula.addEventListener("blur", validarCamposVacios);
        idservicio.addEventListener("blur", validarCamposVacios);
        numpacientes.addEventListener("blur", validarCamposVacios);

        function enviarFormulario() {

            let mensajesError = [];

            if (nombremedico.value == null || nombremedico.value == "") {
                mensajesError.push("El nombre del médico no debe estar vacío");
            }

            if (curp.value == null || curp.value == "") {
                mensajesError.push("La curp no debe estar vacía");
            }

            if (cedula.value == null || cedula.value == "") {
                mensajesError.push("La cédula del médico no debe estar vacía");
            }

            if (idservicio.value == null || idservicio.value == "") {
                mensajesError.push("El servicio no debe estar vacío");
            }

            if (numpacientes.value == null || numpacientes.value == "") {
                mensajesError.push("El número de pacientes no debe estar vacío");
            }

            if (numpacientes.value > 20) {
                mensajesError.push("El número de pacientes no debe exceder el limite de 20");
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