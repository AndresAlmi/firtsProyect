<?php

require_once "../../../class/marcaRepuesto.php";

$descripcion = $_POST["txtMarca"];

$marca = new MarcaRepuesto();

$marca->setDescripcionMa($descripcion);
$marca->guardar();
header("location: listado.php");

?>