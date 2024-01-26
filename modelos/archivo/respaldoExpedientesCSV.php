<?php

ob_start();

include "../../conexion/conexion.php";

$respaldoExpedientes = "SELECT idexpediente, nombrep, curp, tipopaciente, nombretrabajador, otros, observaciones, obs1, obs2, obs3, estado, idusuario, fechaalta FROM exparchivo";
$resultado = $con->query($respaldoExpedientes);

if ($resultado) {
    while ($r = $resultado->fetch_object()) {
        echo $r->idexpediente."|";
        echo $r->nombrep."|";
        echo $r->curp."|";
        echo $r->tipopaciente."|";
        echo $r->nombretrabajador."|";
        echo $r->otros."|";
        echo $r->observaciones."|";
        echo $r->obs1."|";
        echo $r->obs2."|";
        echo $r->obs3."|";
        echo $r->estado."|";
        echo $r->idusuario."|";
        echo $r->fechaalta."\n";
    }
}

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=resoaldoArchivo.csv;');

$resultado->close();
ob_end_flush();

?>