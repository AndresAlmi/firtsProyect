<?php

require_once "../../../class/serviciosRepuestos.php ";

$idServicio = $_GET['id_servicio_repuesto'];

$Servicio = serviciosRepuesto::obtenerPorIdServicioRepuesto($idServicio);
$id = $Servicio->getIdServicio();
$Servicio->eliminar();
header("location: listado.php?id_servicio=$id");

?>