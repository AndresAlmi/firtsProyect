<?php

require_once "../../../class/tipoRepuesto.php";

$idModelo = $_POST["txtIdModelo"];

$descripcion = $_POST["txtModelo"];

$modelo = tipoRepuesto::obtenerPorId($idModelo);

$modelo->setDescripcionM($descripcion);

$modelo->actualizar();

header("location: listado.php");

?>