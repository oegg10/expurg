<?php

if (isset($_POST["idmedico"]) && $_POST["idmedico"] != '') {
    //Conexion BD
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "expurg";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    //$idmedico = $_POST["idmedico"];
    $sql = "SELECT nombremedico, diasconsulta FROM medicos WHERE idmedico = '$idmedico'";
    $result = $conn->query($sql);
   
    while($consulta = mysqli_fetch_array($result)){
        echo $consulta['diasconsulta'];
    }

    //Cerramos la conexion
    $conn->close();

}