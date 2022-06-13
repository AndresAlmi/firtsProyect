<?php

require_once "../../../class/marca.php";

$descripcion = $_POST["txtMarca"];

$marca = new marca();

$marca->setDescripcionMarca($descripcion);
$marca->guardar();
header("location: listado.php");

?>