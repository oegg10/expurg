<?php

include "../../conexion/conexion.php";

$idmedico = $_POST["idmedico"];

$citaSql = "SELECT idmedico, diasconsulta, numpacientes FROM medicos WHERE idmedico = '$idmedico'";
$resultado = $con->query($citaSql);
$fila = $resultado->fetch_assoc();

echo " Consulta los dias: ". $fila["diasconsulta"] . " - atiende " . $fila["numpacientes"] . " pacientes x día";