<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    //Captura de datos
    if (!empty($_POST)) {

        $mtvoingreso = isset($_POST["mtvoingreso"]) ? mysqli_real_escape_string($con, $_POST['mtvoingreso']) : "";
        $sexo = isset($_POST["sexo"]) ? mysqli_real_escape_string($con, $_POST['sexo']) : "";
        $rasgos = isset($_POST["rasgos"]) ? mysqli_real_escape_string($con, $_POST['rasgos']) : "";
        $encontrado = isset($_POST["encontrado"]) ? mysqli_real_escape_string($con, $_POST['encontrado']) : "";
        $trasladado = isset($_POST["trasladado"]) ? mysqli_real_escape_string($con, $_POST['trasladado']) : "";
        $edadaparente = isset($_POST["edadaparente"]) ? mysqli_real_escape_string($con, $_POST['edadaparente']) : "";

        $idusuario = $_SESSION['idusuario'];

        /*============ VALIDACIONES ===============*/

        $errores = [];

        // Validar motivo de ingreso
        if (empty($mtvoingreso)) {
            $errores[] = 'El motivo de ingreso no debe estar vacío.';
        }

        // Validar motivo de ingreso
        if (empty($sexo)) {
            $errores[] = 'El campo sexo no debe estar vacío.';
        }

        // Validar motivo de ingreso
        if (empty($rasgos)) {
            $errores[] = 'Rasgos particulares no debe estar vacío.';
        }

        // Validar motivo de ingreso
        if (empty($encontrado)) {
            $errores[] = 'Dónde fue encontrado no debe estar vacío.';
        }

        // Validar motivo de ingreso
        if (empty($trasladado)) {
            $errores[] = 'Quién lo trajo no debe estar vacío.';
        }

        // Validar motivo de ingreso
        if (empty($edadaparente)) {
            $errores[] = 'Edad aparente no debe estar vacío.';
        }

        // Mostrar errores si los hay
        if (!empty($errores)) {
            echo '<h2 style="color: red;">Errores:</h2>';
            echo '<ul>';
            foreach ($errores as $error) {
                echo '<li style="color: red;">' . $error . '</li>';
            }
            echo '</ul>';

        } else {
            // Si no hay errores
            /*ASIGNACION DE CONDICION
            1 Desconocido
            2 Acreditado
            */

            //Realizamos la inserción de los datos
            $inssql = "INSERT INTO desconocidos (mtvoingreso, sexo, rasgos, encontrado, trasladado, edadaparente, condicion, fechaalta, idusuario) VALUES ('$mtvoingreso', '$sexo', '$rasgos', '$encontrado', '$trasladado', '$edadaparente', 1, NOW(), '$idusuario')";

            $resultado = $con->query($inssql);

            if ($resultado > 0) {

                header('location:../extend/alerta.php?msj=Desconocido guardado&c=rec&p=in&t=success');
                $con->close();
                exit();
            } else {

                header('location:../extend/alerta.php?msj=Error al registrar&c=rec&p=in&t=error');
            }

            $con->close();

        }        
        
    }

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5 style="color: red;">Registrar desconocido</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" onsubmit="return enviarFormulario();">
                            <div class="row">

                                <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <label>Motivo de ingreso</label>
                                    <input type="text" class="form-control" name="mtvoingreso" id="mtvoingreso" autofocus minlength="4" maxlength="250" placeholder="Motivo de ingreso" required onblur="may(this.value, this.id)">
                                    <span></span>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Sexo(*):</label>
                                    <select class="form-control" name="sexo" id="sexo" required>
                                        <option value="" disabled selected>Elija una opción</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                    </select>
                                    <span></span>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Rasgos particulares (*):</label>
                                    <input type="text" class="form-control" name="rasgos" id="rasgos" placeholder="Rasgos particulares" required onblur="may(this.value, this.id)">
                                    <span></span>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Dónde fue encontrado (*):</label>
                                    <input type="text" class="form-control" name="encontrado" id="encontrado" placeholder="Dónde fue encontrado" required onblur="may(this.value, this.id)">
                                    <span></span>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Quién lo trajo (*):</label>
                                    <select class="form-control" name="trasladado" id="trasladado" required>
                                        <option value="" disabled selected>Elija una opción</option>
                                        <option value="AMBULANCIA">AMBULANCIA</option>
                                        <option value="POLICIA">POLICIA</option>
                                        <option value="TERCERA PERSONA">TERCERA PERSONA</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                    <span></span>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad aparente(*):</label>
                                    <input type="number" class="form-control" name="edadaparente" id="edadaparente" required>
                                    <span></span>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnEditar"><i class="fa fa-save"> Editar</i></button>
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

        /*======= VARIABLES =====*/
        let mtvoingreso = document.getElementById("mtvoingreso");
        let sexo = document.getElementById("sexo");
        let rasgos = document.getElementById("rasgos");
        let encontrado = document.getElementById("encontrado");
        let trasladado = document.getElementById("trasladado");
        let edadaparente = document.getElementById("edadaparente");

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

        //CAMPOS A VALIDAR:
        mtvoingreso.addEventListener("blur", validarCamposVacios);
        sexo.addEventListener("blur", validarCamposVacios);
        rasgos.addEventListener("blur", validarCamposVacios);
        encontrado.addEventListener("blur", validarCamposVacios);
        trasladado.addEventListener("blur", validarCamposVacios);
        edadaparente.addEventListener("blur", validarCamposVacios);


        function enviarFormulario() {

            if (mtvoingreso.value == null || mtvoingreso.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                mtvoingreso.focus();
                return false;
            }

            if (sexo.value == null || sexo.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                sexo.focus();
                return false;
            }

            if (rasgos.value == null || rasgos.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                rasgos.focus();
                return false;
            }

            if (encontrado.value == null || encontrado.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                encontrado.focus();
                return false;
            }

            if (trasladado.value == null || trasladado.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                trasladado.focus();
                return false;
            }

            if (edadaparente.value == null || edadaparente.value == "") {
                alert("El motivo de ingreso no puede estar vacío");
                edadaparente.focus();
                return false;
            }

            return true;

        }
        

    </script>

    </body>

    </html>

<?php
}

ob_end_flush();
?>