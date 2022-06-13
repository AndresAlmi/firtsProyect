<?php

require_once "../../../class/marca.php";

$idMarca = $_POST["txtIdMarca"];
$descripcion = $_POST["txtMarca"];

$marca = marca::obtenerPorId($idMarca);

$marca->setDescripcionMarca($descripcion);

$marca->actualizar();

header("location: listado.php");

?>