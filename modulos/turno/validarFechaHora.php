<?php
require_once "../../class/agenda.php";

$fecha = $_GET["fecha"];
$hora = $_GET["hora"];
$taller = $_GET["taller"];
$respuesta = "";
$agenda = Agenda::obtenerPorIdTallerEstado($taller);
if($fecha > $agenda->getfechainicio() and $fecha < $agenda->getfechafin()){
    if($hora > $agenda->gethorainicio() and $hora < $agenda->gethorafin()){
        $respuesta = true;
    }
    else{
        $respuesta = false;
    }
}else{
    $respuesta = false;
}
echo $respuesta;
?>