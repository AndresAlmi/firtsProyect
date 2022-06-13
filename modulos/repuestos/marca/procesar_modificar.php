<?php

require_once "../../../class/marcaRepuesto.php";

$idMarca = $_POST["txtIdMarca"];
$descripcion = $_POST["txtMarca"];

$marca = MarcaRepuesto::obtenerPorIdMarca($idMarca);

$marca->setDescripcionMa($descripcion);

$marca->actualizar();

header("location: listado.php");

?>