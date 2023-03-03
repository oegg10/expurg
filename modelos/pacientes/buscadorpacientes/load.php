<?php

//select p.idpaciente AS idpaciente,p.expediente AS expediente,p.nombre AS nombre,p.curp AS curp,date_format(from_days(to_days(current_timestamp()) - to_days(p.fechanac)),'%Y') + 0 AS edad,p.sexo AS sexo,p.fechanac AS fechanac,p.status AS status,p.fechaalta AS fechaalta, p.idusuario AS idusuario, u.nombre AS usuario from (expurg.pacientes p join expurg.usuarios u on(p.idusuario = u.idusuario)) order by p.idpaciente desc

require_once "config.php";

$columns = ['idpaciente','expediente','nombre', 'curp', 'edad', 'sexo', 'fechanac','status','idusuario','usuario','fechaalta'];
//Obtenemos los datos de la VISTA PACIENTES
$table = "v_pacientes";
$id = 'idpaciente';

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$where = '';

if($campo != null){

    $where = "WHERE (";

    $cont = count($columns);

    for($i = 0; $i < $cont; $i++){

        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";

    }

    $where = substr_replace($where, "", -3);
    $where .= ")";

}

/* LIMIT */
$limit = isset($_POST['registros']) ? $conn->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conn->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}else{

    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio ,  $limit";

// CONSULTA
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . " FROM $table $where $sLimit";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

/* CONSULTA PARA TOTAL DE REGISTROS FILTRADOS */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conn->query($sqlFiltro);
$rowFiltro = $resFiltro->fetch_array();
$totalFiltro = $rowFiltro[0];

/* CONSULTA PARA TOTAL DE REGISTROS FILTRADOS */
$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conn->query($sqlTotal);
$rowTotal = $resTotal->fetch_array();
$totalRegistros = $rowTotal[0];

/* MOSTRANDO RESULTADOS */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if($num_rows > 0){

 while($row = $resultado->fetch_assoc()){

    $output['data'] .= '<tr>';
    $output['data'] .= '<td>'.$row['expediente'].'</td>';
    $output['data'] .= '<td>'.$row['nombre'].'</td>';
    $output['data'] .= '<td>'.$row['sexo'].'</td>';
    $output['data'] .= '<td>'.$row['edad'].'</td>';
    $output['data'] .= '<td>'.$row['curp'].'</td>';
    $output['data'] .= '<td>'.date("d-m-Y", strtotime($row['fechanac'])).'</td>';
    $output['data'] .= '<td>'.$row['status'].'</td>';
    $output['data'] .= '<td>'.$row['usuario'].'</td>';
    $output['data'] .= '<td>'.date("d-m-Y H:m:s", strtotime($row['fechaalta'])).'</td>';
    $output['data'] .= '<td><a href="../../modelos/recepcion/recepcion.php?id=' . $row[$id] . '" type="button" class="btn btn-success" title="Crear recepción"><i class="fa fa-check"></i></a></td>';
    $output['data'] .= '<td><a href="../../modelos/reportes/repPaciente.php?id=' . $row[$id] . '" type="button" class="btn btn-secundary" title="Historial del paciente"><i class="fa fa-address-book-o"></i></a></td>';
    $output['data'] .= '<td><a href="../pacientes/edit_paciente.php?id=' . $row[$id] . '" type="button" class="btn btn-warning" title="Editar paciente"><i class="fa fa-pencil"></i></a></td>';
    $output['data'] .= '</tr>';

 }

}else{

    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';

}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if (($pagina -4) > 1) {
        $numeroInicio = $pagina -4;
    }

    $numeroFin = $numeroInicio + 9;

    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }


    for ($i=$numeroInicio; $i <= $numeroFin ; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#">'.$i.'</a></li>';
    
        }else{
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="getData('.$i.')">'.$i.'</a></li>';
        }

    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);


/* https://www.youtube.com/watch?v=IP2Ye2KKfoc

/* PAGINACION
https://www.youtube.com/watch?v=NHF7RH3ALPM&t=129s
*/