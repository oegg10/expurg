<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

    $desconocidos = "SELECT * FROM desconocidos WHERE condicion = 1";

    $resultado = $con->query($desconocidos);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Recepción Urgencias | Desconocidos</h5>
                        <a href="../desconocidos/desconocido.php" class="btn btn-danger">Registrar Desconocido</a>
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Fecha alta</th>
                                        <th>Motivo ingreso</th>
                                        <th>Sexo</th>
                                        <th>Rasgos</th>
                                        <th>Encontrado</th>
                                        <th>Lo trajo</th>
                                        <th>Edad aparente</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {

                                        echo "<tr>
                                        <td>" . date("d-m-Y - H:i:s", strtotime($reg['fechaalta'])) . "</td>
                                        <td>" . $reg['mtvoingreso'] . "</td>";

                                                if($reg['sexo'] == 'MASCULINO'){
                                                    echo "<td>M</td>";
                                                }else{
                                                    echo "<td>F</td>";
                                                    //<td>" . $reg['sexo'] . "</td>
                                                }
                                        
                                        echo "<td>" . $reg['rasgos'] . "</td>
                                        <td>" . $reg['encontrado'] . "</td>
                                        <td>" . $reg['trasladado'] . "</td>
                                        <td>" . $reg['edadaparente'] . "</td>
                                        <td class='btn-group'>

                                            <a href='imprimirDesconocido.php?id=" . $reg['iddesconocido'] . "'type='button' class='btn btn-secundary'><i class='fa fa-print' title='Imprimir hoja'></i></a>

                                            <a href='editarDesconocido.php?id=" . $reg['iddesconocido'] . "' type='button' class='btn btn-warning' title='Editar'><i class='fa fa-pencil-square-o'></i></a>

                                            <a href='acreditado.php?id=" . $reg['iddesconocido'] . "' type='button' class='btn btn-success' title='Acreditar desconocido'><i class='fa fa-check'></i></a>
                                        </td>
                                        </tr>";
                                    }

                                    ?>

                                </tbody>
                                <tfoot>
                                    <th>Fecha alta</th>
                                    <th>Motivo ingreso</th>
                                    <th>Sexo</th>
                                    <th>Rasgos</th>
                                    <th>Encontrado</th>
                                    <th>Lo trajo</th>
                                    <th>Edad aparente</th>
                                    <th>Opciones</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include "../extend/footer.php"; ?>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>