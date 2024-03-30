<?php

include "../../conexion/conexion.php";

$idmedico = $_POST["idmedico"];
$fechacita = $_POST["fechacita"];

$citadosSql = "SELECT fechacita, COUNT(*) AS conteo FROM ( SELECT fechacita FROM citas_ce WHERE idmedico = '$idmedico' UNION ALL SELECT fechacita FROM citascenvo WHERE idmedico = '$idmedico' ) AS combined_tables GROUP BY fechacita HAVING COUNT(*) > 1";
$resultado = $con->query($citadosSql);

/* $citadosSql = "SELECT COUNT(*) as conteo, m.numpacientes FROM citas_ce c INNER JOIN medicos m ON c.idmedico = m.idmedico WHERE fechacita = '$fechacita' AND c.idmedico = '$idmedico'";
$resultado = $con->query($citadosSql); */

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    if ($fila["conteo"] > 0) {
        $citasR = $fila["conteo"] + 1;
        echo "Citados este día: ". $fila["conteo"] . " más esta cita serían: " . $citasR;
    } else {
        echo "No hay citas registradas este día"; // Si no se encontraron registros
    }
    
} else {
    echo "No hay citas registradas este día"; // Si no se encontraron registros
}

$con->close();
