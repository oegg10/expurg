<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1) {
        header("Location:../../index.php");
    }

    $usuarios = "SELECT u.idusuario,u.nombre,u.idrol,r.rol,u.cedula,u.curp,u.turno,u.fechaalta,u.condicion FROM usuarios u INNER JOIN roles r ON u.idrol = r.idrol";

    $resultado = $con->query($usuarios);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5>Administrar Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <a href="usuario.php" class="btn btn-primary">
                            Registrar Usuario <span class="fa fa-plus-circle"></span>
                        </a>
                        <hr>
                        <div class="table-responsive" id="listadoregistros">
                            <table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #757579; color: white;">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Cedula</th>
                                        <th>Curp</th>
                                        <th>Turno</th>
                                        <th>Fecha alta</th>
                                        <th>Condición</th>
                                        <th>Editar</th>
                                        <th>Bloqueo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($reg = $resultado->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>
                            <td>" . $reg['nombre'] . "</td>
                            <td>" . $reg['rol'] . "</td>
                            <td>" . $reg['cedula'] . "</td>
                            <td>" . $reg['curp'] . "</td>
                            <td>" . $reg['turno'] . "</td>
                            <td>" . $reg['fechaalta'] . "</td>";
                                        if ($reg['condicion']) {
                                            echo "<td><span class='text-success'>Activo</span></td>";
                                        } else {
                                            echo "<td><span class='text-danger'>Bloqueado</span></td>";
                                        }

                                        echo "<td><a href='edit_usuario.php?id=" . $reg['idusuario'] . "' type='button' class='btn btn-warning'><i class='fa fa-pencil'></i></a></td>";
                                        if ($reg['condicion']) {
                                            echo "<td><a href='bloq_usuario.php?id=" . $reg['idusuario'] . "' type='button' class='btn btn-danger'><i class='fa fa-times'></i></a></td>";
                                        } else {
                                            echo "<td><a href='desbloq_usuario.php?id=" . $reg['idusuario'] . "' type='button' class='btn btn-success'><i class='fa fa-check'></i></a></td>";
                                        }

                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Cedula</th>
                                        <th>Curp</th>
                                        <th>Turno</th>
                                        <th>Fecha alta</th>
                                        <th>Condición</th>
                                        <th>Editar</th>
                                        <th>Bloqueo</th>
                                    </tr>
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

ob_end_flush();
?>