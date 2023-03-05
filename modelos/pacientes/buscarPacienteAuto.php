<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 3) {
        header("Location:../../index.php");
    }

?>

    <div class="container py-4 text-center">
        <h2>Pacientes</h2>

        <div class="row g-4">

            <div class="col-auto">
                <label for="num_registros" class="col-form-label">Mostrar: </label>
            </div>

            <div class="col-auto">
                <select name="num_registros" id="num_registros" class="form-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="col-auto">
                <label for="num_registros" class="col-form-label">registros </label>
            </div>

            <div class="col-5"></div>

            <div class="col-auto">
                <label for="campo" class="col-form-label">Buscar: </label>
            </div>
            <div class="col-auto">
                <input type="text" name="campo" id="campo" class="form-control">
            </div>
        </div>

        <div class="row py-4">
            <div class="col">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Expediente</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <th>CURP</th>
                        <th>Fecha nac.</th>
                        <th>Condición</th>
                        <th>Fecha alta</th>
                        <th>Registró/Modificó</th>    
                        <th>Recepción</th>
                        <th>Historial</th>
                        <th>Editar</th>
                    </thead>

                    <tbody id="content">

                    </tbody>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <label id="lbl-total"></label>
            </div>

            <div class="col-6" id="nav-paginacion"></div>
        </div>
    </div>

    <script>
        let paginaActual = 1

        getData(paginaActual)

        document.getElementById("campo").addEventListener("keyup", function() {
            getData(1)
        }, false)

        document.getElementById("num_registros").addEventListener("change", function() {
            getData(paginaActual)
        }, false)


        function getData(pagina) {

            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")

            if (pagina != null) {
                paginaActual = pagina
            }

            let url = "buscadorpacientes/load.php";
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', paginaActual)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros.'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))

        }
    </script>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>