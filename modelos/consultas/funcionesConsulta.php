<?php

    function insertarConsultaC1($con, $idrecepcion, $fechaingreso, $fc, $fr, $ta, $temperatura, $glucosa, $talla, $peso, $pabdominal, $imc, $notaingresourg, $atnprehosp, $tipourgencia, $tiempotraslado, $nombreunidad, $trastrans, $motivoatencion, $tipocama, $altapor, $otraunidad, $ministeriopublico, $mujeredadfertil, $afecprincipal, $comorbilidad1, $comorbilidad2, $comorbilidad3, $interconsulta1, $interconsulta2, $interconsulta3, $procedim1, $procedim2, $procedim3, $procedim4, $procedim5, $medicamento1, $medicamento2, $medicamento3, $lesion_es, $lesiones, $fechaalta, $idusuario){

        //Realizamos la inserción de los datos
        $sql = "INSERT INTO consultas (idrecepcion, fechaingreso, fc, fr, ta, temperatura, glucosa, talla, peso, pabdominal, imc, notaingresourg, atnprehosp, tipourgencia, tiempotraslado, nombreunidad, trastrans, motivoatencion, tipocama, altapor, otraunidad, ministeriopublico, mujeredadfertil, afecprincipal, comorbilidad1, comorbilidad2, comorbilidad3, interconsulta1, interconsulta2, interconsulta3, procedim1, procedim2, procedim3, procedim4, procedim5, medicamento1, medicamento2, medicamento3, lesion_es, lesiones, cap_lesion, fechaalta, condicion, idusuario) VALUES ('$idrecepcion', '$fechaingreso', '$fc', '$fr', '$ta', '$temperatura', '$glucosa', '$talla', '$peso', '$pabdominal', '$imc', '$notaingresourg', '$atnprehosp', '$tipourgencia', '$tiempotraslado', '$nombreunidad', '$trastrans', '$motivoatencion', '$tipocama', '$altapor', '$otraunidad', '$ministeriopublico', '$mujeredadfertil', '$afecprincipal', '$comorbilidad1', '$comorbilidad2', '$comorbilidad3', '$interconsulta1', '$interconsulta2', '$interconsulta3', '$procedim1', '$procedim2', '$procedim3', '$procedim4', '$procedim5', '$medicamento1', '$medicamento2', '$medicamento3', '$lesion_es', '$lesiones', '2', '$fechaalta', '1', '$idusuario')";

        $resins = $con->query($sql);

        $recepcion = "UPDATE recepciones SET condicion = 2 WHERE idrecepcion = '$idrecepcion'";
        $consultado = $con->query($recepcion);


        if ($resins > 0 && $consultado > 0) {

            echo "<script>
                alert('La consulta se guardo con exito');
                window.location = 'index.php';
            </script>";
            $con->close();
            $recepcion = null;
        } else {

            echo "<script>
                alert('Error al guardar la consulta');
                window.location = 'index.php';
            </script>";
        }

        $con->close();
        $recepcion = null;

    } //insertarConsultaC1
    

    function editarConsultaC1($con,$fc,$fr,$ta,$temperatura,$glucosa,$talla,$peso,$pabdominal,$imc,$notaingresourg,$atnprehosp,$tipourgencia,$tiempotraslado,$nombreunidad,$trastrans,$motivoatencion,$tipocama,$altapor,$otraunidad,$ministeriopublico,$mujeredadfertil,$afecprincipal,$comorbilidad1,$comorbilidad2,$comorbilidad3,$interconsulta1,$interconsulta2,$interconsulta3,$procedim1,$procedim2,$procedim3,$procedim4,$procedim5,$medicamento1,$medicamento2,$medicamento3,$idusuario,$idconsulta){

        $editar = "UPDATE consultas SET fc='$fc',
                                    fr='$fr',
                                    ta='$ta',
                                    temperatura='$temperatura',
                                    glucosa='$glucosa',
                                    talla='$talla',
                                    peso='$peso',
                                    pabdominal='$pabdominal',
                                    imc='$imc',
                                    notaingresourg='$notaingresourg',
                                    atnprehosp='$atnprehosp',
                                    tipourgencia='$tipourgencia',
                                    tiempotraslado='$tiempotraslado',
                                    nombreunidad='$nombreunidad',
                                    trastrans='$trastrans',
                                    motivoatencion='$motivoatencion',
                                    tipocama='$tipocama',
                                    altapor='$altapor',
                                    otraunidad='$otraunidad',
                                    ministeriopublico='$ministeriopublico',
                                    mujeredadfertil='$mujeredadfertil',
                                    afecprincipal='$afecprincipal',
                                    comorbilidad1='$comorbilidad1',
                                    comorbilidad2='$comorbilidad2',
                                    comorbilidad3='$comorbilidad3',
                                    interconsulta1='$interconsulta1',
                                    interconsulta2='$interconsulta2',
                                    interconsulta3='$interconsulta3',
                                    procedim1='$procedim1',
                                    procedim2='$procedim2',
                                    procedim3='$procedim3',
                                    procedim4='$procedim4',
                                    procedim5='$procedim5',
                                    medicamento1='$medicamento1',
                                    medicamento2='$medicamento2',
                                    medicamento3='$medicamento3',
                                    condicion='1',
                                    idusuario='$idusuario' WHERE idconsulta = '$idconsulta'";
        
        //require_once "../../conexion/conexion.php";

        $editado = $con->query($editar);

        if ($editado > 0) {
            header('location:../extend/alerta.php?msj=Consulta actualizada&c=pac&p=in&t=success');
            $con->close();
        } else {

            header('location:../extend/alerta.php?msj=Error al actualizar consulta&c=pac&p=in&t=error');
        }

        $con->close();

    } //editarConsultaC1




