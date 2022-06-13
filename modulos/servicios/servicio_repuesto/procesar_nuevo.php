<?php

require_once "../../../class/serviciosRepuestos.php";
$idServicio = $_POST["txtIdServicio"];
$repuesto = $_POST["cboRepuesto"];
$cantidad = $_POST["txtCantidad"];

$servicioRepuesto = new serviciosRepuesto();

$servicioRepuesto->setIdServicio($idServicio);
$servicioRepuesto->setIdRepuesto($repuesto);
$servicioRepuesto->setCantidad($cantidad);

$servicioRepuesto->guardar();
header("location:nuevo.php?id_servicio=$idServicio&add=continue")
?>