<?php

require_once "../../class/servicio.php";

//var_dump ($_POST);
$id_servicio = $_POST["txtidservicio"];
$descripcion = $_POST['txtDescripcion'];
$precio = $_POST['txtPrecio'];
$duracion = $_POST['txtDuracion'];



$servicio = Servicio::obtenerPorId($id_servicio);

$servicio->setdescripcion($descripcion);
$servicio->setPrecioServicio($precio);
$servicio->setDuracion($duracion);




$servicio->actualizar();


header("location: listado.php");


?>