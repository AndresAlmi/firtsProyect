<?php
require_once "../../class/turnoServicio.php";
$idServicio = $_GET["id_servicio"];
$idTurno = $_GET["id_turno"];

$turnoServicio = turnoServicio::eliminar($idTurno, $idServicio);
header("location: modificar.php?id_turno=$idTurno");
//echo $idServicio . ", " . $idTurno;

?>