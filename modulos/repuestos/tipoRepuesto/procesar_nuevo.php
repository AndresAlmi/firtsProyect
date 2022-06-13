<?php

require_once "../../../class/tipoRepuesto.php";

$descripcion = $_POST["txtTipoRepuesto"];

$tipoRepuesto = new tipoRepuesto();

$tipoRepuesto->setDescripcionM($descripcion);
$tipoRepuesto->guardar();
header("location: listado.php");

?>