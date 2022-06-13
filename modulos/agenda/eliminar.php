<?php

require_once "../../class/agenda.php";

$id_agenda = $_GET["id_agenda"];

$agenda = Agenda::obtenerPorId($id_agenda);
$idTaller = $agenda->getIdTaller();

$agenda->eliminar();
exit;
header("location: listado.php?id_taller=$idTaller");
?>