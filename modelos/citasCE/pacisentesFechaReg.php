<?php

include "../../conexion/conexion.php";

$idmedico = $_POST["idmedico"];
$fechacita = $_POST["fechacita"];

$citadosSql = "SELECT COUNT(*) as total, m.numpacientes FROM citas_ce c INNER JOIN medicos m ON c.idmedico = m.idmedico WHERE fechacita = '$fechacita' AND c.idmedico = '$idmedico'";
$resultado = $con->query($citadosSql);
$fila = $resultado->fetch_assoc();

//
$citasR = $fila["numpacientes"] - $fila["total"];

echo "Citados este día: ". $fila["total"] . " restan " . "$citasR" . " por cubrir";