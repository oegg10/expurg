<?php

$conn = new mysqli("localhost", "root", "", "expurg");

if($conn->connect_error){

    die('Error de conexion' . $conn->connect_error);

}
