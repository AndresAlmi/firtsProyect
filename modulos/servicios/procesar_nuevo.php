<?php

require_once "../../class/servicio.php";

$descripcion = $_POST['txtDescripcion'];
$precio = $_POST['txtPrecio'];
$duracion = $_POST['txtDuracion'];
$tipoServicio = $_POST['cboTipoServicio'];


$servicio = new Servicio();
$servicio->setdescripcion($descripcion);
$servicio->setPrecioServicio($precio);
$servicio->setDuracion($duracion);
$servicio->setIdTipoServicio($tipoServicio);


$servicio->guardar();

header("location: listado.php");


?>