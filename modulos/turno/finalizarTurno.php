<?php

require_once "../../class/turno.php";

$id = $_GET["id_turno"];
$idTaller = $_GET["id_taller"];
$estado = $_GET["estado"];


$turno = turno::obtenerPorIdTurno($id);
if($estado == 1){
    $turno->setEstado(2);
    $turno->cambiarEstado();
    header("location: listado.php?id_taller=$idTaller");

}else if($estado == 3){
    $turno->setEstado(4);
    $turno->cambiarEstado();
    header("location: listado.php?id_taller=" .$idTaller);
}else{
    header("location: listado.php?id_taller=" .$idTaller."&e_error=finalizado");
}


?>