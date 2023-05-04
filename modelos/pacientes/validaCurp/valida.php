<?php

include_once "../../../conexion/conexion.php";

$tmp = "";

$sql = "SELECT idpaciente,expediente,nombre,curp,estado,condicion FROM pacientes LIMIT 1,3";
//$sql = "SELECT idpaciente,nombre,curp,numafiliacion FROM pacientes LIMIT 1,3";

if ($_POST["texto"] != "") {
    
    $sql = "SELECT idpaciente,expediente,nombre,curp,estado,condicion FROM pacientes WHERE condicion = 1 AND curp LIKE '".$_POST["texto"]."%'";

}

$tmp = "<table class='table table-hover'>
            <tr style='color: #388EE4'>
                <td>CURP</td>
                <td>Nombre</td>
                <td>Expediente</td>
                <td>Estado</td>
                <td>Crear recepción</td>
            </tr>";

$res = mysqli_query($con,$sql);

while ($reg = $res->fetch_array(MYSQLI_BOTH)) {

    $tmp.="<tr style='color:red'>
                <td>".$reg['curp']."</td>
                <td>".$reg['nombre']."</td>
                <td>".$reg['expediente']."</td>
                <td>".$reg['estado']."</td>
                <td><a href='../../modelos/recepcion/recepcion.php?id=" . $reg['idpaciente'] . "' type='button' class='btn btn-success' title='Crear recepción'><i class='fa fa-check'></i></a></td>
           </tr>";
    
}

$tmp.= "</table>";
echo $tmp;

$con->close();

?>