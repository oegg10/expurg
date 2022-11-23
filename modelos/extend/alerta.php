<?php

include_once '../../conexion/conexion.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Urgencias</title>

    <link rel="stylesheet" href="../../public/css/sweetalert2.css">

</head>

<body>

    <?php

    $mensaje = htmlentities($_GET['msj']);
    $c = htmlentities($_GET['c']);
    $p = htmlentities($_GET['p']);
    $t = htmlentities($_GET['t']);

    switch ($c) {
        case 'pac':
            $carpeta = '../pacientes/';
            break;

        case 'us':
            $carpeta = '../usuarios/';
            break;

        case 'rec':
            $carpeta = '../recepcion/';
            break;
    }

    switch ($p) {
        case 'in':
            $pagina = 'index.php';
            break;

        case 'pr':
            //Capturamos el ultimo id que se registro
            $sqlid = "SELECT idpaciente FROM pacientes ORDER BY idpaciente DESC LIMIT 1";
            $resultado = mysqli_query($con,$sqlid);
            $id = mysqli_fetch_row($resultado);
            //Cerramos la conexion
            $con->close();
            //Abrimos la pagina de recepcion y le mandamos el idpaciente
            $pagina = 'primerarecepcion.php?id='.$id[0];

            break;
    }

    $dir = $carpeta . $pagina;

    if ($t == "error") {
        $titulo = "Oppss..";
    } else {
        $titulo = "Muy bien :)";
    }


    ?>

    <script src="../../public/js/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/sweetalert2.js"></script>
    <!-- ALERTA -->
    <script>
        swal({
            title: "<?php echo $titulo ?>",
            text: "<?php echo $mensaje ?>",
            type: "<?php echo $t ?>",
            confirmButtonColor: '#3085d6',
            confirmButtonText: "Ok"
        }).then(function() {

            location.href = '<?php echo $dir ?>';

        });

        $(document).click(function() {
            location.href = '<?php echo $dir ?>';
        });

        $(document).keyup(function(e) {
            if (e.which == 27) {
                location.href = '<?php echo $dir ?>';
            }
        });
    </script>

</body>

</html>