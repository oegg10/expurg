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

    $sql = "SELECT * FROM desconocidos WHERE iddesconocido = '$id'";

    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //Captura de datos
    if (!empty($_POST)) {

        $iddesconocido = isset($_POST["iddesconocido"]) ? mysqli_real_escape_string($con, $_POST['iddesconocido']) : "";
        $curp = isset($_POST["curp"]) ? mysqli_real_escape_string($con, $_POST['curp']) : "";
        
        $idusuario = $_SESSION['idusuario'];

        /*============ VALIDACIONES ===============*/

        $errores = [];

        $curp = trim($curp);

        // Validar CURP vacía
        if (empty($curp)) {
            $errores[] = 'La CURP no debe de estar vacía.';
        }

        // Validar numero de caracteres de la curp
        if (strlen($curp) < 18 || strlen($curp) > 18) {
            $errores[] = 'Favor de revisar la CURP.';
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

            //EDICION DE DATOS =======================================================
            $acreditar = "UPDATE desconocidos SET curp='$curp',
                        condicion= 2,
                        fechamodif= NOW(),
                        idusuario='$idusuario' WHERE iddesconocido = '$id'";

            $resultado = $con->query($acreditar);

            if ($resultado > 0) {

                header('location:../extend/alerta.php?msj=Desconocido ACREDITADO&c=rec&p=in&t=success');
                $con->close();
                exit();
            } else {

                header('location:../extend/alerta.php?msj=Error al modificar&c=rec&p=in&t=error');
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
                        <h5 style="color: red;">Acreditar desconocido</h5>
                    </div>

                    <div class="card-body">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" onsubmit="return enviarFormulario();">
                            <div class="row">

                                <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <label>Motivo de ingreso</label>
                                    <input type="hidden" value="<?php echo $id; ?>">
                                    <input type="text" class="form-control" value="<?php echo $fila['mtvoingreso']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Sexo(*):</label>
                                    <select class="form-control" disabled>
                                    <option value="<?php echo $fila['sexo']; ?>"><?php echo $fila['sexo']; ?></option>
                                    </select>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Rasgos particulares (*):</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['rasgos']; ?>" readonly>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Dónde fue encontrado (*):</label>
                                    <input type="text" class="form-control" value="<?php echo $fila['encontrado']; ?>" readonly>
                                </div>
                                <!-- 12 -->

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Quién lo trajo (*):</label>
                                    <select class="form-control" disabled>
                                        <option value="<?php echo $fila['trasladado']; ?>"><?php echo $fila['trasladado']; ?></option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Edad aparente(*):</label>
                                    <input type="number" class="form-control" value="<?php echo $fila['edadaparente']; ?>" readonly>
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>CURP(*) | <small><strong style="color: red;">Capturar correctamente la CURP</strong></small></label>
                                    <input type="text" class="form-control" name="curp" id="curp" autofocus minlength="18" maxlength="18" placeholder="CURP" pattern="[A-Z]{4}[0-9]{6}[A-Z0-9]{8}" required onblur="may(this.value, this.id)">
                                    <span></span>
                                </div>

                                <!-- FIN -->

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnAcreditar"><i class="fa fa-save"> Acreditar</i></button>
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
        let curp = document.getElementById("curp");

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
        curp.addEventListener("blur", validarCamposVacios);

        function enviarFormulario() {

            if (curp.value == null || curp.value == "") {
                alert("La CURP no puede estar vacía");
                curp.focus();
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