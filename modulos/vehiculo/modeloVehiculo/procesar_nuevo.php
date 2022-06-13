<?php

require_once "../../../class/modelo.php";

$idMarca = $_POST["cboMarca"];
$descripcion = $_POST["txtModelo"];

$modelo = new modelo();

$modelo->setIdMarca($idMarca);
$modelo->setDescripcionModelo($descripcion);
$modelo->guardar();
header("location: listado.php");

?>