<?php

require_once "../../class/turno.php";

$id = $_GET["id_turno"];
$estado = $_GET["estado"];

$turno = turno::obtenerPorIdTurno($id);

$turno->setEstado($estado);
$turno->cambiarEstado();
header("location: misTurnos.php");

?>