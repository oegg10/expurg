<?php

//@session_start();

//Variables
$host = "localhost";
$user = "root";
$pass = "";
$db = "expurg";

//Conexion
$con = new mysqli($host,$user,$pass,$db);
$con->set_charset("utf8");

if (mysqli_connect_errno()) {
    echo "No Se pudo conectar a la base de datos: " . "<h1>".$db."</h1>" . " " . mysqli_connect_error();
    exit();
}

?>