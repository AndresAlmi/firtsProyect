<?php

require_once "../../class/Servicio.php";

$idServicio = $_GET['id_servicio'];

$Servicio = Servicio::obtenerPorId($idServicio);
$Servicio->eliminar();

header("location: listado.php");

?>