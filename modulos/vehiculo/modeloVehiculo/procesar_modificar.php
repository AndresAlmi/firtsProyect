<?php

require_once "../../../class/modelo.php";

$idModelo = $_POST["txtIdModelo"];
$idMarca = $_POST["cboMarca"];
$descripcion = $_POST["txtModelo"];

$modelo = modelo::obtenerPorId($idModelo);

$modelo->setIdMarca($idMarca);
$modelo->setDescripcionModelo($descripcion);

$modelo->actualizar();

header("location: listado.php");

?>